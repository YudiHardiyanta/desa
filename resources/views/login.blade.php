<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Sistem Desa Pelaga</title>
    <link rel="preconnect" href="https://images.unsplash.com">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-slate-900 antialiased">
    <main class="grid min-h-screen lg:grid-cols-[0.92fr_1.08fr]">
        <section class="flex min-h-screen items-center justify-center px-5 py-10 sm:px-8">
            <div class="w-full max-w-md" data-reveal>
                <a href="{{ url('/') }}" class="mb-10 inline-flex items-center gap-3">
                    <span class="grid size-11 place-items-center rounded bg-gradient-to-br from-lime-300 to-emerald-500 font-bold text-emerald-950">DP</span>
                    <span>
                        <span class="block text-sm font-semibold leading-tight text-emerald-950">Pemerintah Desa</span>
                        <span class="block text-xl font-bold leading-tight text-emerald-950">Pelaga</span>
                    </span>
                </a>

                <div>
                    <h1 class="text-4xl font-bold text-slate-950">Masuk</h1>
                    <p class="mt-3 text-slate-600">Masuk ke sistem layanan Pemerintah Desa Pelaga.</p>
                </div>

                <form id="login-form" class="mt-8 space-y-5" method="POST" action="#">
                    @csrf
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Username</span>
                        <input
                            type="text"
                            name="username"
                            autocomplete="username"
                            class="mt-2 w-full rounded border border-slate-300 bg-white px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                            placeholder="Masukkan username"
                        >
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Password</span>
                        <input
                            type="password"
                            name="password"
                            autocomplete="current-password"
                            class="mt-2 w-full rounded border border-slate-300 bg-white px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                            placeholder="Masukkan password"
                        >
                    </label>

                    <div>
                        <span class="text-sm font-semibold text-slate-700">Verifikasi Captcha</span>
                        <div class="mt-2 grid gap-3 sm:grid-cols-[0.9fr_1.1fr]">
                            <div class="flex min-h-12 items-center justify-between gap-2 rounded border border-emerald-200 bg-emerald-50 px-3">
                                <span id="captcha-code" class="select-none text-lg font-bold tracking-[0.25em] text-emerald-950"></span>
                                <button id="refresh-captcha" type="button" class="rounded px-2 py-1 text-xs font-semibold text-emerald-700 hover:bg-white">Ganti</button>
                            </div>
                            <input
                                id="captcha-input"
                                type="text"
                                name="captcha"
                                class="w-full rounded border border-slate-300 bg-white px-4 py-3 outline-none transition placeholder:text-slate-400 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                                placeholder="Ketik captcha"
                            >
                        </div>
                        <p id="captcha-message" class="mt-2 hidden text-sm font-semibold"></p>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <a href="{{ url('/') }}" class="text-sm font-semibold text-emerald-700 transition hover:text-emerald-900">Beranda</a>
                        <a href="#" class="text-sm font-semibold text-emerald-700 transition hover:text-emerald-900">Lupa Password</a>
                    </div>

                    <button type="submit" class="w-full rounded bg-emerald-700 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-emerald-800">
                        Masuk
                    </button>
                </form>
            </div>
        </section>

        <section class="relative hidden min-h-screen overflow-hidden bg-emerald-950 text-white lg:block">
            <img
                src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1200&q=70"
                alt="Lanskap hijau Desa Pelaga"
                class="absolute inset-0 h-full w-full object-cover opacity-35"
                width="1200"
                height="800"
                loading="eager"
                decoding="async"
                fetchpriority="high"
            >
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-950 via-emerald-900/90 to-lime-700/70"></div>
            <div class="relative flex min-h-screen flex-col justify-between px-12 py-10">
                <div class="flex justify-end gap-6 text-sm font-semibold text-emerald-50">
                    <a class="transition hover:text-lime-200" href="{{ url('/') }}">Beranda</a>
                    <a class="transition hover:text-lime-200" href="{{ url('/#layanan') }}">Layanan</a>
                    <a class="transition hover:text-lime-200" href="{{ url('/#pengaduan') }}">Pengaduan</a>
                </div>

                <div class="mx-auto max-w-xl text-center" data-reveal="right">
                    <div class="mx-auto mb-8 grid size-20 place-items-center rounded bg-gradient-to-br from-lime-300 to-emerald-500 text-2xl font-bold text-emerald-950 shadow-xl shadow-emerald-950/20">DP</div>
                    <p class="text-sm font-bold uppercase tracking-[0.35em] text-lime-200">Selamat Datang Di</p>
                    <h2 class="mt-4 text-5xl font-bold leading-tight">Portal Layanan Desa Pelaga</h2>
                    <p class="mx-auto mt-5 max-w-md leading-7 text-emerald-50">Sistem informasi dan administrasi desa untuk mendukung pelayanan publik yang cepat, terbuka, dan tertib.</p>
                </div>

                <p class="text-center text-sm text-emerald-100">&copy; {{ date('Y') }} Pemerintah Desa Pelaga</p>
            </div>
        </section>
    </main>

    <script>
        const revealItems = document.querySelectorAll('[data-reveal]');
        const loginForm = document.querySelector('#login-form');
        const captchaCode = document.querySelector('#captcha-code');
        const captchaInput = document.querySelector('#captcha-input');
        const captchaMessage = document.querySelector('#captcha-message');
        const refreshCaptcha = document.querySelector('#refresh-captcha');
        let activeCaptcha = '';

        if ('IntersectionObserver' in window) {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    entry.target.classList.toggle('is-visible', entry.isIntersecting);
                });
            }, { threshold: 0.16 });

            revealItems.forEach((item) => revealObserver.observe(item));
        } else {
            revealItems.forEach((item) => item.classList.add('is-visible'));
        }

        const createCaptcha = () => {
            const timestamp = Date.now().toString(36).toUpperCase();
            activeCaptcha = `P${timestamp.slice(-5)}`;
            captchaCode.textContent = activeCaptcha;
            captchaInput.value = '';
            captchaMessage.className = 'mt-2 hidden text-sm font-semibold';
            captchaMessage.textContent = '';
        };

        refreshCaptcha.addEventListener('click', createCaptcha);

        loginForm.addEventListener('submit', (event) => {
            event.preventDefault();

            if (captchaInput.value.trim().toUpperCase() !== activeCaptcha) {
                captchaMessage.className = 'mt-2 text-sm font-semibold text-red-600';
                captchaMessage.textContent = 'Captcha tidak sesuai.';
                captchaInput.focus();
                return;
            }

            captchaMessage.className = 'mt-2 text-sm font-semibold text-emerald-700';
            captchaMessage.textContent = 'Captcha valid.';
        });

        createCaptcha();
    </script>
</body>
</html>
