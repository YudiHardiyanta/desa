<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri Desa Pelaga</title>
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
                <a href="{{ url('/') }}" class="rounded border border-emerald-100 px-4 py-3 text-sm font-bold text-emerald-800 transition hover:bg-emerald-50">Home</a>
                <a href="{{ route('galeri.index') }}" class="rounded bg-emerald-700 px-4 py-3 text-sm font-bold text-white">Galeri</a>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <section>
            <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Galeri Desa</p>
            <h1 class="mt-3 text-3xl font-bold text-slate-950 sm:text-4xl">Collection Dokumentasi Desa Pelaga</h1>
            <p class="mt-4 max-w-2xl leading-7 text-slate-600">Lihat dokumentasi kegiatan desa berdasarkan collection atau foto tunggal yang diterbitkan.</p>
        </section>

        <section class="mt-10 space-y-5">
            <h2 class="text-xl font-bold text-slate-950">Collection</h2>
            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($collections as $collection)
                    @php $coverPhoto = $collection->activePhotos->first(); @endphp
                    <a href="{{ route('galeri.show', $collection) }}" class="block overflow-hidden rounded-lg border border-emerald-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        @if ($coverPhoto)
                            <img src="{{ asset('storage/'.$coverPhoto->path) }}" alt="{{ $collection->judul }}" class="h-56 w-full object-cover" loading="lazy">
                        @else
                            <div class="grid h-56 place-items-center bg-emerald-50 text-sm font-bold text-emerald-700">Belum ada foto</div>
                        @endif
                        <div class="p-5">
                            <p class="text-sm font-bold text-emerald-700">{{ $collection->active_photos_count }} foto</p>
                            <h3 class="mt-2 text-xl font-bold text-slate-950">{{ $collection->judul }}</h3>
                            <p class="mt-3 line-clamp-2 text-sm leading-6 text-slate-600">{{ $collection->deskripsi ?: 'Collection dokumentasi Desa Pelaga.' }}</p>
                        </div>
                    </a>
                @empty
                    <div class="rounded-lg border border-emerald-100 bg-white p-6 text-slate-600 md:col-span-2 xl:col-span-3">Belum ada collection galeri.</div>
                @endforelse
            </div>
            <div>{{ $collections->links() }}</div>
        </section>

        <section class="mt-14 space-y-5">
            <h2 class="text-xl font-bold text-slate-950">Foto Tanpa Collection</h2>
            <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
                @forelse ($standalonePhotos as $photo)
                    <a href="{{ asset('storage/'.$photo->path) }}" target="_blank" class="group block overflow-hidden rounded-lg border border-emerald-100 bg-white">
                        <img src="{{ asset('storage/'.$photo->path) }}" alt="{{ $photo->judul ?: 'Galeri Desa Pelaga' }}" class="aspect-[4/3] w-full object-cover transition group-hover:scale-[1.03]" loading="lazy">
                        <div class="p-3">
                            <p class="truncate text-sm font-bold text-slate-950">{{ $photo->judul ?: 'Foto Desa Pelaga' }}</p>
                        </div>
                    </a>
                @empty
                    <div class="rounded-lg border border-emerald-100 bg-white p-6 text-slate-600 md:col-span-4">Belum ada foto tanpa collection.</div>
                @endforelse
            </div>
            <div>{{ $standalonePhotos->links() }}</div>
        </section>
    </main>
</body>
</html>
