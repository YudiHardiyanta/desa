@extends('layouts.admin')

@section('title', 'Admin Agenda Desa')
@section('page-title', 'Agenda Desa')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="transition hover:text-emerald-700">Dashboard</a>
    <span>/</span>
    <span class="text-emerald-700">Agenda Desa</span>
@endsection

@section('content')
    <section class="space-y-6">
        <div class="flex flex-col justify-between gap-4 rounded-lg bg-gradient-to-r from-emerald-800 to-lime-600 p-6 text-white shadow-sm md:flex-row md:items-end">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-lime-100">Manajemen Kegiatan</p>
                <h2 class="mt-2 text-2xl font-bold">Kalender Agenda Desa</h2>
                <p class="mt-3 max-w-2xl leading-7 text-emerald-50">Kelola jadwal kegiatan desa dalam tampilan kalender seperti agenda harian.</p>
            </div>
            <button type="button" class="inline-flex h-12 items-center justify-center rounded bg-lime-300 px-5 text-sm font-bold text-emerald-950 transition hover:bg-lime-200" data-agenda-create>
                Tambah Agenda
            </button>
        </div>

        <section class="rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col justify-between gap-3 border-b border-slate-200 p-4 md:flex-row md:items-center">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Bulan Agenda</p>
                    <h3 class="text-xl font-bold text-slate-950">{{ $currentMonth->translatedFormat('F Y') }}</h3>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.agenda.index', ['month' => $previousMonth]) }}" class="rounded border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Sebelumnya</a>
                    <a href="{{ route('admin.agenda.index') }}" class="rounded border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Bulan Ini</a>
                    <a href="{{ route('admin.agenda.index', ['month' => $nextMonth]) }}" class="rounded border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Berikutnya</a>
                </div>
            </div>

            <div class="grid grid-cols-7 border-b border-slate-200 bg-slate-50 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                @foreach (['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $dayName)
                    <div class="border-r border-slate-200 px-2 py-3 last:border-r-0">{{ $dayName }}</div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 md:grid-cols-7">
                @foreach ($calendarDays as $day)
                    @php
                        $dateKey = $day->toDateString();
                        $dayAgendas = $agendaByDate->get($dateKey, collect());
                    @endphp
                    <div class="min-h-40 border-b border-r border-slate-200 bg-white p-3 last:border-r-0 {{ $day->month !== $currentMonth->month ? 'bg-slate-50 text-slate-400' : '' }}">
                        <div class="flex items-center justify-between gap-2">
                            <button type="button" class="grid size-8 place-items-center rounded text-sm font-bold transition hover:bg-emerald-50 hover:text-emerald-700" data-agenda-create data-agenda-date="{{ $dateKey }}">
                                {{ $day->day }}
                            </button>
                            @if ($day->isToday())
                                <span class="rounded bg-emerald-100 px-2 py-1 text-[11px] font-bold text-emerald-700">Hari ini</span>
                            @endif
                        </div>

                        <div class="mt-2 space-y-2">
                            @forelse ($dayAgendas as $agenda)
                                @php
                                    $agendaPayload = [
                                        'id' => $agenda->id,
                                        'judul' => $agenda->judul,
                                        'tanggal_event' => $agenda->tanggal_event->toDateString(),
                                        'waktu_mulai' => $agenda->waktu_mulai ? substr($agenda->waktu_mulai, 0, 5) : '',
                                        'waktu_selesai' => $agenda->waktu_selesai ? substr($agenda->waktu_selesai, 0, 5) : '',
                                        'lokasi' => $agenda->lokasi,
                                        'deskripsi' => $agenda->deskripsi,
                                        'is_active' => $agenda->is_active,
                                        'update_url' => route('admin.agenda.update', $agenda),
                                    ];
                                @endphp
                                <article class="rounded border border-emerald-100 bg-emerald-50 p-2 text-left">
                                    <button
                                        type="button"
                                        class="block w-full text-left"
                                        data-agenda-edit
                                        data-agenda='@json($agendaPayload)'
                                    >
                                        <p class="truncate text-xs font-bold text-emerald-900">{{ $agenda->judul }}</p>
                                        <p class="mt-1 text-[11px] font-semibold text-slate-600">
                                            {{ $agenda->waktu_mulai ? substr($agenda->waktu_mulai, 0, 5) : 'Sehari' }}
                                            @if ($agenda->waktu_selesai)
                                                - {{ substr($agenda->waktu_selesai, 0, 5) }}
                                            @endif
                                        </p>
                                        @if (! $agenda->is_active)
                                            <span class="mt-2 inline-flex rounded bg-slate-200 px-2 py-0.5 text-[10px] font-bold text-slate-600">Disembunyikan</span>
                                        @endif
                                    </button>
                                    <div class="mt-2 flex gap-1">
                                        <form method="POST" action="{{ route('admin.agenda.toggle', $agenda) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="rounded border border-slate-200 bg-white px-2 py-1 text-[11px] font-bold text-slate-600 transition hover:bg-slate-50">
                                                {{ $agenda->is_active ? 'Hide' : 'Show' }}
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.agenda.destroy', $agenda) }}" data-delete-form data-delete-title="Hapus agenda?" data-delete-message="Data agenda yang dihapus tidak akan tampil lagi dan tidak bisa dikembalikan dari halaman ini.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded border border-red-200 bg-white px-2 py-1 text-[11px] font-bold text-red-700 transition hover:bg-red-50">Delete</button>
                                        </form>
                                    </div>
                                </article>
                            @empty
                                <button type="button" class="mt-4 hidden w-full rounded border border-dashed border-slate-200 px-2 py-3 text-xs font-semibold text-slate-400 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 md:block" data-agenda-create data-agenda-date="{{ $dateKey }}">
                                    Tambah
                                </button>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </section>

    <div id="agenda-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 px-4">
        <div class="w-full max-w-lg rounded-lg bg-white shadow-xl">
            <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                <h3 id="agenda-modal-title" class="font-bold text-slate-950">Tambah Agenda</h3>
                <button type="button" class="grid size-9 place-items-center rounded border border-slate-200 text-slate-600 transition hover:bg-slate-50" data-agenda-close aria-label="Tutup modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>

            <form id="agenda-form" method="POST" action="{{ route('admin.agenda.store') }}" class="space-y-4 p-5">
                @csrf
                <input type="hidden" name="_method" value="POST" data-agenda-method>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Judul Kegiatan</span>
                    <input type="text" name="judul" data-agenda-field="judul" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" required>
                </label>

                <div class="grid gap-4 md:grid-cols-3">
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Tanggal</span>
                        <input type="date" name="tanggal_event" data-agenda-field="tanggal_event" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600" required>
                    </label>
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Mulai</span>
                        <input type="time" name="waktu_mulai" data-agenda-field="waktu_mulai" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                    </label>
                    <label class="block">
                        <span class="text-sm font-semibold text-slate-700">Selesai</span>
                        <input type="time" name="waktu_selesai" data-agenda-field="waktu_selesai" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                    </label>
                </div>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Lokasi</span>
                    <input type="text" name="lokasi" data-agenda-field="lokasi" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold text-slate-700">Deskripsi</span>
                    <textarea name="deskripsi" rows="3" data-agenda-field="deskripsi" class="mt-2 w-full rounded border border-slate-300 px-4 py-3 outline-none transition focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"></textarea>
                </label>

                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <input type="checkbox" name="is_active" value="1" data-agenda-field="is_active" class="size-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-600" checked>
                    Tampilkan agenda di halaman public
                </label>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" class="rounded border border-slate-300 px-5 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50" data-agenda-close>Batal</button>
                    <button type="submit" class="rounded bg-emerald-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-800">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const agendaModal = document.querySelector('#agenda-modal');
        const agendaForm = document.querySelector('#agenda-form');
        const agendaTitle = document.querySelector('#agenda-modal-title');
        const agendaMethod = document.querySelector('[data-agenda-method]');
        const agendaStoreUrl = @js(route('admin.agenda.store'));

        const agendaFields = {
            judul: document.querySelector('[data-agenda-field="judul"]'),
            tanggal_event: document.querySelector('[data-agenda-field="tanggal_event"]'),
            waktu_mulai: document.querySelector('[data-agenda-field="waktu_mulai"]'),
            waktu_selesai: document.querySelector('[data-agenda-field="waktu_selesai"]'),
            lokasi: document.querySelector('[data-agenda-field="lokasi"]'),
            deskripsi: document.querySelector('[data-agenda-field="deskripsi"]'),
            is_active: document.querySelector('[data-agenda-field="is_active"]'),
        };

        const openAgendaModal = () => {
            agendaModal.classList.remove('hidden');
            agendaModal.classList.add('flex');
        };

        const closeAgendaModal = () => {
            agendaModal.classList.add('hidden');
            agendaModal.classList.remove('flex');
        };

        const resetAgendaForm = (date = '') => {
            agendaForm.action = agendaStoreUrl;
            agendaMethod.value = 'POST';
            agendaTitle.textContent = 'Tambah Agenda';
            agendaForm.reset();
            agendaFields.tanggal_event.value = date;
            agendaFields.is_active.checked = true;
        };

        document.querySelectorAll('[data-agenda-create]').forEach((button) => {
            button.addEventListener('click', () => {
                resetAgendaForm(button.dataset.agendaDate || '');
                openAgendaModal();
            });
        });

        document.querySelectorAll('[data-agenda-edit]').forEach((button) => {
            button.addEventListener('click', () => {
                const agenda = JSON.parse(button.dataset.agenda);

                agendaForm.action = agenda.update_url;
                agendaMethod.value = 'PUT';
                agendaTitle.textContent = 'Edit Agenda';
                agendaFields.judul.value = agenda.judul || '';
                agendaFields.tanggal_event.value = agenda.tanggal_event || '';
                agendaFields.waktu_mulai.value = agenda.waktu_mulai || '';
                agendaFields.waktu_selesai.value = agenda.waktu_selesai || '';
                agendaFields.lokasi.value = agenda.lokasi || '';
                agendaFields.deskripsi.value = agenda.deskripsi || '';
                agendaFields.is_active.checked = Boolean(agenda.is_active);
                openAgendaModal();
            });
        });

        document.querySelectorAll('[data-agenda-close]').forEach((button) => {
            button.addEventListener('click', closeAgendaModal);
        });

        agendaModal.addEventListener('click', (event) => {
            if (event.target === agendaModal) {
                closeAgendaModal();
            }
        });
    </script>
@endsection
