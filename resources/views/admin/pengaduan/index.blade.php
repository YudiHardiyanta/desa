@extends('layouts.admin')

@section('title', 'Admin Pengaduan')
@section('page-title', 'Pengaduan')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="transition hover:text-emerald-700">Dashboard</a>
    <span>/</span>
    <span class="text-emerald-700">Pengaduan</span>
@endsection

@php
    $statusClass = [
        'baru' => 'bg-amber-50 text-amber-700',
        'diproses' => 'bg-sky-50 text-sky-700',
        'selesai' => 'bg-emerald-50 text-emerald-700',
    ];
@endphp

@section('content')
    <section class="space-y-6">
        <div class="flex flex-col justify-between gap-4 rounded-lg bg-gradient-to-r from-emerald-800 to-lime-600 p-6 text-white shadow-sm md:flex-row md:items-end">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-lime-100">Tindak Lanjut Warga</p>
                <h2 class="mt-2 text-2xl font-bold">Daftar Pengaduan</h2>
                <p class="mt-3 max-w-2xl leading-7 text-emerald-50">Kelola laporan warga, berikan respon, dan unggah bukti tindak lanjut.</p>
            </div>
            <a href="{{ route('pengaduan.index') }}" class="rounded bg-lime-300 px-5 py-3 text-sm font-bold text-emerald-950 transition hover:bg-lime-200">Lihat Public</a>
        </div>

        <section class="rounded-lg border border-slate-200 bg-white shadow-sm">
            <form method="GET" class="grid gap-3 border-b border-slate-200 p-4 md:grid-cols-[1fr_180px_auto]">
                <input
                    name="q"
                    value="{{ request('q') }}"
                    type="search"
                    class="rounded border border-slate-300 px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                    placeholder="Cari nomor, nama, lokasi, tag..."
                >
                <select name="status" class="rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                    <option value="">Semua Status</option>
                    <option value="baru" @selected(request('status') === 'baru')>Baru</option>
                    <option value="diproses" @selected(request('status') === 'diproses')>Diproses</option>
                    <option value="selesai" @selected(request('status') === 'selesai')>Selesai</option>
                </select>
                <button class="rounded bg-emerald-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-800">Filter</button>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Pengaduan</th>
                            <th class="px-4 py-3">Pelapor</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($pengaduans as $pengaduan)
                            <tr class="align-top">
                                <td class="px-4 py-4">
                                    <p class="font-bold text-slate-950">{{ $pengaduan->nomor }}</p>
                                    <p class="mt-2 line-clamp-2 max-w-xl leading-6 text-slate-600">{{ $pengaduan->isi }}</p>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        @foreach ($pengaduan->tags ?? [] as $tag)
                                            <span class="rounded bg-emerald-50 px-2 py-1 text-xs font-bold text-emerald-700">#{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="font-bold text-slate-800">{{ $pengaduan->nama }}</p>
                                    <p class="mt-1 text-slate-500">{{ $pengaduan->kontak }}</p>
                                    <p class="mt-2 text-xs font-semibold text-slate-400">{{ $pengaduan->created_at->translatedFormat('d M Y H:i') }}</p>
                                </td>
                                <td class="px-4 py-4 text-slate-600">
                                    <p>{{ $pengaduan->lokasi }}</p>
                                    @if ($pengaduan->maps_url)
                                        <a href="{{ $pengaduan->maps_url }}" target="_blank" rel="noopener" class="mt-2 inline-flex text-xs font-bold text-emerald-700 hover:text-emerald-900">Buka Maps</a>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-4">
                                    <span class="rounded px-3 py-1 text-xs font-bold {{ $statusClass[$pengaduan->status] ?? $statusClass['baru'] }}">
                                        {{ $pengaduan->status_label }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-complaint-modal-open="complaint-{{ $pengaduan->id }}" class="group relative inline-flex size-10 items-center justify-center rounded border border-slate-200 text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700" aria-label="Tindak lanjut">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                            </svg>
                                            <span class="pointer-events-none absolute -top-10 right-0 z-10 whitespace-nowrap rounded bg-slate-950 px-2.5 py-1.5 text-xs font-semibold text-white opacity-0 shadow transition group-hover:opacity-100">Tindak lanjut</span>
                                        </button>
                                        <a href="{{ route('pengaduan.show', $pengaduan) }}" target="_blank" class="group relative inline-flex size-10 items-center justify-center rounded border border-slate-200 text-slate-700 transition hover:border-sky-200 hover:bg-sky-50 hover:text-sky-700" aria-label="Lihat public">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12Z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                            <span class="pointer-events-none absolute -top-10 right-0 z-10 whitespace-nowrap rounded bg-slate-950 px-2.5 py-1.5 text-xs font-semibold text-white opacity-0 shadow transition group-hover:opacity-100">Lihat public</span>
                                        </a>
                                        <form method="POST" action="{{ route('admin.pengaduan.destroy', $pengaduan) }}" data-delete-form data-delete-title="Hapus pengaduan?" data-delete-message="Pengaduan dan foto terkait akan dihapus permanen dari halaman ini.">
                                            @csrf
                                            @method('DELETE')
                                            <button class="group relative inline-flex size-10 items-center justify-center rounded border border-red-200 text-red-700 transition hover:bg-red-50" aria-label="Hapus pengaduan">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M3 6h18" />
                                                    <path d="M8 6V4h8v2" />
                                                    <path d="M19 6l-1 14H6L5 6" />
                                                </svg>
                                                <span class="pointer-events-none absolute -top-10 right-0 z-10 whitespace-nowrap rounded bg-slate-950 px-2.5 py-1.5 text-xs font-semibold text-white opacity-0 shadow transition group-hover:opacity-100">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada pengaduan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <div>
            {{ $pengaduans->links() }}
        </div>

        @foreach ($pengaduans as $pengaduan)
            <div id="complaint-{{ $pengaduan->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 px-4" data-complaint-modal>
                <div class="max-h-[92vh] w-full max-w-3xl overflow-y-auto rounded-lg bg-white p-6 shadow-xl">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">{{ $pengaduan->nomor }}</p>
                            <h3 class="mt-1 text-xl font-bold text-slate-950">Tindak Lanjut Pengaduan</h3>
                        </div>
                        <button type="button" data-complaint-modal-close="complaint-{{ $pengaduan->id }}" class="rounded p-2 text-slate-500 hover:bg-slate-100">x</button>
                    </div>

                    <div class="mt-5 grid gap-5 md:grid-cols-[0.9fr_1.1fr]">
                        <div class="space-y-4">
                            <div class="rounded border border-slate-200 bg-slate-50 p-4">
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Laporan Warga</p>
                                <p class="mt-3 leading-7 text-slate-700">{{ $pengaduan->isi }}</p>
                                <p class="mt-3 text-sm font-semibold text-slate-600">Lokasi: {{ $pengaduan->lokasi }}</p>
                                @if ($pengaduan->maps_url)
                                    <a href="{{ $pengaduan->maps_url }}" target="_blank" rel="noopener" class="mt-3 inline-flex rounded bg-emerald-700 px-3 py-2 text-sm font-bold text-white transition hover:bg-emerald-800">Buka Titik Maps</a>
                                    <p class="mt-2 text-xs text-slate-500">{{ $pengaduan->latitude }}, {{ $pengaduan->longitude }}</p>
                                @endif
                            </div>
                            @if ($pengaduan->foto)
                                <img src="{{ asset('storage/'.$pengaduan->foto) }}" alt="Foto pengaduan" class="aspect-video w-full rounded object-cover">
                            @endif
                        </div>

                        <form method="POST" action="{{ route('admin.pengaduan.update', $pengaduan) }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <label class="block">
                                <span class="text-sm font-semibold text-slate-700">Status</span>
                                <select name="status" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" required>
                                    <option value="baru" @selected($pengaduan->status === 'baru')>Baru</option>
                                    <option value="diproses" @selected($pengaduan->status === 'diproses')>Diproses</option>
                                    <option value="selesai" @selected($pengaduan->status === 'selesai')>Selesai</option>
                                </select>
                            </label>
                            <label class="block">
                                <span class="text-sm font-semibold text-slate-700">Respon / Tindak Lanjut</span>
                                <textarea name="respon" rows="5" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">{{ $pengaduan->respon }}</textarea>
                            </label>
                            @if ($pengaduan->foto_tindak_lanjut)
                                <div>
                                    <span class="text-sm font-semibold text-slate-700">Bukti saat ini</span>
                                    <img src="{{ asset('storage/'.$pengaduan->foto_tindak_lanjut) }}" alt="Bukti tindak lanjut" class="mt-2 aspect-video w-full rounded object-cover">
                                </div>
                            @endif
                            <label class="block">
                                <span class="text-sm font-semibold text-slate-700">Upload Bukti Foto</span>
                                <input type="file" name="foto_tindak_lanjut" accept="image/*" class="mt-2 w-full rounded border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm file:mr-3 file:rounded file:border-0 file:bg-emerald-700 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-emerald-800">
                            </label>
                            <button class="w-full rounded bg-emerald-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-800">Simpan Tindak Lanjut</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <script>
        document.querySelectorAll('[data-complaint-modal-open]').forEach((button) => {
            button.addEventListener('click', () => {
                const modal = document.querySelector(`#${button.dataset.complaintModalOpen}`);
                modal?.classList.remove('hidden');
                modal?.classList.add('flex');
            });
        });

        document.querySelectorAll('[data-complaint-modal-close]').forEach((button) => {
            button.addEventListener('click', () => {
                const modal = document.querySelector(`#${button.dataset.complaintModalClose}`);
                modal?.classList.add('hidden');
                modal?.classList.remove('flex');
            });
        });

        document.querySelectorAll('[data-complaint-modal]').forEach((modal) => {
            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        });
    </script>
@endsection
