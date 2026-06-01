<article class="group overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm transition hover:border-emerald-200 hover:shadow-md">
    <div class="relative">
        <img src="{{ asset('storage/'.$photo->path) }}" alt="{{ $photo->judul ?: 'Foto galeri' }}" class="aspect-[4/3] w-full object-cover" loading="lazy">
        <div class="absolute inset-x-2 top-2 flex justify-end gap-1 opacity-100 transition md:opacity-0 md:group-hover:opacity-100">
            <button type="button" data-gallery-modal-open="edit-photo-{{ $photo->id }}" class="inline-flex size-8 items-center justify-center rounded bg-white/95 text-slate-700 shadow-sm transition hover:bg-emerald-50 hover:text-emerald-700" title="Edit foto">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 20h9" />
                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                </svg>
            </button>
            <form method="POST" action="{{ route('admin.galeri.photos.toggle', $photo) }}">
                @csrf
                @method('PATCH')
                <button class="inline-flex size-8 items-center justify-center rounded bg-white/95 text-slate-700 shadow-sm transition hover:bg-amber-50 hover:text-amber-700" title="{{ $photo->is_active ? 'Sembunyikan foto' : 'Tampilkan foto' }}">
                    @if ($photo->is_active)
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m2 2 20 20" />
                            <path d="M10.6 10.6A2 2 0 0 0 12 14a2 2 0 0 0 1.4-.6" />
                            <path d="M17.9 17.9C16.2 18.7 14.2 19 12 19 5 19 2 12 2 12a18.5 18.5 0 0 1 5.1-5.9" />
                            <path d="M9.9 4.2A11.5 11.5 0 0 1 12 4c7 0 10 8 10 8a18.7 18.7 0 0 1-2.4 3.5" />
                        </svg>
                    @endif
                </button>
            </form>
            <form method="POST" action="{{ route('admin.galeri.photos.destroy', $photo) }}" data-delete-form data-delete-title="Hapus foto?" data-delete-message="File foto akan dihapus dari storage dan tidak bisa dikembalikan dari halaman ini.">
                @csrf
                @method('DELETE')
                <button class="inline-flex size-8 items-center justify-center rounded bg-white/95 text-red-700 shadow-sm transition hover:bg-red-50" title="Hapus foto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 6h18" />
                        <path d="M8 6V4h8v2" />
                        <path d="M19 6l-1 14H6L5 6" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
    <div class="p-3">
        <div class="flex items-start justify-between gap-2">
            <div class="min-w-0">
                <p class="truncate text-sm font-bold text-slate-950">{{ $photo->judul ?: 'Tanpa judul' }}</p>
                <p class="mt-1 truncate text-xs text-slate-500">{{ $photo->collection?->judul ?: 'File utama' }}</p>
            </div>
            <span class="mt-0.5 size-2 shrink-0 rounded-full {{ $photo->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}" title="{{ $photo->is_active ? 'Public' : 'Hidden' }}"></span>
        </div>
    </div>
</article>

<div id="edit-photo-{{ $photo->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 px-4" data-gallery-modal>
    <div class="w-full max-w-2xl rounded-lg bg-white p-6 shadow-xl">
        <div class="flex items-center justify-between gap-4">
            <h3 class="text-lg font-bold text-slate-950">Edit Foto</h3>
            <button type="button" data-gallery-modal-close="edit-photo-{{ $photo->id }}" class="rounded p-2 text-slate-500 hover:bg-slate-100">x</button>
        </div>
        <div class="mt-5 grid gap-5 md:grid-cols-[220px_1fr]">
            <img src="{{ asset('storage/'.$photo->path) }}" alt="{{ $photo->judul ?: 'Foto galeri' }}" class="aspect-square w-full rounded object-cover">
            <form method="POST" action="{{ route('admin.galeri.photos.update', $photo) }}" class="space-y-4">
                @csrf
                @method('PUT')
                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Judul Foto</span>
                    <input type="text" name="judul" value="{{ $photo->judul }}" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" placeholder="Judul foto">
                </label>
                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Folder</span>
                    <select name="gallery_collection_id" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                        <option value="">File utama / tanpa folder</option>
                        @foreach ($collections as $collectionOption)
                            <option value="{{ $collectionOption->id }}" @selected($photo->gallery_collection_id === $collectionOption->id)>{{ $collectionOption->judul }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Deskripsi</span>
                    <textarea name="deskripsi" rows="3" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" placeholder="Deskripsi">{{ $photo->deskripsi }}</textarea>
                </label>
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <input type="checkbox" name="is_active" value="1" @checked($photo->is_active) class="size-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-600">
                    Tampilkan di public
                </label>
                <button class="w-full rounded bg-emerald-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-800">Simpan Foto</button>
            </form>
        </div>
    </div>
</div>
