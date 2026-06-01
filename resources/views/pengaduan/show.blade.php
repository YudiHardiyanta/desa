<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pengaduan->nomor }} - Pengaduan Desa Pelaga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-emerald-50 text-slate-900 antialiased">
    @if (session('success'))
        <div class="border-b border-emerald-100 bg-emerald-700 px-4 py-3 text-center text-sm font-semibold text-white">
            {{ session('success') }}
        </div>
    @endif

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
                <a href="{{ route('pengaduan.index') }}" class="rounded border border-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-800 transition hover:bg-emerald-50">Daftar Aduan</a>
                <a href="{{ url('/') }}" class="rounded bg-emerald-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-800">Home</a>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-14 sm:px-6 lg:px-8">
        <article class="overflow-hidden rounded-lg border border-emerald-100 bg-white shadow-sm">
            <div class="border-b border-emerald-100 p-6">
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-start">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Nomor Aduan</p>
                        <h1 class="mt-2 text-2xl font-bold text-slate-950 sm:text-3xl">{{ $pengaduan->nomor }}</h1>
                    </div>
                    <span class="w-fit rounded px-3 py-1 text-sm font-bold {{ $pengaduan->status === 'selesai' ? 'bg-emerald-50 text-emerald-700' : ($pengaduan->status === 'diproses' ? 'bg-sky-50 text-sky-700' : 'bg-amber-50 text-amber-700') }}">
                        {{ $pengaduan->status_label }}
                    </span>
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($pengaduan->tags ?? [] as $tag)
                        <span class="rounded bg-emerald-50 px-2 py-1 text-xs font-bold text-emerald-700">#{{ $tag }}</span>
                    @endforeach
                </div>
            </div>

            <div class="grid gap-6 p-6 lg:grid-cols-[1fr_320px]">
                <div class="space-y-6">
                    <section>
                        <h2 class="font-bold text-slate-950">Isi Pengaduan</h2>
                        <p class="mt-3 whitespace-pre-line leading-8 text-slate-700">{{ $pengaduan->isi }}</p>
                    </section>

                    <section class="rounded-lg border border-slate-200 bg-slate-50 p-5">
                        <h2 class="font-bold text-slate-950">Respon Desa</h2>
                        @if ($pengaduan->respon)
                            <p class="mt-3 whitespace-pre-line leading-8 text-slate-700">{{ $pengaduan->respon }}</p>
                            @if ($pengaduan->ditindaklanjuti_pada)
                                <p class="mt-3 text-sm font-semibold text-emerald-700">Diperbarui {{ $pengaduan->ditindaklanjuti_pada->translatedFormat('d M Y H:i') }}</p>
                            @endif
                        @else
                            <p class="mt-3 leading-7 text-slate-600">Belum ada respon dari admin desa.</p>
                        @endif
                    </section>
                </div>

                <aside class="space-y-4">
                    <div class="rounded-lg border border-emerald-100 bg-emerald-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-emerald-700">Pelapor</p>
                        <p class="mt-2 font-bold text-slate-950">{{ $pengaduan->nama }}</p>
                        <p class="mt-1 text-sm text-slate-600">{{ $pengaduan->kontak }}</p>
                        <p class="mt-4 text-xs font-bold uppercase tracking-wider text-emerald-700">Lokasi</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700">{{ $pengaduan->lokasi }}</p>
                        @if ($pengaduan->maps_url)
                            <a href="{{ $pengaduan->maps_url }}" target="_blank" rel="noopener" class="mt-3 inline-flex rounded bg-emerald-700 px-3 py-2 text-sm font-bold text-white transition hover:bg-emerald-800">Buka Titik Maps</a>
                            <p class="mt-2 text-xs text-slate-500">{{ $pengaduan->latitude }}, {{ $pengaduan->longitude }}</p>
                        @endif
                        <p class="mt-4 text-xs font-semibold text-slate-500">Dikirim {{ $pengaduan->created_at->translatedFormat('d M Y H:i') }}</p>
                    </div>
                    @if ($pengaduan->foto)
                        <div>
                            <p class="mb-2 text-sm font-bold text-slate-700">Foto Laporan</p>
                            <img src="{{ asset('storage/'.$pengaduan->foto) }}" alt="Foto laporan" class="aspect-video w-full rounded object-cover shadow-sm">
                        </div>
                    @endif
                    @if ($pengaduan->foto_tindak_lanjut)
                        <div>
                            <p class="mb-2 text-sm font-bold text-slate-700">Bukti Tindak Lanjut</p>
                            <img src="{{ asset('storage/'.$pengaduan->foto_tindak_lanjut) }}" alt="Bukti tindak lanjut" class="aspect-video w-full rounded object-cover shadow-sm">
                        </div>
                    @endif
                </aside>
            </div>
        </article>
    </main>
</body>
</html>
