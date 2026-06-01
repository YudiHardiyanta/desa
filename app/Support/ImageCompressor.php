<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageCompressor
{
    public function storeUploadedImage(UploadedFile $file, string $directory): string
    {
        if (! function_exists('imagejpeg')) {
            return $file->store($directory, 'public');
        }

        $mime = $file->getMimeType();
        $extension = match ($mime) {
            'image/png' => 'png',
            'image/webp' => 'webp',
            default => 'jpg',
        };
        $path = trim($directory, '/').'/'.Str::uuid().'.'.$extension;
        $targetPath = Storage::disk('public')->path($path);

        if (! is_dir(dirname($targetPath))) {
            mkdir(dirname($targetPath), 0775, true);
        }

        $image = match ($mime) {
            'image/jpeg', 'image/jpg' => imagecreatefromjpeg($file->getRealPath()),
            'image/png' => imagecreatefrompng($file->getRealPath()),
            'image/webp' => function_exists('imagecreatefromwebp') ? imagecreatefromwebp($file->getRealPath()) : false,
            default => false,
        };

        if (! $image) {
            return $file->store($directory, 'public');
        }

        if ($mime === 'image/png') {
            imagealphablending($image, false);
            imagesavealpha($image, true);
            imagepng($image, $targetPath, 6);
        } elseif ($mime === 'image/webp' && function_exists('imagewebp')) {
            imagewebp($image, $targetPath, 86);
        } else {
            imageinterlace($image, true);
            imagejpeg($image, $targetPath, 88);
        }

        imagedestroy($image);

        return $path;
    }
}
