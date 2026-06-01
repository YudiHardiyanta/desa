@extends('layouts.admin')

@section('title', $collection->judul.' - Galeri Desa')
@section('page-title', $collection->judul)
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="transition hover:text-emerald-700">Dashboard</a>
    <span>/</span>
    <a href="{{ route('admin.galeri.index') }}" class="transition hover:text-emerald-700">Galeri Desa</a>
    <span>/</span>
    <span class="text-emerald-700">{{ $collection->judul }}</span>
@endsection

@section('content')
    <section class="space-y-6">
        <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex min-w-0 gap-4">
                    <a href="{{ route('admin.galeri.index') }}" class="inline-flex size-11 shrink-0 items-center justify-center rounded border border-slate-200 text-slate-600 transition hover:bg-slate-50" title="Kembali">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                    </a>
                    <div class="min-w-0">
                        <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Folder Galeri</p>
                        <h2 class="mt-1 truncate text-2xl font-bold text-slate-950">{{ $collection->judul }}</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-600">{{ $collection->deskripsi ?: 'Tidak ada deskripsi folder.' }}</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button type="button" data-gallery-modal-open="edit-folder-{{ $collection->id }}" class="inline-flex items-center gap-2 rounded border border-slate-300 bg-white px-4 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 20h9" />
                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                        </svg>
                        Edit Folder
                    </button>
                    <button type="button" data-gallery-modal-open="upload-photo-modal" class="inline-flex items-center gap-2 rounded bg-emerald-700 px-4 py-3 text-sm font-bold text-white transition hover:bg-emerald-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 3v12" />
                            <path d="m7 8 5-5 5 5" />
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" />
                        </svg>
                        Upload ke Folder Ini
                    </button>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                <span class="rounded px-3 py-1 text-xs font-bold {{ $collection->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                    {{ $collection->is_active ? 'Public' : 'Hidden' }}
                </span>
                <span class="rounded bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">{{ $collection->photos->count() }} foto</span>
            </div>
        </div>

        @if ($errors->any())
            <div class="rounded border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-950">Foto Dalam Folder</h3>
                <span class="text-sm font-semibold text-slate-500">{{ $collection->photos->count() }} foto</span>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-5">
                @forelse ($collection->photos as $photo)
                    @include('admin.galeri.partials.photo-card', ['photo' => $photo, 'collections' => $collections])
                @empty
                    <div class="rounded-lg border border-dashed border-slate-200 bg-white p-6 text-slate-500 sm:col-span-2 lg:col-span-3 2xl:col-span-5">Folder ini masih kosong.</div>
                @endforelse
            </div>
        </section>

        @include('admin.galeri.partials.folder-modal', ['collection' => $collection])
        @include('admin.galeri.partials.upload-modal', ['collections' => $collections, 'selectedCollection' => $collection])
    </section>

    @include('admin.galeri.partials.modal-script')
@endsection
