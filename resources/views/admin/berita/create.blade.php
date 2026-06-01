@extends('layouts.admin')

@section('title', 'Tambah Berita Desa')
@section('page-title', 'Tambah Berita Desa')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="transition hover:text-emerald-700">Dashboard</a>
    <span>/</span>
    <span class="text-emerald-700">Berita Desa</span>
@endsection

@section('content')
    <section class="mx-auto max-w-5xl space-y-6">
        <div class="rounded-lg bg-gradient-to-r from-emerald-800 to-lime-600 p-6 text-white shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-wider text-lime-100">Form Berita Desa</p>
            <h2 class="mt-2 text-2xl font-bold">Tambah Berita Baru</h2>
            <p class="mt-3 max-w-2xl leading-7 text-emerald-50">Lengkapi informasi berita yang akan ditampilkan pada portal Desa Pelaga.</p>
        </div>

        @if ($errors->any())
            <div class="rounded border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form id="berita-form" action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-6 lg:grid-cols-[1fr_320px]">
            @csrf

            <div class="space-y-6">
                <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="grid gap-5">
                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Judul Berita</span>
                            <input
                                type="text"
                                name="judul"
                                class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                                placeholder="Contoh: Pelayanan Administrasi Desa Pelaga Semakin Mudah"
                            >
                        </label>

                        <div>
                            <span class="text-sm font-semibold text-slate-700">Isi Berita</span>
                            <textarea
                                id="isi-berita"
                                name="isi"
                                rows="14"
                                class="mt-2 w-full rounded border border-slate-300 px-4 py-3 leading-7 outline-none transition placeholder:text-slate-400 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                                placeholder="Tuliskan isi berita desa secara lengkap..."
                            ></textarea>
                        </div>
                    </div>
                </section>
            </div>

            <aside class="space-y-6">
                <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="font-bold text-slate-950">Publikasi</h3>

                    <div class="mt-5 space-y-5">
                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Tanggal Berita</span>
                            <input
                                type="date"
                                name="tanggal"
                                class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                            >
                            <p class="mt-2 text-xs leading-5 text-slate-500">Kosongkan jika ingin memakai tanggal hari ini.</p>
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Penerbit Berita</span>
                            <input
                                type="text"
                                name="penerbit"
                                class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                                placeholder="Contoh: Admin Desa Pelaga"
                            >
                        </label>

                        <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                            <input type="checkbox" name="is_active" value="1" checked class="size-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-600">
                            Tampilkan berita di halaman public
                        </label>
                    </div>
                </section>

                <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="font-bold text-slate-950">Media dan Tag</h3>

                    <div class="mt-5 space-y-5">
                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Gambar Headline</span>
                            <input
                                type="file"
                                name="gambar_headline"
                                accept="image/*"
                                class="mt-2 w-full rounded border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm file:mr-3 file:rounded file:border-0 file:bg-emerald-700 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-emerald-800"
                            >
                            <p class="mt-2 text-xs leading-5 text-slate-500">Gunakan gambar utama yang jelas untuk headline berita.</p>
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Tag Berita</span>
                            <input
                                type="text"
                                name="tags"
                                class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                                placeholder="layanan, desa, administrasi"
                            >
                            <p class="mt-2 text-xs leading-5 text-slate-500">Pisahkan beberapa tag dengan koma.</p>
                        </label>
                    </div>
                </section>

                <div class="flex gap-3">
                    <button type="submit" class="flex-1 rounded bg-emerald-700 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-800">
                        Simpan Berita
                    </button>
                    <a href="{{ route('admin.berita.index') }}" class="rounded border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Batal
                    </a>
                </div>
            </aside>
        </form>
    </section>

@endsection
