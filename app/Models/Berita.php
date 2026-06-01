<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'judul',
    'tanggal_berita',
    'isi',
    'gambar_headline',
    'penerbit',
    'tags',
    'is_active',
])]
class Berita extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'tanggal_berita' => 'date',
            'tags' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
