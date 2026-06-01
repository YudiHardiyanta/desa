<?php

namespace App\Http\Controllers;

use App\Models\GalleryCollection;
use App\Models\GalleryPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $collections = GalleryCollection::with(['photos' => fn ($query) => $query->latest()])
            ->latest()
            ->get();
        $standalonePhotos = GalleryPhoto::whereNull('gallery_collection_id')
            ->latest()
            ->get();

        return view('admin.galeri.index', compact('collections', 'standalonePhotos'));
    }

    public function showCollection(GalleryCollection $collection): View
    {
        $collection->load(['photos' => fn ($query) => $query->with('collection')->latest()]);
        $collections = GalleryCollection::latest()->get();

        return view('admin.galeri.show', compact('collection', 'collections'));
    }

    public function storeCollection(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        GalleryCollection::create($validated + [
            'user_id' => Auth::id(),
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Collection galeri berhasil dibuat.');
    }

    public function updateCollection(Request $request, GalleryCollection $collection): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $collection->update($validated + [
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Collection galeri berhasil diperbarui.');
    }

    public function destroyCollection(GalleryCollection $collection): RedirectResponse
    {
        $collection->photos()->update(['gallery_collection_id' => null]);
        $collection->delete();

        return back()->with('success', 'Collection galeri berhasil dihapus. Foto di dalamnya dipindahkan menjadi foto tanpa collection.');
    }

    public function storePhotos(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'gallery_collection_id' => ['nullable', 'exists:gallery_collections,id'],
            'judul' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'photos' => ['required', 'array', 'min:1'],
            'photos.*' => ['image', 'max:4096'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        foreach ($request->file('photos', []) as $photo) {
            GalleryPhoto::create([
                'user_id' => Auth::id(),
                'gallery_collection_id' => $validated['gallery_collection_id'] ?? null,
                'judul' => $validated['judul'] ?: pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME),
                'deskripsi' => $validated['deskripsi'] ?? null,
                'path' => $photo->store('galeri', 'public'),
                'is_active' => $request->boolean('is_active'),
            ]);
        }

        return back()->with('success', 'Foto galeri berhasil diupload.');
    }

    public function updatePhoto(Request $request, GalleryPhoto $photo): RedirectResponse
    {
        $validated = $request->validate([
            'gallery_collection_id' => ['nullable', 'exists:gallery_collections,id'],
            'judul' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $photo->update($validated + [
            'gallery_collection_id' => $validated['gallery_collection_id'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function togglePhoto(GalleryPhoto $photo): RedirectResponse
    {
        $photo->update(['is_active' => ! $photo->is_active]);

        return back()->with('success', $photo->is_active ? 'Foto galeri ditampilkan.' : 'Foto galeri disembunyikan.');
    }

    public function destroyPhoto(GalleryPhoto $photo): RedirectResponse
    {
        Storage::disk('public')->delete($photo->path);
        $photo->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }
}
