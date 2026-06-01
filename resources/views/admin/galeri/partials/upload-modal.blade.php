<div id="upload-photo-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 px-4" data-gallery-modal>
    <div class="w-full max-w-2xl rounded-lg bg-white p-6 shadow-xl">
        <div class="flex items-center justify-between gap-4">
            <h3 class="text-lg font-bold text-slate-950">Upload Foto</h3>
            <button type="button" data-gallery-modal-close="upload-photo-modal" class="rounded p-2 text-slate-500 hover:bg-slate-100">x</button>
        </div>
        <form method="POST" action="{{ route('admin.galeri.photos.store') }}" enctype="multipart/form-data" class="mt-5 space-y-4">
            @csrf
            <div class="grid gap-4 md:grid-cols-2">
                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Folder Tujuan</span>
                    <select name="gallery_collection_id" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                        <option value="">File utama / tanpa folder</option>
                        @foreach ($collections as $collection)
                            <option value="{{ $collection->id }}" @selected(isset($selectedCollection) && $selectedCollection->id === $collection->id)>{{ $collection->judul }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Judul Default</span>
                    <input type="text" name="judul" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" placeholder="Opsional">
                </label>
            </div>
            <label class="block">
                <span class="text-sm font-semibold text-slate-700">Deskripsi Default</span>
                <textarea name="deskripsi" rows="2" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"></textarea>
            </label>
            <label class="block rounded-lg border border-dashed border-slate-300 bg-slate-50 p-5">
                <span class="text-sm font-semibold text-slate-700">Pilih Banyak Foto</span>
                <input type="file" name="photos[]" accept="image/*" multiple required class="mt-3 w-full text-sm file:mr-3 file:rounded file:border-0 file:bg-emerald-700 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-emerald-800">
            </label>
            <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                <input type="checkbox" name="is_active" value="1" checked class="size-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-600">
                Tampilkan di public
            </label>
            <button class="w-full rounded bg-emerald-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-800">Upload</button>
        </form>
    </div>
</div>
