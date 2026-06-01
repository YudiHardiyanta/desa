<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DummyAgendaSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::where('email', 'admin@admin.com')->value('id');

        $agendas = [
            ['Musyawarah Desa Pelaga', 2, '09:00', '11:00', 'Balai Desa Pelaga'],
            ['Pelayanan Administrasi Terpadu', 4, '08:30', '12:00', 'Kantor Perbekel Pelaga'],
            ['Kerja Bakti Kebersihan Lingkungan', 6, '07:00', '09:30', 'Wilayah Banjar Pelaga'],
            ['Sosialisasi Kesehatan Masyarakat', 8, '10:00', '12:00', 'Balai Banjar'],
            ['Rapat Koordinasi Kelompok Tani', 11, '13:00', '15:00', 'Subak Desa Pelaga'],
            ['Pelatihan UMKM Desa', 14, '09:00', '12:00', 'Ruang Pertemuan Desa'],
            ['Pendataan Warga dan Potensi Desa', 17, '08:00', '11:00', 'Kantor Desa Pelaga'],
            ['Kegiatan Posyandu Balita', 20, '08:30', '10:30', 'Posyandu Desa'],
            ['Pembinaan Karang Taruna', 23, '16:00', '18:00', 'Balai Desa Pelaga'],
            ['Evaluasi Program Desa Bulanan', 27, '09:00', '11:30', 'Kantor Perbekel Pelaga'],
        ];

        foreach ($agendas as [$judul, $daysFromToday, $waktuMulai, $waktuSelesai, $lokasi]) {
            Agenda::updateOrCreate(
                ['judul' => $judul],
                [
                    'user_id' => $userId,
                    'tanggal_event' => Carbon::today()->addDays($daysFromToday),
                    'waktu_mulai' => $waktuMulai,
                    'waktu_selesai' => $waktuSelesai,
                    'lokasi' => $lokasi,
                    'deskripsi' => 'Agenda sampel untuk menguji tampilan kalender kegiatan dan daftar agenda mendatang pada website Desa Pelaga.',
                    'is_active' => true,
                ],
            );
        }
    }
}
