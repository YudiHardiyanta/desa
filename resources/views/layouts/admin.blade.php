<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Desa Pelaga')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900 antialiased">
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
    </script>
</body>
</html>
