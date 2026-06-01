<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class DummyBeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::where('email', 'admin@admin.com')->value('id');

        for ($i = 1; $i <= 21; $i++) {
            Berita::updateOrCreate(
                ['judul' => sprintf('Dummy Berita Desa Pelaga %02d', $i)],
                [
                    'user_id' => $userId,
                    'tanggal_berita' => Carbon::today()->subDays(21 - $i),
                    'isi' => sprintf(
                        '<p>Ini adalah isi dummy berita Desa Pelaga nomor %02d. Konten ini dibuat untuk menguji tampilan daftar berita, pagination, dan section berita terbaru pada halaman beranda.</p>',
                        $i,
                    ),
                    'gambar_headline' => null,
                    'penerbit' => 'Admin Desa Pelaga',
                    'tags' => ['dummy', 'desa', 'pelaga'],
                ],
            );
        }
    }
}
