@php
    $menuItems = [
        ['label' => 'Dashboard', 'href' => route('admin.dashboard'), 'active' => request()->routeIs('admin.dashboard'), 'icon' => 'home'],
        ['label' => 'Berita Desa', 'href' => route('admin.berita.index'), 'active' => request()->routeIs('admin.berita.*'), 'icon' => 'newspaper'],
        ['label' => 'Agenda', 'href' => '#', 'active' => false, 'icon' => 'calendar'],
        ['label' => 'Galeri', 'href' => '#', 'active' => false, 'icon' => 'image'],
        ['label' => 'Pengaduan', 'href' => '#', 'active' => false, 'icon' => 'message'],
        ['label' => 'Pengaturan', 'href' => '#', 'active' => false, 'icon' => 'settings'],
    ];

    $icons = [
        'home' => 'M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V10.5Z',
        'newspaper' => 'M4 5h16v14H4V5Zm4 4h8M8 13h8M8 17h5',
        'calendar' => 'M7 3v4M17 3v4M4 8h16M5 5h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z',
        'image' => 'M4 5h16v14H4V5Zm3 11 4-4 3 3 2-2 3 3M8 9h.01',
        'message' => 'M4 5h16v11H8l-4 4V5Z',
        'settings' => 'M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm0-5v3m0 12v3M4.2 4.2l2.1 2.1m11.4 11.4 2.1 2.1M3 12h3m12 0h3M4.2 19.8l2.1-2.1M17.7 6.3l2.1-2.1',
        'back' => 'M15 18 9 12l6-6M10 12h11M3 4v16',
    ];
@endphp

<aside class="hidden overflow-hidden border-r border-slate-200 bg-white transition-all duration-300 lg:block">
    <div class="sticky top-0 flex h-screen flex-col">
        <div class="flex h-24 items-center gap-4 border-b border-slate-200 px-6">
            <span class="grid size-12 shrink-0 place-items-center rounded bg-gradient-to-br from-lime-300 to-emerald-500 font-bold text-emerald-950">DP</span>
            <div data-sidebar-brand class="min-w-0">
                <p class="truncate text-sm font-semibold leading-tight text-slate-600">Admin</p>
                <p class="truncate text-lg font-bold leading-tight text-emerald-950">Desa Pelaga</p>
            </div>
        </div>

        <nav class="flex-1 space-y-1 px-3 py-5 text-sm font-medium">
            @foreach ($menuItems as $item)
                <a href="{{ $item['href'] }}" class="flex items-center gap-3 rounded px-3 py-3 transition {{ $item['active'] ? 'bg-emerald-50 text-emerald-800' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }}" title="{{ $item['label'] }}">
                    <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="{{ $icons[$item['icon']] }}" />
                    </svg>
                    <span data-sidebar-label class="truncate">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="border-t border-slate-200 p-3">
            <a href="{{ url('/') }}" class="flex items-center gap-3 rounded px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-950" title="Kembali ke Beranda">
                <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="{{ $icons['back'] }}" />
                </svg>
                <span data-sidebar-label class="truncate">Kembali ke Beranda</span>
            </a>
        </div>
    </div>
</aside>
