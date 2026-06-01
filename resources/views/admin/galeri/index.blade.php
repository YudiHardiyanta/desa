@extends('layouts.admin')

@section('title', 'Admin Galeri Desa')
@section('page-title', 'Galeri Desa')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="transition hover:text-emerald-700">Dashboard</a>
    <span>/</span>
    <span class="text-emerald-700">Galeri Desa</span>
@endsection

@section('content')
    <section class="space-y-6">
        <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Media Desa</p>
                    <h2 class="mt-1 text-2xl font-bold text-slate-950">Drive Galeri Desa</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Klik folder untuk membuka halaman foto di dalamnya.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button type="button" data-gallery-modal-open="create-folder-modal" class="inline-flex items-center gap-2 rounded border border-slate-300 bg-white px-4 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 10v6" />
                            <path d="M9 13h6" />
                            <path d="M3 6h7l2 2h9v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        </svg>
                        Folder Baru
                    </button>
                    <button type="button" data-gallery-modal-open="upload-photo-modal" class="inline-flex items-center gap-2 rounded bg-emerald-700 px-4 py-3 text-sm font-bold text-white transition hover:bg-emerald-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 3v12" />
                            <path d="m7 8 5-5 5 5" />
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" />
                        </svg>
                        Upload Foto
                    </button>
                </div>
            </div>

            <div class="mt-5 grid gap-3 sm:grid-cols-3">
                <div class="rounded border border-emerald-100 bg-emerald-50 px-4 py-3">
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-700">Folder</p>
                    <p class="mt-1 text-2xl font-black text-slate-950">{{ $collections->count() }}</p>
                </div>
                <div class="rounded border border-slate-200 bg-slate-50 px-4 py-3">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Foto</p>
                    <p class="mt-1 text-2xl font-black text-slate-950">{{ $collections->sum(fn ($collection) => $collection->photos->count()) + $standalonePhotos->count() }}</p>
                </div>
                <div class="rounded border border-lime-100 bg-lime-50 px-4 py-3">
                    <p class="text-xs font-bold uppercase tracking-wider text-lime-700">File Utama</p>
                    <p class="mt-1 text-2xl font-black text-slate-950">{{ $standalonePhotos->count() }}</p>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="rounded border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-950">Folder</h3>
                <span class="text-sm font-semibold text-slate-500">{{ $collections->count() }} folder</span>
            </div>

            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                @forelse ($collections as $collection)
                    <article class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm transition hover:border-emerald-200 hover:shadow-md">
                        <a href="{{ route('admin.galeri.collections.show', $collection) }}" class="flex min-w-0 gap-3">
                            <span class="inline-flex size-12 shrink-0 items-center justify-center rounded bg-emerald-50 text-emerald-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-7" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M3 6.75A2.75 2.75 0 0 1 5.75 4h4.1c.74 0 1.45.3 1.97.82L13 6h5.25A2.75 2.75 0 0 1 21 8.75v8.5A2.75 2.75 0 0 1 18.25 20H5.75A2.75 2.75 0 0 1 3 17.25V6.75Z" />
                                </svg>
                            </span>
                            <div class="min-w-0">
                                <p class="truncate font-bold text-slate-950">{{ $collection->judul }}</p>
                                <p class="mt-1 text-xs font-semibold text-slate-500">{{ $collection->photos->count() }} foto</p>
                                <span class="mt-2 inline-flex rounded px-2 py-1 text-[11px] font-bold {{ $collection->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $collection->is_active ? 'Public' : 'Hidden' }}
                                </span>
                            </div>
                        </a>
                        <div class="mt-4 flex gap-2 border-t border-slate-100 pt-3">
                            <button type="button" data-gallery-modal-open="edit-folder-{{ $collection->id }}" class="inline-flex size-9 items-center justify-center rounded border border-slate-200 text-slate-600 transition hover:bg-slate-50" title="Edit folder">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 20h9" />
                                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                </svg>
                            </button>
                            <form method="POST" action="{{ route('admin.galeri.collections.destroy', $collection) }}" data-delete-form data-delete-title="Hapus folder?" data-delete-message="Folder akan dihapus, tetapi foto di dalamnya dipindahkan ke file utama.">
                                @csrf
                                @method('DELETE')
                                <button class="inline-flex size-9 items-center justify-center rounded border border-red-200 text-red-700 transition hover:bg-red-50" title="Hapus folder">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 6h18" />
                                        <path d="M8 6V4h8v2" />
                                        <path d="M19 6l-1 14H6L5 6" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </article>

                    @include('admin.galeri.partials.folder-modal', ['collection' => $collection])
                @empty
                    <div class="rounded-lg border border-dashed border-slate-200 bg-white p-6 text-slate-500 md:col-span-2 xl:col-span-4">Belum ada folder galeri.</div>
                @endforelse
            </div>
        </section>

        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-950">File Utama</h3>
                <span class="text-sm font-semibold text-slate-500">{{ $standalonePhotos->count() }} foto tanpa folder</span>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-5">
                @forelse ($standalonePhotos as $photo)
                    @include('admin.galeri.partials.photo-card', ['photo' => $photo, 'collections' => $collections])
                @empty
                    <div class="rounded-lg border border-dashed border-slate-200 bg-white p-6 text-slate-500 sm:col-span-2 lg:col-span-3 2xl:col-span-5">Belum ada foto di file utama.</div>
                @endforelse
            </div>
        </section>

        @include('admin.galeri.partials.create-folder-modal')
        @include('admin.galeri.partials.upload-modal', ['collections' => $collections])
    </section>

    @include('admin.galeri.partials.modal-script')
@endsection
