@extends('layouts.admin')

@section('title', 'Dashboard Admin Desa Pelaga')
@section('page-title', 'Dashboard')
@section('breadcrumb')
    <span class="text-emerald-700">Dashboard</span>
@endsection

@section('content')
    <section class="space-y-6">
        <div class="rounded-lg bg-gradient-to-r from-emerald-800 to-lime-600 p-6 text-white shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-wider text-lime-100">Selamat Datang</p>
            <h2 class="mt-2 text-2xl font-bold">Admin Pemerintah Desa Pelaga</h2>
            <p class="mt-3 max-w-2xl leading-7 text-emerald-50">Kelola informasi desa, agenda, berita, galeri, layanan, dan pengaduan masyarakat dari panel sederhana ini.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ([
                ['Berita', '12', 'Artikel desa aktif'],
                ['Agenda', '5', 'Kegiatan terjadwal'],
                ['Pengaduan', '8', 'Menunggu tindak lanjut'],
                ['Galeri', '24', 'Foto terdokumentasi'],
            ] as [$label, $value, $caption])
                <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-semibold text-slate-500">{{ $label }}</p>
                    <p class="mt-3 text-3xl font-bold text-slate-950">{{ $value }}</p>
                    <p class="mt-2 text-sm text-slate-500">{{ $caption }}</p>
                </article>
            @endforeach
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
            <section class="rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h3 class="font-bold text-slate-950">Aktivitas Terbaru</h3>
                </div>
                <div class="divide-y divide-slate-100">
                    @foreach ([
                        ['Berita desa diperbarui', 'Informasi layanan administrasi diperbarui oleh admin.'],
                        ['Pengaduan masuk', 'Warga mengirim laporan fasilitas umum.'],
                        ['Agenda ditambahkan', 'Kerja bakti lingkungan masuk jadwal desa.'],
                    ] as [$title, $caption])
                        <div class="px-5 py-4">
                            <p class="font-semibold text-slate-900">{{ $title }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $caption }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <h3 class="font-bold text-slate-950">Akses Cepat</h3>
                <div class="mt-4 grid gap-3">
                    <a href="{{ route('admin.berita.create') }}" class="rounded border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800">Tambah Berita</a>
                    <a href="{{ route('admin.agenda.index') }}" class="rounded border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800">Tambah Agenda</a>
                    <a href="{{ route('admin.galeri.index') }}" class="rounded border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800">Kelola Galeri</a>
                    <a href="{{ route('admin.pengaduan.index') }}" class="rounded border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800">Kelola Pengaduan</a>
                </div>
            </section>
        </div>
    </section>
@endsection
