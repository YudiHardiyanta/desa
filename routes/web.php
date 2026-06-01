<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\GalleryCollection;
use App\Models\GalleryPhoto;
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
    $galleryCollections = GalleryCollection::where('is_active', true)
        ->with(['activePhotos' => fn ($query) => $query->latest()->take(4)])
        ->withCount(['activePhotos as active_photos_count'])
        ->latest()
        ->take(3)
        ->get();
    $galleryPhotos = GalleryPhoto::where('is_active', true)
        ->whereNull('gallery_collection_id')
        ->latest()
        ->take(4)
        ->get();
    $totalGaleri = GalleryCollection::where('is_active', true)->count()
        + GalleryPhoto::where('is_active', true)->whereNull('gallery_collection_id')->count();

    return view('welcome', compact('beritas', 'totalBerita', 'agendas', 'agendaCalendar', 'agendaMonthDays', 'galleryCollections', 'galleryPhotos', 'totalGaleri'));
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

Route::get('/galeri', function () {
    $collections = GalleryCollection::where('is_active', true)
        ->with(['activePhotos' => fn ($query) => $query->latest()->take(6)])
        ->withCount(['activePhotos as active_photos_count'])
        ->latest()
        ->paginate(6);
    $standalonePhotos = GalleryPhoto::where('is_active', true)
        ->whereNull('gallery_collection_id')
        ->latest()
        ->paginate(12, ['*'], 'foto');

    return view('galeri.index', compact('collections', 'standalonePhotos'));
})->name('galeri.index');

Route::get('/galeri/{collection}', function (GalleryCollection $collection) {
    abort_unless($collection->is_active, 404);

    $photos = $collection->activePhotos()->latest()->paginate(12);

    return view('galeri.show', compact('collection', 'photos'));
})->name('galeri.show');

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

    Route::get('/admin/galeri', [GalleryController::class, 'index'])
        ->name('admin.galeri.index');
    Route::get('/admin/galeri/collections/{collection}', [GalleryController::class, 'showCollection'])
        ->name('admin.galeri.collections.show');
    Route::post('/admin/galeri/collections', [GalleryController::class, 'storeCollection'])
        ->name('admin.galeri.collections.store');
    Route::put('/admin/galeri/collections/{collection}', [GalleryController::class, 'updateCollection'])
        ->name('admin.galeri.collections.update');
    Route::delete('/admin/galeri/collections/{collection}', [GalleryController::class, 'destroyCollection'])
        ->name('admin.galeri.collections.destroy');
    Route::post('/admin/galeri/photos', [GalleryController::class, 'storePhotos'])
        ->name('admin.galeri.photos.store');
    Route::put('/admin/galeri/photos/{photo}', [GalleryController::class, 'updatePhoto'])
        ->name('admin.galeri.photos.update');
    Route::patch('/admin/galeri/photos/{photo}/toggle', [GalleryController::class, 'togglePhoto'])
        ->name('admin.galeri.photos.toggle');
    Route::delete('/admin/galeri/photos/{photo}', [GalleryController::class, 'destroyPhoto'])
        ->name('admin.galeri.photos.destroy');
});
