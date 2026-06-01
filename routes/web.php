<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Models\Agenda;
use App\Models\Berita;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $beritas = Berita::where('is_active', true)->latest('tanggal_berita')->latest()->take(3)->get();
    $totalBerita = Berita::where('is_active', true)->count();
    $agendas = Agenda::where('is_active', true)
        ->whereDate('tanggal_event', '>=', now()->toDateString())
        ->orderBy('tanggal_event')
        ->orderBy('waktu_mulai')
        ->take(3)
        ->get();
    $agendaCalendar = Agenda::where('is_active', true)
        ->whereBetween('tanggal_event', [now()->copy()->startOfMonth()->toDateString(), now()->copy()->endOfMonth()->toDateString()])
        ->orderBy('tanggal_event')
        ->orderBy('waktu_mulai')
        ->get()
        ->groupBy(fn (Agenda $agenda): string => $agenda->tanggal_event->toDateString());
    $agendaMonthDays = collect();

    $agendaStartDay = now()->copy()->startOfMonth()->startOfWeek();
    $agendaEndDay = now()->copy()->endOfMonth()->endOfWeek();

    for ($day = $agendaStartDay; $day->lte($agendaEndDay); $day->addDay()) {
        $agendaMonthDays->push($day->copy());
    }

    return view('welcome', compact('beritas', 'totalBerita', 'agendas', 'agendaCalendar', 'agendaMonthDays'));
});

Route::get('/berita', function () {
    $beritas = Berita::where('is_active', true)->latest('tanggal_berita')->latest()->paginate(9);

    return view('berita.index', compact('beritas'));
})->name('berita.index');
Route::get('/berita/{berita}', function (Berita $berita) {
    abort_unless($berita->is_active, 404);

    $beritaLainnya = Berita::whereKeyNot($berita->id)
        ->where('is_active', true)
        ->latest('tanggal_berita')
        ->latest()
        ->take(3)
        ->get();

    return view('berita.show', compact('berita', 'beritaLainnya'));
})->name('berita.show');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/berita', [BeritaController::class, 'index'])
        ->name('admin.berita.index');
    Route::get('/admin/berita/create', [BeritaController::class, 'create'])
        ->name('admin.berita.create');
    Route::post('/admin/berita', [BeritaController::class, 'store'])
        ->name('admin.berita.store');
    Route::get('/admin/berita/{berita}/edit', [BeritaController::class, 'edit'])
        ->name('admin.berita.edit');
    Route::put('/admin/berita/{berita}', [BeritaController::class, 'update'])
        ->name('admin.berita.update');
    Route::patch('/admin/berita/{berita}/toggle', [BeritaController::class, 'toggle'])
        ->name('admin.berita.toggle');
    Route::delete('/admin/berita/{berita}', [BeritaController::class, 'destroy'])
        ->name('admin.berita.destroy');

    Route::get('/admin/agenda', [AgendaController::class, 'index'])
        ->name('admin.agenda.index');
    Route::post('/admin/agenda', [AgendaController::class, 'store'])
        ->name('admin.agenda.store');
    Route::put('/admin/agenda/{agenda}', [AgendaController::class, 'update'])
        ->name('admin.agenda.update');
    Route::patch('/admin/agenda/{agenda}/toggle', [AgendaController::class, 'toggle'])
        ->name('admin.agenda.toggle');
    Route::delete('/admin/agenda/{agenda}', [AgendaController::class, 'destroy'])
        ->name('admin.agenda.destroy');
});
