<div id="create-folder-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 px-4" data-gallery-modal>
    <div class="w-full max-w-lg rounded-lg bg-white p-6 shadow-xl">
        <div class="flex items-center justify-between gap-4">
            <h3 class="text-lg font-bold text-slate-950">Folder Baru</h3>
            <button type="button" data-gallery-modal-close="create-folder-modal" class="rounded p-2 text-slate-500 hover:bg-slate-100">x</button>
        </div>
        <form method="POST" action="{{ route('admin.galeri.collections.store') }}" class="mt-5 space-y-4">
            @csrf
            <label class="block">
                <span class="text-sm font-semibold text-slate-700">Nama Folder</span>
                <input type="text" name="judul" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" required>
            </label>
            <label class="block">
                <span class="text-sm font-semibold text-slate-700">Deskripsi</span>
                <textarea name="deskripsi" rows="3" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"></textarea>
            </label>
            <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                <input type="checkbox" name="is_active" value="1" checked class="size-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-600">
                Tampilkan di public
            </label>
            <button class="w-full rounded bg-emerald-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-800">Buat Folder</button>
        </form>
    </div>
</div>
