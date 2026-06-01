<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Desa Pelaga')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900 antialiased">
    @if (session('success'))
        <div
            id="success-modal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/50 px-4"
            role="dialog"
            aria-modal="true"
            aria-labelledby="success-modal-title"
        >
            <div class="w-full max-w-sm rounded-lg bg-white p-6 text-center shadow-xl">
                <span class="mx-auto inline-flex size-14 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                </span>
                <h2 id="success-modal-title" class="mt-4 text-lg font-bold text-slate-950">Berhasil</h2>
                <p class="mt-2 leading-6 text-slate-600">{{ session('success') }}</p>
                <button
                    type="button"
                    class="mt-6 w-full rounded bg-emerald-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2"
                    data-modal-close="success-modal"
                >
                    Oke
                </button>
            </div>
        </div>
    @endif

    <div
        id="delete-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 px-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="delete-modal-title"
    >
        <div class="w-full max-w-sm rounded-lg bg-white p-6 text-center shadow-xl">
            <span class="mx-auto inline-flex size-14 items-center justify-center rounded-full bg-red-100 text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 6h18" />
                    <path d="M8 6V4h8v2" />
                    <path d="M19 6l-1 14H6L5 6" />
                    <path d="M10 11v5" />
                    <path d="M14 11v5" />
                </svg>
            </span>
            <h2 id="delete-modal-title" class="mt-4 text-lg font-bold text-slate-950">Hapus berita?</h2>
            <p class="mt-2 leading-6 text-slate-600">Data berita yang dihapus tidak akan tampil lagi dan tidak bisa dikembalikan dari halaman ini.</p>
            <div class="mt-6 grid grid-cols-2 gap-3">
                <button
                    type="button"
                    class="rounded border border-slate-300 px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2"
                    data-modal-close="delete-modal"
                >
                    Batal
                </button>
                <button
                    type="button"
                    id="confirm-delete-button"
                    class="rounded bg-red-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2"
                >
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <div id="admin-shell" class="min-h-screen transition-all duration-300 lg:grid lg:grid-cols-[260px_1fr]">
        @include('partials.admin-sidebar')

        <div class="flex min-h-screen flex-col">
            @include('partials.admin-header')

            <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
                @yield('content')
            </main>

            @include('partials.admin-footer')
        </div>
    </div>

    <script>
        const adminShell = document.querySelector('#admin-shell');
        const sidebarToggle = document.querySelector('#sidebar-toggle');
        const sidebarLabels = document.querySelectorAll('[data-sidebar-label]');
        const sidebarBrand = document.querySelector('[data-sidebar-brand]');

        const setSidebarState = (isCollapsed) => {
            adminShell.classList.toggle('lg:grid-cols-[260px_1fr]', !isCollapsed);
            adminShell.classList.toggle('lg:grid-cols-[88px_1fr]', isCollapsed);
            sidebarLabels.forEach((label) => label.classList.toggle('lg:hidden', isCollapsed));
            sidebarBrand?.classList.toggle('lg:hidden', isCollapsed);
            sidebarToggle?.setAttribute('aria-expanded', String(!isCollapsed));
            localStorage.setItem('admin-sidebar-collapsed', isCollapsed ? '1' : '0');
        };

        setSidebarState(localStorage.getItem('admin-sidebar-collapsed') === '1');

        sidebarToggle?.addEventListener('click', () => {
            setSidebarState(!adminShell.classList.contains('lg:grid-cols-[88px_1fr]'));
        });

        const openModal = (modal) => {
            modal?.classList.remove('hidden');
            modal?.classList.add('flex');
        };

        const closeModal = (modal) => {
            modal?.classList.add('hidden');
            modal?.classList.remove('flex');
        };

        document.querySelectorAll('[data-modal-close]').forEach((button) => {
            button.addEventListener('click', () => {
                closeModal(document.querySelector(`#${button.dataset.modalClose}`));
            });
        });

        document.querySelectorAll('#success-modal, #delete-modal').forEach((modal) => {
            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModal(modal);
                }
            });
        });

        let pendingDeleteForm = null;
        const deleteModal = document.querySelector('#delete-modal');
        const confirmDeleteButton = document.querySelector('#confirm-delete-button');

        document.addEventListener('submit', (event) => {
            const form = event.target;

            if (!(form instanceof HTMLFormElement) || !form.matches('[data-delete-form]') || form.dataset.confirmed === 'true') {
                return;
            }

            event.preventDefault();
            pendingDeleteForm = form;
            openModal(deleteModal);
        });

        confirmDeleteButton?.addEventListener('click', () => {
            if (!pendingDeleteForm) {
                return;
            }

            pendingDeleteForm.dataset.confirmed = 'true';
            pendingDeleteForm.submit();
        });
    </script>
</body>
</html>
