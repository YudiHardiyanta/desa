<header class="sticky top-0 z-30 border-b border-slate-200 bg-white/90 backdrop-blur">
    <div class="flex min-h-16 items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <button id="sidebar-toggle" type="button" class="hidden rounded border border-slate-200 p-2 text-slate-600 transition hover:bg-slate-50 hover:text-slate-950 lg:inline-flex" aria-label="Toggle sidebar" aria-expanded="true">
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="min-w-0">
                <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500" aria-label="Breadcrumb">
                    <a href="{{ route('admin.dashboard') }}" class="transition hover:text-emerald-700">Admin</a>
                    <span>/</span>
                    @hasSection('breadcrumb')
                        @yield('breadcrumb')
                    @else
                        <span class="truncate text-emerald-700">@yield('page-title', 'Dashboard')</span>
                    @endif
                </nav>
                <h1 class="mt-1 truncate text-lg font-bold text-slate-950">@yield('page-title', 'Dashboard')</h1>
            </div>
        </div>

        <div class="flex shrink-0 items-center gap-3">
            <a href="{{ url('/') }}" class="hidden rounded border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 sm:inline-flex">
                Lihat Situs
            </a>
            <div class="flex items-center gap-2 rounded border border-slate-200 px-3 py-2">
                <span class="grid size-8 place-items-center rounded bg-emerald-100 text-sm font-bold text-emerald-800">A</span>
                <span class="hidden text-sm font-semibold text-slate-700 sm:inline">Admin</span>
            </div>
        </div>
    </div>
</header>
