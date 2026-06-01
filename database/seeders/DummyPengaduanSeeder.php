<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DummyPengaduanSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['Jalan lingkungan menuju area kebun berlubang dan licin setelah hujan.', 'Banjar Kiadan', ['jalan', 'infrastruktur'], 'selesai', 'Lubang jalan telah ditambal sementara dan masuk daftar perbaikan rabat beton berikutnya.'],
            ['Lampu penerangan jalan mati di dekat pertigaan balai banjar.', 'Banjar Pelaga', ['lampu', 'keamanan'], 'diproses', 'Petugas sudah mengecek lokasi dan sedang menunggu penggantian komponen lampu.'],
            ['Sampah menumpuk di dekat saluran air dan mengganggu aliran saat hujan.', 'Banjar Bukian', ['sampah', 'lingkungan'], 'baru', null],
            ['Drainase kecil di depan rumah warga tersumbat tanah dan daun.', 'Jalan menuju Pura Desa', ['drainase', 'lingkungan'], 'selesai', 'Drainase sudah dibersihkan bersama petugas kebersihan dan warga setempat.'],
            ['Usulan penambahan rambu pelan-pelan karena banyak kendaraan melaju cepat.', 'Dekat SD Negeri Pelaga', ['rambu', 'keamanan'], 'diproses', 'Usulan diteruskan ke perangkat desa untuk pembahasan pemasangan rambu.'],
            ['Air bersih sempat kecil pada pagi hari di beberapa rumah warga.', 'Banjar Semanik', ['air', 'layanan'], 'baru', null],
            ['Terdapat pohon miring di sisi jalan yang dikhawatirkan roboh.', 'Jalur Pelaga - Petang', ['pohon', 'keselamatan'], 'selesai', 'Pohon sudah dipangkas oleh tim terkait untuk mengurangi risiko.'],
            ['Permintaan pembersihan rumput liar di sekitar fasilitas olahraga desa.', 'Lapangan Desa Pelaga', ['fasilitas', 'kebersihan'], 'diproses', 'Pembersihan dijadwalkan bersama kegiatan kerja bakti akhir pekan.'],
        ];

        foreach ($items as $index => [$isi, $lokasi, $tags, $status, $respon]) {
            $createdAt = Carbon::now()->subDays(count($items) - $index);
            $nomor = 'PELAGA/ADUAN/'.$createdAt->format('Y/m').'/'.str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT);

            Pengaduan::updateOrCreate(
                ['nomor' => $nomor],
                [
                    'nama' => 'Warga Pelaga '.($index + 1),
                    'kontak' => '08'.str_pad((string) (12345000 + $index), 10, '0', STR_PAD_LEFT),
                    'isi' => $isi,
                    'lokasi' => $lokasi,
                    'latitude' => -8.2900000 + ($index * 0.0021000),
                    'longitude' => 115.2200000 + ($index * 0.0017000),
                    'foto' => null,
                    'tags' => $tags,
                    'status' => $status,
                    'respon' => $respon,
                    'foto_tindak_lanjut' => null,
                    'ditindaklanjuti_pada' => $status === 'baru' ? null : $createdAt->copy()->addDay(),
                    'created_at' => $createdAt,
                    'updated_at' => $status === 'baru' ? $createdAt : $createdAt->copy()->addDay(),
                ]
            );
        }
    }
}
