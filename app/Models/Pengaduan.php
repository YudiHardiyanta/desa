<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'nomor',
    'nama',
    'kontak',
    'isi',
    'lokasi',
    'latitude',
    'longitude',
    'foto',
    'tags',
    'status',
    'respon',
    'foto_tindak_lanjut',
    'ditindaklanjuti_pada',
])]
class Pengaduan extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'ditindaklanjuti_pada' => 'datetime',
        ];
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            default => 'Baru',
        };
    }

    public function getMapsUrlAttribute(): ?string
    {
        if ($this->latitude === null || $this->longitude === null) {
            return null;
        }

        return 'https://www.google.com/maps?q='.$this->latitude.','.$this->longitude;
    }
}
