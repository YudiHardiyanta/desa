<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desa Pelaga</title>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="preload" as="image" href="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1400&q=70" fetchpriority="high">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-emerald-50 text-slate-900 antialiased">
    <header class="fixed inset-x-0 top-0 z-50 border-b border-white/20 bg-emerald-950/80 text-white shadow-sm backdrop-blur">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            <a href="#" class="flex items-center gap-3 transition duration-300 hover:scale-[1.02]">
                <span class="grid size-10 place-items-center rounded bg-gradient-to-br from-lime-300 to-emerald-500 font-bold text-emerald-950">DP</span>
                <span>
                    <span class="block text-sm font-semibold leading-tight">Pemerintah Desa</span>
                    <span class="block text-lg font-bold leading-tight">Pelaga</span>
                </span>
            </a>
            <div class="hidden items-center gap-6 text-sm font-medium md:flex">
                <a class="transition duration-300 hover:text-lime-200" href="#visi">Visi Misi</a>
                <a class="transition duration-300 hover:text-lime-200" href="#layanan">Layanan</a>
                <a class="transition duration-300 hover:text-lime-200" href="#agenda">Agenda</a>
                <a class="transition duration-300 hover:text-lime-200" href="#berita">Berita</a>
                <a class="transition duration-300 hover:text-lime-200" href="#lokasi">Lokasi</a>
            </div>
            <div class="flex items-center gap-2">
                <a href="#pengaduan" class="rounded bg-lime-300 px-4 py-2 text-sm font-semibold text-emerald-950 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:bg-lime-200">Pengaduan</a>
                @auth
                    <details class="relative">
                        <summary class="grid size-10 cursor-pointer list-none place-items-center rounded border border-white/30 bg-white/10 text-sm font-bold text-white transition hover:bg-white/20">
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
                    <a href="{{ route('login') }}" class="rounded border border-white/30 px-4 py-2 text-sm font-semibold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-white/10">Login</a>
                @endauth
            </div>
        </nav>
    </header>

    <main>
        <section class="relative min-h-[92vh] overflow-hidden bg-emerald-950 pt-24 text-white">
            <img
                src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1400&q=70"
                alt="Pemandangan hijau pedesaan"
                class="absolute inset-0 h-full w-full object-cover opacity-55"
                width="1400"
                height="933"
                loading="eager"
                decoding="async"
                fetchpriority="high"
            >
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-950 via-emerald-900/75 to-lime-800/45"></div>
            <div class="relative mx-auto grid max-w-7xl gap-10 px-4 pb-20 pt-16 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:pt-24">
                <div class="max-w-3xl" data-reveal="left">
                    <p class="mb-4 inline-flex rounded bg-white/15 px-3 py-1 text-sm font-semibold ring-1 ring-white/20">Desa Pelaga, Kecamatan Petang, Badung</p>
                    <h1 class="text-4xl font-bold leading-tight sm:text-6xl">Pemerintahan Desa Pelaga yang hijau, sigap, dan terbuka.</h1>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-emerald-50">Portal informasi dan pelayanan masyarakat untuk administrasi desa, pengaduan warga, agenda kegiatan, berita pembangunan, galeri, serta lokasi layanan Desa Pelaga.</p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="#layanan" class="rounded bg-lime-300 px-5 py-3 font-semibold text-emerald-950 shadow-lg shadow-emerald-950/20 hover:bg-lime-200">Lihat Layanan</a>
                        <a href="#berita" class="rounded border border-white/40 px-5 py-3 font-semibold text-white hover:bg-white/10">Informasi Desa</a>
                    </div>
                </div>
                <div class="self-end rounded-lg border border-white/20 bg-white/12 p-5 shadow-2xl backdrop-blur" data-reveal="right">
                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div class="rounded bg-white/15 p-4">
                            <p class="text-3xl font-bold text-lime-200">7</p>
                            <p class="mt-1 text-xs text-emerald-50">Fokus Informasi</p>
                        </div>
                        <div class="rounded bg-white/15 p-4">
                            <p class="text-3xl font-bold text-lime-200">24</p>
                            <p class="mt-1 text-xs text-emerald-50">Jam Pengaduan</p>
                        </div>
                        <div class="rounded bg-white/15 p-4">
                            <p class="text-3xl font-bold text-lime-200">1</p>
                            <p class="mt-1 text-xs text-emerald-50">Pintu Layanan</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="visi" class="bg-white py-20">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.85fr_1.15fr] lg:px-8">
                <div data-reveal="left">
                    <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Visi dan Misi</p>
                    <h2 class="mt-3 text-3xl font-bold text-slate-950 sm:text-4xl">Arah pembangunan Desa Pelaga.</h2>
                    <p class="mt-5 leading-7 text-slate-600">Membangun tata kelola desa yang melayani, menjaga kelestarian alam, dan memperkuat kesejahteraan masyarakat berbasis potensi lokal.</p>
                </div>
                <div class="grid gap-4 md:grid-cols-2" data-reveal="right">
                    @foreach ([
                        ['Visi Desa', 'Terwujudnya Desa Pelaga yang sejahtera, lestari, berbudaya, dan berdaya saing melalui pelayanan publik yang transparan.'],
                        ['Pelayanan Prima', 'Meningkatkan kualitas administrasi, informasi, dan respons aparatur desa kepada masyarakat.'],
                        ['Pembangunan Berkelanjutan', 'Mengembangkan potensi pertanian, pariwisata, dan lingkungan hidup secara bijak.'],
                        ['Partisipasi Warga', 'Menguatkan musyawarah, gotong royong, dan ruang pengaduan yang mudah diakses.'],
                    ] as [$title, $copy])
                        <article class="rounded-lg border border-emerald-100 bg-gradient-to-br from-emerald-50 to-lime-50 p-6 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <h3 class="text-lg font-bold text-emerald-950">{{ $title }}</h3>
                            <p class="mt-3 leading-7 text-slate-600">{{ $copy }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="layanan" class="bg-gradient-to-b from-emerald-950 to-emerald-900 py-20 text-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl" data-reveal>
                    <p class="text-sm font-bold uppercase tracking-wider text-lime-200">Pelayanan Desa</p>
                    <h2 class="mt-3 text-3xl font-bold sm:text-4xl">Administrasi surat menyurat.</h2>
                    <p class="mt-5 leading-7 text-emerald-50">Masyarakat dapat menyiapkan kebutuhan administrasi sebelum datang ke kantor desa agar proses layanan lebih cepat dan tertib.</p>
                </div>
                <div class="mt-10 grid gap-4 md:grid-cols-3" data-reveal>
                    @foreach ([
                        ['Surat Keterangan', 'Domisili, usaha, tidak mampu, kehilangan, dan kebutuhan keterangan lainnya.'],
                        ['Administrasi Kependudukan', 'Pengantar KTP, KK, akta kelahiran, akta kematian, dan pindah domisili.'],
                        ['Legalisasi dan Rekomendasi', 'Pengesahan dokumen warga serta rekomendasi kegiatan sosial dan usaha.'],
                    ] as [$title, $copy])
                        <article class="rounded-lg border border-white/15 bg-white/10 p-6 transition duration-300 hover:-translate-y-1 hover:bg-white/15">
                            <h3 class="text-xl font-bold text-lime-100">{{ $title }}</h3>
                            <p class="mt-3 leading-7 text-emerald-50">{{ $copy }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="pengaduan" class="bg-lime-50 py-20">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
                <div data-reveal="left">
                    <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Pengaduan</p>
                    <h2 class="mt-3 text-3xl font-bold text-slate-950 sm:text-4xl">Sampaikan aspirasi dan laporan warga.</h2>
                    <p class="mt-5 leading-7 text-slate-600">Gunakan kanal pengaduan untuk melaporkan layanan publik, fasilitas umum, kebersihan, keamanan, atau usulan pembangunan desa.</p>
                </div>
                <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data" class="rounded-lg border border-emerald-100 bg-white p-6 shadow-sm" data-reveal="right">
                    @csrf
                    @if ($errors->any())
                        <div class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <div class="grid gap-4 md:grid-cols-2">
                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Nama</span>
                            <input name="nama" value="{{ old('nama') }}" class="mt-2 w-full rounded border border-emerald-200 px-4 py-3 outline-none focus:border-emerald-500" type="text" placeholder="Nama lengkap" required>
                        </label>
                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Kontak</span>
                            <input name="kontak" value="{{ old('kontak') }}" class="mt-2 w-full rounded border border-emerald-200 px-4 py-3 outline-none focus:border-emerald-500" type="text" placeholder="Nomor HP atau email" required>
                        </label>
                    </div>
                    <label class="mt-4 block">
                        <span class="text-sm font-semibold text-slate-700">Lokasi</span>
                        <input name="lokasi" value="{{ old('lokasi') }}" class="mt-2 w-full rounded border border-emerald-200 px-4 py-3 outline-none focus:border-emerald-500" type="text" placeholder="Contoh: Banjar Kiadan, dekat balai banjar" required>
                    </label>
                    <div class="mt-4 rounded-lg border border-emerald-100 bg-emerald-50 p-4">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm font-bold text-slate-800">Geotag lokasi</p>
                                <p id="complaint-location-status" class="mt-1 text-sm text-slate-600">Koordinat belum diambil.</p>
                            </div>
                            <button type="button" id="complaint-location-button" class="rounded border border-emerald-200 bg-white px-4 py-2 text-sm font-bold text-emerald-800 transition hover:bg-emerald-100">Ambil Lokasi Saya</button>
                        </div>
                        <input type="hidden" name="latitude" id="complaint-latitude" value="{{ old('latitude') }}">
                        <input type="hidden" name="longitude" id="complaint-longitude" value="{{ old('longitude') }}">
                    </div>
                    <label class="mt-4 block">
                        <span class="text-sm font-semibold text-slate-700">Isi Pengaduan</span>
                        <textarea name="isi" class="mt-2 min-h-32 w-full rounded border border-emerald-200 px-4 py-3 outline-none focus:border-emerald-500" placeholder="Tuliskan laporan atau aspirasi" required>{{ old('isi') }}</textarea>
                    </label>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Tag</span>
                            <input name="tags" value="{{ old('tags') }}" class="mt-2 w-full rounded border border-emerald-200 px-4 py-3 outline-none focus:border-emerald-500" type="text" placeholder="jalan, sampah, lampu">
                        </label>
                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Foto</span>
                            <input name="foto" class="mt-2 w-full rounded border border-dashed border-emerald-200 bg-emerald-50 px-4 py-3 text-sm file:mr-3 file:rounded file:border-0 file:bg-emerald-700 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white" type="file" accept="image/*">
                        </label>
                    </div>
                    <div class="mt-5 flex flex-wrap items-center gap-3">
                        <button class="rounded bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">Kirim Pengaduan</button>
                        <a href="{{ route('pengaduan.index') }}" class="rounded border border-emerald-200 px-5 py-3 font-semibold text-emerald-800 transition hover:bg-emerald-50">Lihat Daftar Aduan</a>
                    </div>
                </form>
            </div>

            <div class="mx-auto mt-10 max-w-7xl px-4 sm:px-6 lg:px-8" data-reveal>
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                    <div>
                        <h3 class="text-xl font-bold text-slate-950">Aduan Terbaru</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">Beberapa pengaduan terakhir dan status penanganannya.</p>
                    </div>
                    @if ($totalPengaduan > 3)
                        <a href="{{ route('pengaduan.index') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-900">View More</a>
                    @endif
                </div>
                <div class="mt-5 grid gap-4 md:grid-cols-3">
                    @forelse ($pengaduans as $pengaduan)
                        <a href="{{ route('pengaduan.show', $pengaduan) }}" class="rounded-lg border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                            <div class="flex items-start justify-between gap-3">
                                <p class="font-bold text-slate-950">{{ $pengaduan->nomor }}</p>
                                <span class="shrink-0 rounded px-3 py-1 text-xs font-bold {{ $pengaduan->status === 'selesai' ? 'bg-emerald-50 text-emerald-700' : ($pengaduan->status === 'diproses' ? 'bg-sky-50 text-sky-700' : 'bg-amber-50 text-amber-700') }}">
                                    {{ $pengaduan->status_label }}
                                </span>
                            </div>
                            <p class="mt-3 line-clamp-2 text-sm leading-6 text-slate-600">{{ $pengaduan->isi }}</p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach ($pengaduan->tags ?? [] as $tag)
                                    <span class="rounded bg-emerald-50 px-2 py-1 text-xs font-bold text-emerald-700">#{{ $tag }}</span>
                                @endforeach
                            </div>
                        </a>
                    @empty
                        <div class="rounded-lg border border-emerald-100 bg-white p-6 text-slate-600 md:col-span-3">
                            Belum ada pengaduan yang tercatat.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="agenda" class="bg-white py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end" data-reveal>
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Agenda Desa</p>
                        <h2 class="mt-3 text-3xl font-bold text-slate-950 sm:text-4xl">Kegiatan terdekat.</h2>
                    </div>
                    <p class="max-w-xl leading-7 text-slate-600">Agenda desa membantu warga mengikuti musyawarah, pelayanan keliling, kegiatan adat, dan kerja bakti lingkungan.</p>
                </div>
                <div class="mt-10 grid gap-6 lg:grid-cols-[1.15fr_0.85fr]" data-reveal>
                    <section class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-4">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="font-bold text-slate-950">{{ now()->translatedFormat('F Y') }}</h3>
                            <span class="rounded bg-white px-3 py-1 text-xs font-bold text-emerald-700">Kalender Kegiatan</span>
                        </div>
                        <div class="grid grid-cols-7 rounded-t bg-emerald-800 text-center text-xs font-bold text-white">
                            @foreach (['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $dayName)
                                <div class="px-2 py-2">{{ $dayName }}</div>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-7 overflow-hidden rounded-b border border-emerald-100 bg-white">
                            @foreach ($agendaMonthDays as $day)
                                @php
                                    $dateKey = $day->toDateString();
                                    $dayAgendas = $agendaCalendar->get($dateKey, collect());
                                    $agendaPayload = $dayAgendas->map(fn ($agenda) => [
                                        'judul' => $agenda->judul,
                                        'tanggal' => $agenda->tanggal_event->translatedFormat('d M Y'),
                                        'waktu_mulai' => $agenda->waktu_mulai ? substr($agenda->waktu_mulai, 0, 5) : '',
                                        'waktu_selesai' => $agenda->waktu_selesai ? substr($agenda->waktu_selesai, 0, 5) : '',
                                        'lokasi' => $agenda->lokasi,
                                        'deskripsi' => $agenda->deskripsi,
                                    ])->values();
                                @endphp
                                <button
                                    type="button"
                                    class="min-h-24 border-b border-r border-emerald-100 p-2 text-left transition hover:bg-emerald-50 {{ $day->month !== now()->month ? 'bg-slate-50 text-slate-400' : 'bg-white' }}"
                                    data-public-agenda
                                    data-date="{{ $day->translatedFormat('d M Y') }}"
                                    data-agendas='@json($agendaPayload)'
                                >
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold {{ $day->isToday() ? 'grid size-6 place-items-center rounded-full bg-emerald-700 text-white' : '' }}">{{ $day->day }}</span>
                                        @if ($dayAgendas->isNotEmpty())
                                            <span class="size-2 rounded-full bg-lime-500"></span>
                                        @endif
                                    </div>
                                    <div class="mt-2 space-y-1">
                                        @foreach ($dayAgendas->take(2) as $agenda)
                                            <div class="truncate rounded bg-emerald-50 px-2 py-1 text-[11px] font-semibold text-emerald-900">
                                                {{ $agenda->waktu_mulai ? substr($agenda->waktu_mulai, 0, 5).' ' : '' }}{{ $agenda->judul }}
                                            </div>
                                        @endforeach
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </section>

                    <section class="space-y-4">
                        <h3 class="font-bold text-slate-950">Agenda Mendatang</h3>
                        @forelse ($agendas as $agenda)
                            @php
                                $singleAgendaPayload = [[
                                    'judul' => $agenda->judul,
                                    'tanggal' => $agenda->tanggal_event->translatedFormat('d M Y'),
                                    'waktu_mulai' => $agenda->waktu_mulai ? substr($agenda->waktu_mulai, 0, 5) : '',
                                    'waktu_selesai' => $agenda->waktu_selesai ? substr($agenda->waktu_selesai, 0, 5) : '',
                                    'lokasi' => $agenda->lokasi,
                                    'deskripsi' => $agenda->deskripsi,
                                ]];
                            @endphp
                            <button
                                type="button"
                                class="block w-full rounded-lg border border-emerald-100 p-5 text-left transition duration-300 hover:-translate-y-1 hover:bg-emerald-50 hover:shadow-lg"
                                data-public-agenda
                                data-date="{{ $agenda->tanggal_event->translatedFormat('d M Y') }}"
                                data-agendas='@json($singleAgendaPayload)'
                            >
                                <p class="text-sm font-bold text-emerald-700">{{ $agenda->tanggal_event->translatedFormat('d M Y') }}</p>
                                <h4 class="mt-2 text-lg font-bold text-slate-950">{{ $agenda->judul }}</h4>
                                <p class="mt-2 text-sm font-semibold text-slate-600">
                                    {{ $agenda->waktu_mulai ? substr($agenda->waktu_mulai, 0, 5) : 'Sehari' }}
                                    @if ($agenda->waktu_selesai)
                                        - {{ substr($agenda->waktu_selesai, 0, 5) }}
                                    @endif
                                </p>
                                @if ($agenda->lokasi)
                                    <p class="mt-2 text-sm text-slate-600">{{ $agenda->lokasi }}</p>
                                @endif
                                @if ($agenda->deskripsi)
                                    <p class="mt-3 line-clamp-2 text-sm leading-6 text-slate-500">{{ $agenda->deskripsi }}</p>
                                @endif
                            </button>
                        @empty
                            <div class="rounded-lg border border-emerald-100 p-6 text-slate-600">
                                Belum ada agenda desa mendatang.
                            </div>
                        @endforelse
                    </section>
                </div>
            </div>
        </section>

        <section id="berita" class="bg-emerald-50 py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div data-reveal>
                    <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Berita Desa</p>
                    <h2 class="mt-3 text-3xl font-bold text-slate-950 sm:text-4xl">Informasi terbaru pembangunan dan kegiatan.</h2>
                </div>
                <div class="mt-10 grid gap-5 md:grid-cols-3" data-reveal>
                    @forelse ($beritas as $berita)
                        <a href="{{ route('berita.show', $berita) }}" class="block overflow-hidden rounded-lg border border-emerald-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
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
                                <h3 class="mt-2 text-lg font-bold leading-7 text-slate-950">{{ $berita->judul }}</h3>
                                <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">{{ strip_tags($berita->isi) }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="rounded-lg border border-emerald-100 bg-white p-6 text-slate-600 md:col-span-3">
                            Belum ada berita desa yang diterbitkan.
                        </div>
                    @endforelse
                </div>
                @if ($totalBerita > 3)
                    <div class="mt-10 text-center">
                        <a href="{{ route('berita.index') }}" class="inline-flex rounded bg-emerald-700 px-5 py-3 font-semibold text-white transition hover:bg-emerald-800">View More</a>
                    </div>
                @endif
            </div>
        </section>

        <section id="galeri" class="bg-white py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end" data-reveal>
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Galeri</p>
                        <h2 class="mt-3 text-3xl font-bold text-slate-950 sm:text-4xl">Potret Desa Pelaga.</h2>
                    </div>
                    <p class="max-w-xl leading-7 text-slate-600">Dokumentasi kegiatan desa dapat ditampilkan sebagai collection atau foto tunggal tanpa collection.</p>
                </div>

                <div class="mt-10 grid gap-5 md:grid-cols-3" data-reveal>
                    @forelse ($galleryCollections as $collection)
                        @php $coverPhoto = $collection->activePhotos->first(); @endphp
                        <a href="{{ route('galeri.show', $collection) }}" class="block overflow-hidden rounded-lg border border-emerald-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            @if ($coverPhoto)
                                <img src="{{ asset('storage/'.$coverPhoto->path) }}" alt="{{ $collection->judul }}" class="h-52 w-full object-cover" loading="lazy" decoding="async">
                            @else
                                <div class="grid h-52 place-items-center bg-emerald-50 text-sm font-bold text-emerald-700">Belum ada foto</div>
                            @endif
                            <div class="p-5">
                                <p class="text-sm font-bold text-emerald-700">{{ $collection->active_photos_count }} foto</p>
                                <h3 class="mt-2 text-lg font-bold text-slate-950">{{ $collection->judul }}</h3>
                                <p class="mt-3 line-clamp-2 text-sm leading-6 text-slate-600">{{ $collection->deskripsi ?: 'Collection dokumentasi Desa Pelaga.' }}</p>
                            </div>
                        </a>
                    @empty
                        @forelse ($galleryPhotos as $photo)
                            <a href="{{ asset('storage/'.$photo->path) }}" class="block overflow-hidden rounded-lg border border-emerald-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg" target="_blank">
                                <img src="{{ asset('storage/'.$photo->path) }}" alt="{{ $photo->judul ?: 'Galeri Desa Pelaga' }}" class="h-52 w-full object-cover" loading="lazy" decoding="async">
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-slate-950">{{ $photo->judul ?: 'Foto Desa Pelaga' }}</h3>
                                    <p class="mt-3 line-clamp-2 text-sm leading-6 text-slate-600">{{ $photo->deskripsi ?: 'Dokumentasi Desa Pelaga.' }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="rounded-lg border border-emerald-100 bg-white p-6 text-slate-600 md:col-span-3">
                                Belum ada galeri desa yang diterbitkan.
                            </div>
                        @endforelse
                    @endforelse
                </div>

                @if ($totalGaleri > 3)
                    <div class="mt-10 text-center">
                        <a href="{{ route('galeri.index') }}" class="inline-flex rounded bg-emerald-700 px-5 py-3 font-semibold text-white transition hover:bg-emerald-800">View More</a>
                    </div>
                @endif
            </div>
        </section>

        <section id="lokasi" class="bg-gradient-to-br from-emerald-950 to-lime-800 py-20 text-white">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-[0.85fr_1.15fr] lg:px-8">
                <div data-reveal="left">
                    <p class="text-sm font-bold uppercase tracking-wider text-lime-200">Lokasi</p>
                    <h2 class="mt-3 text-3xl font-bold sm:text-4xl">Kantor Desa Pelaga.</h2>
                    <p class="mt-5 leading-7 text-emerald-50">Desa Pelaga berada di Kecamatan Petang, Kabupaten Badung, Bali. Kantor desa menjadi pusat pelayanan administrasi dan informasi masyarakat.</p>
                    <div class="mt-6 rounded-lg bg-white/10 p-5">
                        <p class="font-semibold">Alamat</p>
                        <p class="mt-2 text-emerald-50">Pelaga, Petang, Kabupaten Badung, Bali</p>
                    </div>
                </div>
                <iframe
                    title="Lokasi Desa Pelaga"
                    class="h-80 w-full rounded-lg border-0 shadow-2xl"
                    data-reveal="right"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps?q=Desa%20Pelaga%20Petang%20Badung%20Bali&output=embed">
                </iframe>
            </div>
        </section>
    </main>

    <footer class="bg-emerald-950 px-4 py-8 text-center text-sm text-emerald-100">
        <p>&copy; {{ date('Y') }} Pemerintah Desa Pelaga. Semua hak dilindungi.</p>
    </footer>

    <div id="public-agenda-modal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-emerald-950/60 px-4 backdrop-blur-sm">
        <div class="w-full max-w-xl overflow-hidden rounded-lg bg-white shadow-2xl">
            <div class="flex items-start justify-between gap-4 border-b border-emerald-100 px-5 py-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Detail Agenda</p>
                    <h3 id="public-agenda-date" class="mt-1 text-xl font-bold text-slate-950">Agenda Desa</h3>
                </div>
                <button type="button" class="grid size-10 shrink-0 place-items-center rounded border border-slate-200 text-slate-600 transition hover:bg-slate-50" data-public-agenda-close aria-label="Tutup detail agenda">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
            <div id="public-agenda-list" class="max-h-[70vh] space-y-3 overflow-y-auto p-5"></div>
        </div>
    </div>

    <script>
        const revealItems = document.querySelectorAll('[data-reveal]');

        if ('IntersectionObserver' in window) {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    entry.target.classList.toggle('is-visible', entry.isIntersecting);
                });
            }, {
                threshold: 0.16,
                rootMargin: '0px 0px -48px 0px',
            });

            revealItems.forEach((item) => revealObserver.observe(item));
        } else {
            revealItems.forEach((item) => item.classList.add('is-visible'));
        }

        const publicAgendaModal = document.querySelector('#public-agenda-modal');
        const publicAgendaDate = document.querySelector('#public-agenda-date');
        const publicAgendaList = document.querySelector('#public-agenda-list');

        const agendaTime = (agenda) => {
            if (!agenda.waktu_mulai) {
                return 'Sehari';
            }

            return agenda.waktu_selesai
                ? `${agenda.waktu_mulai} - ${agenda.waktu_selesai}`
                : agenda.waktu_mulai;
        };

        const openPublicAgendaModal = (date, agendas) => {
            publicAgendaDate.textContent = date;
            publicAgendaList.innerHTML = '';

            if (!agendas.length) {
                publicAgendaList.innerHTML = '<div class="rounded-lg border border-dashed border-emerald-200 bg-emerald-50 p-5 text-sm leading-6 text-slate-600">Tidak ada agenda pada tanggal ini.</div>';
            } else {
                agendas.forEach((agenda) => {
                    const item = document.createElement('article');
                    item.className = 'rounded-lg border border-emerald-100 bg-emerald-50/60 p-5';
                    item.innerHTML = `
                        <p class="text-sm font-bold text-emerald-700">${agendaTime(agenda)}</p>
                        <h4 class="mt-2 text-lg font-bold text-slate-950">${agenda.judul}</h4>
                        ${agenda.lokasi ? `<p class="mt-2 text-sm font-semibold text-slate-600">${agenda.lokasi}</p>` : ''}
                        ${agenda.deskripsi ? `<p class="mt-3 text-sm leading-6 text-slate-600">${agenda.deskripsi}</p>` : ''}
                    `;
                    publicAgendaList.appendChild(item);
                });
            }

            publicAgendaModal.classList.remove('hidden');
            publicAgendaModal.classList.add('flex');
        };

        const closePublicAgendaModal = () => {
            publicAgendaModal.classList.add('hidden');
            publicAgendaModal.classList.remove('flex');
        };

        document.querySelectorAll('[data-public-agenda]').forEach((button) => {
            button.addEventListener('click', () => {
                openPublicAgendaModal(button.dataset.date, JSON.parse(button.dataset.agendas || '[]'));
            });
        });

        document.querySelectorAll('[data-public-agenda-close]').forEach((button) => {
            button.addEventListener('click', closePublicAgendaModal);
        });

        publicAgendaModal.addEventListener('click', (event) => {
            if (event.target === publicAgendaModal) {
                closePublicAgendaModal();
            }
        });

        const complaintLocationButton = document.querySelector('#complaint-location-button');
        const complaintLocationStatus = document.querySelector('#complaint-location-status');
        const complaintLatitude = document.querySelector('#complaint-latitude');
        const complaintLongitude = document.querySelector('#complaint-longitude');

        complaintLocationButton?.addEventListener('click', () => {
            if (!navigator.geolocation) {
                complaintLocationStatus.textContent = 'Browser tidak mendukung geolocation.';
                return;
            }

            complaintLocationButton.disabled = true;
            complaintLocationButton.textContent = 'Mengambil lokasi...';
            complaintLocationStatus.textContent = 'Mohon izinkan akses lokasi pada browser.';

            navigator.geolocation.getCurrentPosition((position) => {
                const latitude = position.coords.latitude.toFixed(7);
                const longitude = position.coords.longitude.toFixed(7);

                complaintLatitude.value = latitude;
                complaintLongitude.value = longitude;
                complaintLocationStatus.textContent = `Lokasi tersimpan: ${latitude}, ${longitude}`;
                complaintLocationButton.disabled = false;
                complaintLocationButton.textContent = 'Perbarui Lokasi';
            }, () => {
                complaintLocationStatus.textContent = 'Lokasi gagal diambil. Pastikan izin lokasi aktif.';
                complaintLocationButton.disabled = false;
                complaintLocationButton.textContent = 'Ambil Lokasi Saya';
            }, {
                enableHighAccuracy: true,
                timeout: 12000,
                maximumAge: 0,
            });
        });
    </script>
</body>
</html>
