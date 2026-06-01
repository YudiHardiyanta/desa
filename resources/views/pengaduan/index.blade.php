<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaduan Desa Pelaga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-emerald-50 text-slate-900 antialiased">
    <header class="w-full border-b border-emerald-100 bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <span class="grid size-10 place-items-center rounded bg-gradient-to-br from-lime-300 to-emerald-500 font-bold text-emerald-950">DP</span>
                <span>
                    <span class="block text-sm font-semibold leading-tight text-slate-600">Pemerintah Desa</span>
                    <span class="block text-lg font-bold leading-tight text-emerald-950">Pelaga</span>
                </span>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="rounded border border-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-800 transition hover:bg-emerald-50">Home</a>
                <a href="{{ url('/#pengaduan') }}" class="rounded bg-emerald-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-800">Buat Aduan</a>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div class="max-w-2xl">
                <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Pengaduan Warga</p>
                <h1 class="mt-3 text-3xl font-bold text-slate-950 sm:text-4xl">Daftar aduan dan respon Desa Pelaga.</h1>
                <p class="mt-4 leading-7 text-slate-600">Pantau aduan warga, status penanganan, dan tindak lanjut yang telah diberikan oleh admin desa.</p>
            </div>
        </div>

        <form method="GET" class="mt-8 grid gap-3 rounded-lg border border-emerald-100 bg-white p-4 shadow-sm md:grid-cols-[1fr_180px_auto]">
            <input name="q" value="{{ request('q') }}" type="search" class="rounded border border-emerald-200 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" placeholder="Cari nomor, lokasi, tag...">
            <select name="status" class="rounded border border-emerald-200 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                <option value="">Semua Status</option>
                <option value="baru" @selected(request('status') === 'baru')>Baru</option>
                <option value="diproses" @selected(request('status') === 'diproses')>Diproses</option>
                <option value="selesai" @selected(request('status') === 'selesai')>Selesai</option>
            </select>
            <button class="rounded bg-emerald-700 px-5 py-3 font-semibold text-white transition hover:bg-emerald-800">Cari</button>
        </form>

        <div class="mt-10 grid gap-5 md:grid-cols-3">
            @forelse ($pengaduans as $pengaduan)
                <a href="{{ route('pengaduan.show', $pengaduan) }}" class="block rounded-lg border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-start justify-between gap-3">
                        <p class="font-bold text-slate-950">{{ $pengaduan->nomor }}</p>
                        <span class="shrink-0 rounded px-3 py-1 text-xs font-bold {{ $pengaduan->status === 'selesai' ? 'bg-emerald-50 text-emerald-700' : ($pengaduan->status === 'diproses' ? 'bg-sky-50 text-sky-700' : 'bg-amber-50 text-amber-700') }}">
                            {{ $pengaduan->status_label }}
                        </span>
                    </div>
                    <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">{{ $pengaduan->isi }}</p>
                    <p class="mt-3 text-sm font-semibold text-slate-700">{{ $pengaduan->lokasi }}</p>
                    @if ($pengaduan->maps_url)
                        <p class="mt-2 text-xs font-bold text-emerald-700">Geotag tersedia</p>
                    @endif
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($pengaduan->tags ?? [] as $tag)
                            <span class="rounded bg-emerald-50 px-2 py-1 text-xs font-bold text-emerald-700">#{{ $tag }}</span>
                        @endforeach
                    </div>
                    <p class="mt-4 text-xs font-semibold text-slate-400">{{ $pengaduan->created_at->translatedFormat('d M Y H:i') }}</p>
                </a>
            @empty
                <div class="rounded-lg border border-emerald-100 bg-white p-6 text-slate-600 md:col-span-3">
                    Belum ada pengaduan yang tercatat.
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $pengaduans->links() }}
        </div>
    </main>
</body>
</html>
