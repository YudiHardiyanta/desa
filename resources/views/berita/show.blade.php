<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $berita->judul }} - Desa Pelaga</title>
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
                <a href="{{ route('berita.index') }}" class="rounded bg-emerald-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-800">Berita</a>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">
        <article class="overflow-hidden rounded-lg border border-emerald-100 bg-white shadow-sm">
            <img
                src="{{ $berita->gambar_headline ? asset('storage/'.$berita->gambar_headline) : 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=1200&q=70' }}"
                alt="{{ $berita->judul }}"
                class="h-80 w-full object-cover"
                width="1200"
                height="800"
                loading="eager"
                decoding="async"
            >
            <div class="p-6 sm:p-8">
                <p class="text-sm font-semibold text-emerald-700">{{ $berita->tanggal_berita->translatedFormat('d M Y') }} · {{ $berita->penerbit }}</p>
                <h1 class="mt-3 text-3xl font-bold leading-tight text-slate-950 sm:text-4xl">{{ $berita->judul }}</h1>

                @if ($berita->tags)
                    <div class="mt-5 flex flex-wrap gap-2">
                        @foreach ($berita->tags as $tag)
                            <span class="rounded bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-800">#{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="mt-8 max-w-none space-y-4 text-base leading-8 text-slate-700 [&_a]:font-semibold [&_a]:text-emerald-700 [&_blockquote]:border-l-4 [&_blockquote]:border-emerald-200 [&_blockquote]:pl-4 [&_h2]:text-2xl [&_h2]:font-bold [&_h3]:text-xl [&_h3]:font-bold [&_ol]:list-decimal [&_ol]:pl-6 [&_p]:leading-8 [&_ul]:list-disc [&_ul]:pl-6">
                    {!! $berita->isi !!}
                </div>
            </div>
        </article>

        @if ($beritaLainnya->isNotEmpty())
            <section class="mt-12">
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Berita Lainnya</p>
                        <h2 class="mt-2 text-2xl font-bold text-slate-950">Informasi terbaru lainnya</h2>
                    </div>
                    <a href="{{ route('berita.index') }}" class="text-sm font-semibold text-emerald-700 transition hover:text-emerald-900">Lihat semua</a>
                </div>

                <div class="mt-6 grid gap-5 md:grid-cols-3">
                    @foreach ($beritaLainnya as $item)
                        <a href="{{ route('berita.show', $item) }}" class="block overflow-hidden rounded-lg border border-emerald-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                            <img
                                src="{{ $item->gambar_headline ? asset('storage/'.$item->gambar_headline) : 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=700&q=70' }}"
                                alt="{{ $item->judul }}"
                                class="h-40 w-full object-cover"
                                width="700"
                                height="467"
                                loading="lazy"
                                decoding="async"
                            >
                            <div class="p-4">
                                <p class="text-sm font-semibold text-emerald-700">{{ $item->tanggal_berita->translatedFormat('d M Y') }}</p>
                                <h3 class="mt-2 font-bold leading-6 text-slate-950">{{ $item->judul }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
</body>
</html>
