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
                <a href="{{ route('login') }}" class="rounded border border-white/30 px-4 py-2 text-sm font-semibold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-white/10">Login</a>
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
                <form class="rounded-lg border border-emerald-100 bg-white p-6 shadow-sm" data-reveal="right">
                    <div class="grid gap-4 md:grid-cols-2">
                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Nama</span>
                            <input class="mt-2 w-full rounded border border-emerald-200 px-4 py-3 outline-none focus:border-emerald-500" type="text" placeholder="Nama lengkap">
                        </label>
                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Kontak</span>
                            <input class="mt-2 w-full rounded border border-emerald-200 px-4 py-3 outline-none focus:border-emerald-500" type="text" placeholder="Nomor HP atau email">
                        </label>
                    </div>
                    <label class="mt-4 block">
                        <span class="text-sm font-semibold text-slate-700">Isi Pengaduan</span>
                        <textarea class="mt-2 min-h-32 w-full rounded border border-emerald-200 px-4 py-3 outline-none focus:border-emerald-500" placeholder="Tuliskan laporan atau aspirasi"></textarea>
                    </label>
                    <button type="button" class="mt-5 rounded bg-emerald-700 px-5 py-3 font-semibold text-white hover:bg-emerald-800">Kirim Pengaduan</button>
                </form>
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
                <div class="mt-10 grid gap-4 md:grid-cols-3" data-reveal>
                    @foreach ([
                        ['03 Jun', 'Musyawarah Perencanaan Desa', 'Balai Desa Pelaga'],
                        ['08 Jun', 'Pelayanan Administrasi Terpadu', 'Kantor Perbekel'],
                        ['15 Jun', 'Kerja Bakti Kebersihan Lingkungan', 'Wilayah Banjar'],
                    ] as [$date, $title, $place])
                        <article class="rounded-lg border border-emerald-100 p-6 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <p class="text-sm font-bold text-emerald-700">{{ $date }}</p>
                            <h3 class="mt-3 text-xl font-bold text-slate-950">{{ $title }}</h3>
                            <p class="mt-3 text-slate-600">{{ $place }}</p>
                        </article>
                    @endforeach
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
                    @foreach ([
                        ['https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=700&q=70', 'Rapat koordinasi peningkatan layanan administrasi desa.'],
                        ['https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=700&q=70', 'Program penghijauan dan pengelolaan lingkungan berkelanjutan.'],
                        ['https://images.unsplash.com/photo-1523741543316-beb7fc7023d8?auto=format&fit=crop&w=700&q=70', 'Penguatan potensi pertanian dan ekonomi warga Pelaga.'],
                    ] as [$image, $title])
                        <article class="overflow-hidden rounded-lg border border-emerald-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <img src="{{ $image }}" alt="{{ $title }}" class="h-48 w-full object-cover" width="700" height="467" loading="lazy" decoding="async">
                            <div class="p-5">
                                <p class="text-sm font-semibold text-emerald-700">Berita Desa</p>
                                <h3 class="mt-2 text-lg font-bold leading-7 text-slate-950">{{ $title }}</h3>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="galeri" class="bg-white py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl" data-reveal>
                    <p class="text-sm font-bold uppercase tracking-wider text-emerald-700">Galeri</p>
                    <h2 class="mt-3 text-3xl font-bold text-slate-950 sm:text-4xl">Potret Desa Pelaga.</h2>
                </div>
                <div class="mt-10 grid grid-cols-2 gap-3 md:grid-cols-4" data-reveal>
                    @foreach ([
                        'https://images.unsplash.com/photo-1473773508845-188df298d2d1?auto=format&fit=crop&w=520&q=70',
                        'https://images.unsplash.com/photo-1495107334309-fcf20504a5ab?auto=format&fit=crop&w=520&q=70',
                        'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=520&q=70',
                        'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=520&q=70',
                    ] as $image)
                        <img src="{{ $image }}" alt="Galeri Desa Pelaga" class="aspect-[4/3] w-full rounded-lg object-cover transition duration-300 hover:scale-[1.02]" width="520" height="390" loading="lazy" decoding="async">
                    @endforeach
                </div>
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
    </script>
</body>
</html>
