<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    public function publicIndex(Request $request): View
    {
        $query = Pengaduan::query()->latest();

        if ($request->filled('q')) {
            $keyword = $request->string('q')->toString();
            $query->where(function ($builder) use ($keyword) {
                $builder->where('nomor', 'like', "%{$keyword}%")
                    ->orWhere('isi', 'like', "%{$keyword}%")
                    ->orWhere('lokasi', 'like', "%{$keyword}%")
                    ->orWhere('tags', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        $pengaduans = $query->paginate(9)->withQueryString();

        return view('pengaduan.index', compact('pengaduans'));
    }

    public function publicShow(Pengaduan $pengaduan): View
    {
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kontak' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string', 'max:3000'],
            'lokasi' => ['required', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'foto' => ['nullable', 'image', 'max:4096'],
            'tags' => ['nullable', 'string', 'max:255'],
        ]);

        $pengaduan = Pengaduan::create([
            'nomor' => $this->generateNomor(),
            'nama' => $validated['nama'],
            'kontak' => $validated['kontak'],
            'isi' => $validated['isi'],
            'lokasi' => $validated['lokasi'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'foto' => $request->file('foto')?->store('pengaduan', 'public'),
            'tags' => $this->parseTags($validated['tags'] ?? ''),
            'status' => 'baru',
        ]);

        return redirect()
            ->route('pengaduan.show', $pengaduan)
            ->with('success', 'Pengaduan berhasil dikirim dengan nomor '.$pengaduan->nomor.'.');
    }

    public function adminIndex(Request $request): View
    {
        $query = Pengaduan::query()->latest();

        if ($request->filled('q')) {
            $keyword = $request->string('q')->toString();
            $query->where(function ($builder) use ($keyword) {
                $builder->where('nomor', 'like', "%{$keyword}%")
                    ->orWhere('nama', 'like', "%{$keyword}%")
                    ->orWhere('kontak', 'like', "%{$keyword}%")
                    ->orWhere('isi', 'like', "%{$keyword}%")
                    ->orWhere('lokasi', 'like', "%{$keyword}%")
                    ->orWhere('tags', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        $pengaduans = $query->paginate(12)->withQueryString();

        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function update(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:baru,diproses,selesai'],
            'respon' => ['nullable', 'string', 'max:3000'],
            'foto_tindak_lanjut' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('foto_tindak_lanjut')) {
            if ($pengaduan->foto_tindak_lanjut) {
                Storage::disk('public')->delete($pengaduan->foto_tindak_lanjut);
            }

            $pengaduan->foto_tindak_lanjut = $request->file('foto_tindak_lanjut')->store('pengaduan/tindak-lanjut', 'public');
        }

        $pengaduan->fill([
            'user_id' => Auth::id(),
            'status' => $validated['status'],
            'respon' => $validated['respon'] ?? null,
            'ditindaklanjuti_pada' => $validated['status'] === 'baru' ? null : now(),
        ])->save();

        return back()->with('success', 'Tindak lanjut pengaduan berhasil diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan): RedirectResponse
    {
        Storage::disk('public')->delete(array_filter([
            $pengaduan->foto,
            $pengaduan->foto_tindak_lanjut,
        ]));

        $pengaduan->delete();

        return back()->with('success', 'Pengaduan berhasil dihapus.');
    }

    private function generateNomor(): string
    {
        $now = Carbon::now();
        $prefix = 'PELAGA/ADUAN/'.$now->format('Y/m');
        $count = Pengaduan::where('nomor', 'like', $prefix.'/%')->count() + 1;

        return $prefix.'/'.str_pad((string) $count, 4, '0', STR_PAD_LEFT);
    }

    private function parseTags(string $tags): array
    {
        return collect(explode(',', $tags))
            ->map(fn (string $tag): string => (string) Str::of($tag)->trim()->lower())
            ->filter()
            ->values()
            ->all();
    }
}
