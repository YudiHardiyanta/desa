<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(Request $request): View
    {
        $currentMonth = Carbon::parse($request->query('month', now()->format('Y-m')) . '-01');
        $startOfCalendar = $currentMonth->copy()->startOfMonth()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $currentMonth->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $agendas = Agenda::query()
            ->whereBetween('tanggal_event', [$startOfCalendar->toDateString(), $endOfCalendar->toDateString()])
            ->orderBy('tanggal_event')
            ->orderBy('waktu_mulai')
            ->get();

        $agendaByDate = $agendas->groupBy(fn (Agenda $agenda): string => $agenda->tanggal_event->toDateString());
        $calendarDays = collect();

        for ($day = $startOfCalendar->copy(); $day->lte($endOfCalendar); $day->addDay()) {
            $calendarDays->push($day->copy());
        }

        return view('admin.agenda.index', [
            'agendas' => $agendas,
            'agendaByDate' => $agendaByDate,
            'calendarDays' => $calendarDays,
            'currentMonth' => $currentMonth,
            'previousMonth' => $currentMonth->copy()->subMonth()->format('Y-m'),
            'nextMonth' => $currentMonth->copy()->addMonth()->format('Y-m'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateAgenda($request);

        Agenda::create($validated + [
            'user_id' => Auth::id(),
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Agenda desa berhasil ditambahkan.');
    }

    public function update(Request $request, Agenda $agenda): RedirectResponse
    {
        $validated = $this->validateAgenda($request);

        $agenda->update($validated + [
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Agenda desa berhasil diperbarui.');
    }

    public function toggle(Agenda $agenda): RedirectResponse
    {
        $agenda->update(['is_active' => ! $agenda->is_active]);

        return back()->with('success', $agenda->is_active ? 'Agenda ditampilkan.' : 'Agenda disembunyikan.');
    }

    public function destroy(Agenda $agenda): RedirectResponse
    {
        $agenda->delete();

        return back()->with('success', 'Agenda desa berhasil dihapus.');
    }

    private function validateAgenda(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal_event' => ['required', 'date'],
            'waktu_mulai' => ['nullable', 'date_format:H:i'],
            'waktu_selesai' => ['nullable', 'date_format:H:i', 'after_or_equal:waktu_mulai'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
