<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Models\Berita;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $beritas = Berita::where('is_active', true)->latest('tanggal_berita')->latest()->take(3)->get();
    $totalBerita = Berita::where('is_active', true)->count();

    return view('welcome', compact('beritas', 'totalBerita'));
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
});
