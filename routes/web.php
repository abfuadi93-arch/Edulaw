<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\InsightAdminController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminOpinionController;

use App\Models\Opinion;

/*
|--------------------------------------------------------------------------
| Public pages
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/program', 'pages.program')->name('program');
Route::view('/publikasi', 'pages.publikasi')->name('publikasi');
Route::view('/tentang', 'pages.tentang')->name('tentang');

/*
|--------------------------------------------------------------------------
| Insights (artikel)
|--------------------------------------------------------------------------
*/
Route::get('/insight', [InsightController::class, 'index'])->name('insight.index');
Route::get('/insight/{slug}', [InsightController::class, 'show'])->name('insight.show');

/*
|--------------------------------------------------------------------------
| Opinions (user submission)
|--------------------------------------------------------------------------
| NOTE:
| - Route name yang dipakai di view: opinions.create & opinions.store
| - Jika view masih memanggil kirim-opini.store, ubah view -> route('opinions.store')
|--------------------------------------------------------------------------
*/
Route::bind('opinion', function ($value) {
    return Opinion::where('slug', $value)->firstOrFail();
});

Route::middleware('auth')->group(function () {
    Route::get('/kirim-opini', [OpinionController::class, 'create'])->name('opinions.create');

    Route::post('/kirim-opini', [OpinionController::class, 'store'])
        ->middleware('throttle:20,1')
        ->name('opinions.store');
});

/*
|--------------------------------------------------------------------------
| Admin (superadmin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'superadmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Insights admin (CRUD)
        Route::resource('insights', InsightAdminController::class)->except(['show']);

        // Preview (admin boleh lihat draft/published)
        Route::get('insights/{insight}/preview', [InsightAdminController::class, 'preview'])
            ->name('insights.preview');

        // Settings
        Route::get('settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');

        // Opinions admin
        Route::get('opinions', [AdminOpinionController::class, 'index'])->name('opinions.index');
        Route::get('opinions/{opinion}', [AdminOpinionController::class, 'show'])->name('opinions.show');
        Route::post('opinions/{opinion}', [AdminOpinionController::class, 'update'])->name('opinions.update');
    });

/*
|--------------------------------------------------------------------------
| Authenticated area
|--------------------------------------------------------------------------
*/
Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
