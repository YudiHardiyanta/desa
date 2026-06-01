<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berita Desa Pelaga</title>
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
                @auth
                    <details class="relative">
                        <summary class="grid size-10 cursor-pointer list-none place-items-center rounded border border-emerald-100 bg-emerald-50 text-sm font-bold text-emerald-800">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </summary>
                        <div class="absolute right-0 mt-3 w-64 rounded-lg border border-emerald-100 bg-white p-4 text-slate-700 shadow-xl">
                            <p class="text-xs font-bold uppercase tracking-wider text-emerald-700">Sedang Login</p>
                            <p class="mt-2 font-bold text-slate-950">{{ auth()->user()->name }}</p>
                            <p class="mt-1 break-all text-sm text-slate-500">{{ auth()->user()->email }}</p>
                            <div class="mt-4 grid gap-2">
                                <a href="{{ route('admin.dashboard') }}" class="rounded bg-emerald-700 px-3 py-2 text-center text-sm font-semibold text-white transition hover:bg-emerald-800">Dashboard Admin</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full rounded border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    </details>
                @else
                    <a href="{{ route('login') }}" class="rounded bg-emerald-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-800">Login</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Berita Desa</p>
            <h1 class="mt-3 text-3xl font-bold text-slate-950 sm:text-4xl">Semua Berita Desa Pelaga</h1>
            <p class="mt-4 leading-7 text-slate-600">Kumpulan informasi terbaru yang diterbitkan oleh Pemerintah Desa Pelaga.</p>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-3">
            @forelse ($beritas as $berita)
                <a href="{{ route('berita.show', $berita) }}" class="block overflow-hidden rounded-lg border border-emerald-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <img
                        src="{{ $berita->gambar_headline ? asset('storage/'.$berita->gambar_headline) : 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=700&q=70' }}"
                        alt="{{ $berita->judul }}"
                        class="h-48 w-full object-cover"
                        width="700"
                        height="467"
                        loading="lazy"
                        decoding="async"
                    >
                    <div class="p-5">
                        <p class="text-sm font-semibold text-emerald-700">{{ $berita->tanggal_berita->translatedFormat('d M Y') }} · {{ $berita->penerbit }}</p>
                        <h2 class="mt-2 text-lg font-bold leading-7 text-slate-950">{{ $berita->judul }}</h2>
                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">{{ strip_tags($berita->isi) }}</p>
                    </div>
                </a>
            @empty
                <div class="rounded-lg border border-emerald-100 bg-white p-6 text-slate-600 md:col-span-3">
                    Belum ada berita desa yang diterbitkan.
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $beritas->links() }}
        </div>
    </main>
</body>
</html>
