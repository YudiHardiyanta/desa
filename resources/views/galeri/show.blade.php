<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $collection->judul }} - Galeri Desa Pelaga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-emerald-50 text-slate-900 antialiased">
    <header class="w-full border-b border-emerald-100 bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-5 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <span class="grid size-12 place-items-center rounded bg-gradient-to-br from-lime-300 to-emerald-500 font-bold text-emerald-950">DP</span>
                <span>
                    <span class="block text-sm font-semibold leading-tight text-slate-600">Pemerintah Desa</span>
                    <span class="block text-xl font-bold leading-tight text-emerald-950">Pelaga</span>
                </span>
            </a>
            <div class="flex gap-2">
                <a href="{{ route('galeri.index') }}" class="rounded border border-emerald-100 px-4 py-3 text-sm font-bold text-emerald-800 transition hover:bg-emerald-50">Galeri</a>
                <a href="{{ url('/') }}" class="rounded bg-emerald-700 px-4 py-3 text-sm font-bold text-white">Home</a>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <section>
            <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Collection Galeri</p>
            <h1 class="mt-3 text-3xl font-bold text-slate-950 sm:text-4xl">{{ $collection->judul }}</h1>
            <p class="mt-4 max-w-2xl leading-7 text-slate-600">{{ $collection->deskripsi ?: 'Dokumentasi kegiatan Desa Pelaga.' }}</p>
        </section>

        <section class="mt-10 grid grid-cols-2 gap-3 md:grid-cols-4">
            @forelse ($photos as $photo)
                <a href="{{ asset('storage/'.$photo->path) }}" target="_blank" class="group block overflow-hidden rounded-lg border border-emerald-100 bg-white">
                    <img src="{{ asset('storage/'.$photo->path) }}" alt="{{ $photo->judul ?: $collection->judul }}" class="aspect-[4/3] w-full object-cover transition group-hover:scale-[1.03]" loading="lazy">
                    <div class="p-3">
                        <p class="truncate text-sm font-bold text-slate-950">{{ $photo->judul ?: 'Foto Desa Pelaga' }}</p>
                        @if ($photo->deskripsi)
                            <p class="mt-1 line-clamp-2 text-xs leading-5 text-slate-500">{{ $photo->deskripsi }}</p>
                        @endif
                    </div>
                </a>
            @empty
                <div class="rounded-lg border border-emerald-100 bg-white p-6 text-slate-600 md:col-span-4">Belum ada foto aktif dalam collection ini.</div>
            @endforelse
        </section>

        <div class="mt-8">{{ $photos->links() }}</div>
    </main>
</body>
</html>
