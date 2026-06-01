<?php

namespace Database\Seeders;

use App\Models\GalleryCollection;
use App\Models\GalleryPhoto;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DummyGallerySeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::where('email', 'admin@admin.com')->value('id');

        $collections = collect([
            ['Kegiatan Pemerintahan Desa', 'Dokumentasi rapat, pelayanan, dan kegiatan pemerintahan Desa Pelaga.'],
            ['Lingkungan dan Gotong Royong', 'Potret kegiatan kebersihan, penghijauan, dan kerja bakti masyarakat.'],
            ['Pertanian dan Potensi Lokal', 'Dokumentasi potensi pertanian, kebun, dan produk lokal Desa Pelaga.'],
            ['Budaya dan Kemasyarakatan', 'Dokumentasi kegiatan budaya, adat, dan kebersamaan warga.'],
        ])->map(fn (array $collection) => GalleryCollection::updateOrCreate(
            ['judul' => $collection[0]],
            [
                'user_id' => $userId,
                'deskripsi' => $collection[1],
                'is_active' => true,
            ],
        ))->values();

        for ($i = 1; $i <= 50; $i++) {
            $path = sprintf('galeri/sampel/desa-pelaga-%02d.jpg', $i);
            $this->makeSampleImage(Storage::disk('public')->path($path), $i);

            GalleryPhoto::updateOrCreate(
                ['path' => $path],
                [
                    'user_id' => $userId,
                    'gallery_collection_id' => $i <= 44 ? $collections[($i - 1) % $collections->count()]->id : null,
                    'judul' => sprintf('Sampel Galeri Desa Pelaga %02d', $i),
                    'deskripsi' => 'Foto sampel terkompresi kualitas tinggi untuk menguji collection dan tampilan galeri publik.',
                    'is_active' => true,
                ],
            );
        }
    }

    private function makeSampleImage(string $targetPath, int $index): void
    {
        if (! is_dir(dirname($targetPath))) {
            mkdir(dirname($targetPath), 0775, true);
        }

        $width = 1200;
        $height = 800;
        $image = imagecreatetruecolor($width, $height);

        $palettes = [
            [[12, 92, 64], [190, 230, 120], [245, 250, 235]],
            [[20, 83, 45], [84, 180, 110], [236, 247, 225]],
            [[36, 88, 99], [119, 190, 138], [250, 245, 224]],
            [[64, 102, 44], [178, 210, 95], [244, 252, 240]],
        ];
        [$dark, $mid, $light] = $palettes[($index - 1) % count($palettes)];

        for ($y = 0; $y < $height; $y++) {
            $ratio = $y / $height;
            $r = (int) ($dark[0] + ($mid[0] - $dark[0]) * $ratio);
            $g = (int) ($dark[1] + ($mid[1] - $dark[1]) * $ratio);
            $b = (int) ($dark[2] + ($mid[2] - $dark[2]) * $ratio);
            imageline($image, 0, $y, $width, $y, imagecolorallocate($image, $r, $g, $b));
        }

        $hillColor = imagecolorallocate($image, $light[0], $light[1], $light[2]);
        imagefilledpolygon($image, [0, 610, 250, 450, 520, 610], $hillColor);
        imagefilledpolygon($image, [340, 640, 760, 380, 1200, 640], $hillColor);
        imagefilledpolygon($image, [0, 760, 430, 530, 860, 760], imagecolorallocate($image, 210, 235, 175));
        imagefilledrectangle($image, 0, 660, $width, $height, imagecolorallocate($image, 42, 125, 82));

        for ($x = -100; $x < $width; $x += 180) {
            imagefilledellipse($image, $x + (($index * 19) % 90), 610, 95, 140, imagecolorallocate($image, 22, 105, 70));
            imagefilledrectangle($image, $x + 38, 620, $x + 50, 710, imagecolorallocate($image, 95, 76, 42));
        }

        $white = imagecolorallocate($image, 255, 255, 255);
        $shadow = imagecolorallocate($image, 8, 45, 32);
        imagefilledrectangle($image, 70, 62, 560, 152, imagecolorallocate($image, 255, 255, 255));
        imagestring($image, 5, 95, 88, 'DESA PELAGA', $shadow);
        imagestring($image, 4, 95, 118, sprintf('Sampel Galeri %02d', $index), $shadow);
        imagestring($image, 5, 92, 86, 'DESA PELAGA', $white);

        imageinterlace($image, true);
        imagejpeg($image, $targetPath, 88);
        imagedestroy($image);
    }
}
