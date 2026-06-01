<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(): View
    {
        $beritas = Berita::query()
            ->latest('tanggal_berita')
            ->latest()
            ->get();

        return view('admin.berita.index', compact('beritas'));
    }

    public function create(): View
    {
        return view('admin.berita.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['nullable', 'date'],
            'isi' => ['required', 'string'],
            'gambar_headline' => ['nullable', 'image', 'max:2048'],
            'penerbit' => ['required', 'string', 'max:255'],
            'tags' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $gambarHeadline = $request->file('gambar_headline')
            ? $request->file('gambar_headline')->store('berita', 'public')
            : null;

        Berita::create([
            'user_id' => Auth::id(),
            'judul' => $validated['judul'],
            'tanggal_berita' => $validated['tanggal'] ?? Carbon::today()->toDateString(),
            'isi' => $validated['isi'],
            'gambar_headline' => $gambarHeadline,
            'penerbit' => $validated['penerbit'],
            'tags' => collect(explode(',', $validated['tags'] ?? ''))
                ->map(fn (string $tag): string => (string) Str::of($tag)->trim()->lower())
                ->filter()
                ->values()
                ->all(),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita desa berhasil disimpan.');
    }

    public function edit(Berita $berita): View
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['nullable', 'date'],
            'isi' => ['required', 'string'],
            'gambar_headline' => ['nullable', 'image', 'max:2048'],
            'penerbit' => ['required', 'string', 'max:255'],
            'tags' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('gambar_headline')) {
            if ($berita->gambar_headline) {
                Storage::disk('public')->delete($berita->gambar_headline);
            }

            $berita->gambar_headline = $request->file('gambar_headline')->store('berita', 'public');
        }

        $berita->fill([
            'judul' => $validated['judul'],
            'tanggal_berita' => $validated['tanggal'] ?? Carbon::today()->toDateString(),
            'isi' => $validated['isi'],
            'penerbit' => $validated['penerbit'],
            'tags' => collect(explode(',', $validated['tags'] ?? ''))
                ->map(fn (string $tag): string => (string) Str::of($tag)->trim()->lower())
                ->filter()
                ->values()
                ->all(),
            'is_active' => $request->boolean('is_active'),
        ])->save();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita desa berhasil diperbarui.');
    }

    public function toggle(Berita $berita): RedirectResponse
    {
        $berita->update(['is_active' => ! $berita->is_active]);

        return back()->with('success', $berita->is_active ? 'Berita ditampilkan.' : 'Berita disembunyikan.');
    }

    public function destroy(Berita $berita): RedirectResponse
    {
        if ($berita->gambar_headline) {
            Storage::disk('public')->delete($berita->gambar_headline);
        }

        $berita->delete();

        return back()->with('success', 'Berita desa berhasil dihapus.');
    }
}
