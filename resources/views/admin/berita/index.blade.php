@extends('layouts.admin')

@section('title', 'Admin Berita Desa')
@section('page-title', 'Berita Desa')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="transition hover:text-emerald-700">Dashboard</a>
    <span>/</span>
    <span class="text-emerald-700">Berita Desa</span>
@endsection

@section('content')
    <section class="space-y-6">
        <div class="flex flex-col justify-between gap-4 rounded-lg bg-gradient-to-r from-emerald-800 to-lime-600 p-6 text-white shadow-sm md:flex-row md:items-end">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-lime-100">Manajemen Konten</p>
                <h2 class="mt-2 text-2xl font-bold">Data Berita Desa</h2>
                <p class="mt-3 max-w-2xl leading-7 text-emerald-50">Kelola berita desa yang tampil pada halaman public.</p>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="rounded bg-lime-300 px-5 py-3 text-sm font-bold text-emerald-950 transition hover:bg-lime-200">Tambah Berita</a>
        </div>

        <section class="rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="grid gap-3 border-b border-slate-200 p-4 md:grid-cols-[1fr_180px]">
                <input
                    id="berita-table-search"
                    type="search"
                    class="rounded border border-slate-300 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                    placeholder="Cari judul, penerbit, atau status..."
                >
                <select id="berita-table-status" class="rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Disembunyikan">Disembunyikan</option>
                </select>
            </div>

            <div class="overflow-x-auto">
                <table id="berita-table" class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Berita</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Penerbit</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($beritas as $berita)
                            <tr class="align-top">
                                <td class="px-4 py-4">
                                    <div class="flex gap-3">
                                        <img
                                            src="{{ $berita->gambar_headline ? asset('storage/'.$berita->gambar_headline) : 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=180&q=70' }}"
                                            alt="{{ $berita->judul }}"
                                            class="size-16 rounded object-cover"
                                            width="80"
                                            height="80"
                                            loading="lazy"
                                        >
                                        <div>
                                            <p class="font-bold text-slate-950">{{ $berita->judul }}</p>
                                            <p class="mt-1 line-clamp-2 max-w-xl text-slate-500">{{ strip_tags($berita->isi) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-slate-600">{{ $berita->tanggal_berita->translatedFormat('d M Y') }}</td>
                                <td class="whitespace-nowrap px-4 py-4 text-slate-600">{{ $berita->penerbit }}</td>
                                <td class="whitespace-nowrap px-4 py-4" data-search="{{ $berita->is_active ? 'Aktif' : 'Disembunyikan' }}">
                                    <span class="rounded px-3 py-1 text-xs font-bold {{ $berita->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $berita->is_active ? 'Aktif' : 'Disembunyikan' }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex justify-end gap-2">
                                        <a
                                            href="{{ route('admin.berita.edit', $berita) }}"
                                            class="group relative inline-flex size-10 items-center justify-center rounded border border-slate-200 text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2"
                                            aria-label="Edit berita"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                            </svg>
                                            <span class="pointer-events-none absolute -top-10 right-0 z-10 whitespace-nowrap rounded bg-slate-950 px-2.5 py-1.5 text-xs font-semibold text-white opacity-0 shadow transition group-hover:opacity-100 group-focus:opacity-100">Edit berita</span>
                                        </a>
                                        <form method="POST" action="{{ route('admin.berita.toggle', $berita) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                class="group relative inline-flex size-10 items-center justify-center rounded border border-slate-200 text-slate-700 transition hover:border-amber-200 hover:bg-amber-50 hover:text-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
                                                aria-label="{{ $berita->is_active ? 'Sembunyikan berita' : 'Tampilkan berita' }}"
                                            >
                                                @if ($berita->is_active)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M10.7 5.1A10.9 10.9 0 0 1 12 5c6 0 10 7 10 7a13.2 13.2 0 0 1-3 3.9" />
                                                        <path d="M14.1 14.1A3 3 0 0 1 9.9 9.9" />
                                                        <path d="M3 3l18 18" />
                                                        <path d="M6.6 6.6C3.8 8.5 2 12 2 12s4 7 10 7a10.9 10.9 0 0 0 4.7-1.1" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12Z" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg>
                                                @endif
                                                <span class="pointer-events-none absolute -top-10 right-0 z-10 whitespace-nowrap rounded bg-slate-950 px-2.5 py-1.5 text-xs font-semibold text-white opacity-0 shadow transition group-hover:opacity-100 group-focus:opacity-100">{{ $berita->is_active ? 'Sembunyikan berita' : 'Tampilkan berita' }}</span>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.berita.destroy', $berita) }}" data-delete-form data-delete-title="Hapus berita?" data-delete-message="Data berita yang dihapus tidak akan tampil lagi dan tidak bisa dikembalikan dari halaman ini.">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="group relative inline-flex size-10 items-center justify-center rounded border border-red-200 text-red-700 transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                                aria-label="Hapus berita"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M3 6h18" />
                                                    <path d="M8 6V4h8v2" />
                                                    <path d="M19 6l-1 14H6L5 6" />
                                                    <path d="M10 11v5" />
                                                    <path d="M14 11v5" />
                                                </svg>
                                                <span class="pointer-events-none absolute -top-10 right-0 z-10 whitespace-nowrap rounded bg-slate-950 px-2.5 py-1.5 text-xs font-semibold text-white opacity-0 shadow transition group-hover:opacity-100 group-focus:opacity-100">Hapus berita</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </section>
@endsection
