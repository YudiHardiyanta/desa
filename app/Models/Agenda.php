<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'judul',
    'tanggal_event',
    'waktu_mulai',
    'waktu_selesai',
    'lokasi',
    'deskripsi',
    'is_active',
])]
class Agenda extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'tanggal_event' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
