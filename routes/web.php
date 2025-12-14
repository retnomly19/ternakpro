<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TernakController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\KategoriTernakController;
use App\Http\Controllers\JenisAktivitasController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PenjualanTernakController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanAdminController; // ✅ tambahkan controller admin laporan
use App\Http\Controllers\DashboardController;

 /*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root "/" sekarang menampilkan landing page `welcome`
Route::get('/', function () {
    return view('landing');
})->name('welcome');

// Semua route di bawah ini butuh login
Route::middleware('auth')->group(function () {

    // ==================== DASHBOARD USER ====================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/filter', [DashboardController::class, 'filterKategori'])->name('dashboard.filter');

    // ==================== DASHBOARD ADMIN ====================
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');

        // ✅ Tambahkan laporan untuk admin di dalam prefix admin
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/laporan', [LaporanAdminController::class, 'index'])->name('laporan.index');
            Route::get('/laporan/aktivitas', [LaporanAdminController::class, 'aktivitas'])->name('laporan.aktivitas');
            // kalau nanti mau tambah jenis laporan lain:
            // Route::get('/laporan/penjualan', [LaporanAdminController::class, 'penjualan'])->name('laporan.penjualan');
            // Route::get('/laporan/persediaan', [LaporanAdminController::class, 'persediaan'])->name('laporan.persediaan');
        });
    });

    // ==================== TERNAK ====================
    Route::resource('ternak', TernakController::class)->except(['show']);
    Route::delete('ternak/delete-multiple', [TernakController::class, 'destroyMultiple'])->name('ternak.destroyMultiple');

    // ==================== AKTIVITAS ====================
    Route::resource('aktivitas', AktivitasController::class);
    Route::get('aktivitas/{id}/detail', [AktivitasController::class, 'showDetail'])->name('aktivitas.showDetail');
    Route::post('aktivitas/{id}/detail', [AktivitasController::class, 'saveDetailTernak'])->name('aktivitas.saveDetailTernak');
    Route::get('aktivitas/{id}/print', [AktivitasController::class, 'print'])->name('aktivitas.print');
    Route::patch('aktivitas/{id}/status', [AktivitasController::class, 'updateStatus'])->name('aktivitas.updateStatus');

    // ==================== LAPORAN USER ====================
    Route::prefix('laporan')->group(function () {
        Route::get('aktivitas', [LaporanController::class, 'aktivitas'])->name('laporan.aktivitas');
        Route::get('persediaan', [LaporanController::class, 'persediaan'])->name('laporan.persediaan');
        Route::get('penjualan', [LaporanController::class, 'penjualan'])->name('laporan.penjualan');
        Route::get('kematian', [LaporanController::class, 'kematian'])->name('laporan.kematian');
    });

    // ==================== PROFIL ====================
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update.custom');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==================== KANDANG ====================
    Route::resource('kandang', KandangController::class);

    // ==================== KATEGORI TERNAK ====================
    Route::resource('kategori_ternak', KategoriTernakController::class);

    // ==================== JENIS AKTIVITAS ====================
    Route::resource('jenis_aktivitas', JenisAktivitasController::class)
        ->parameters(['jenis_aktivitas' => 'jenisAktivitas']);

    // ==================== SETTING ====================
    Route::prefix('setting')->group(function () {
        // PEMASOK
        Route::get('pemasok', [SettingController::class, 'pemasok'])->name('pemasok.index');
        Route::get('pemasok/create', [SettingController::class, 'createPemasok'])->name('pemasok.create');
        Route::post('pemasok', [SettingController::class, 'storePemasok'])->name('pemasok.store');
        Route::get('pemasok/{id}/edit', [SettingController::class, 'editPemasok'])->name('pemasok.edit');
        Route::put('pemasok/{id}', [SettingController::class, 'updatePemasok'])->name('pemasok.update');
        Route::delete('pemasok/{id}', [SettingController::class, 'destroyPemasok'])->name('pemasok.destroy');

        // MITRA
        Route::get('mitra', [SettingController::class, 'mitra'])->name('mitra.index');
        Route::get('mitra/create', [SettingController::class, 'createMitra'])->name('mitra.create');
        Route::post('mitra', [SettingController::class, 'storeMitra'])->name('mitra.store');
        Route::get('mitra/{id}/edit', [SettingController::class, 'editMitra'])->name('mitra.edit');
        Route::put('mitra/{id}', [SettingController::class, 'updateMitra'])->name('mitra.update');
        Route::delete('mitra/{id}', [SettingController::class, 'destroyMitra'])->name('mitra.destroy');

        // PELANGGAN
        Route::get('pelanggan', [SettingController::class, 'pelanggan'])->name('pelanggan.index');
        Route::get('pelanggan/create', [SettingController::class, 'createPelanggan'])->name('pelanggan.create');
        Route::post('pelanggan', [SettingController::class, 'storePelanggan'])->name('pelanggan.store');
        Route::get('pelanggan/{id}/edit', [SettingController::class, 'editPelanggan'])->name('pelanggan.edit');
        Route::put('pelanggan/{id}', [SettingController::class, 'updatePelanggan'])->name('pelanggan.update');
        Route::delete('pelanggan/{id}', [SettingController::class, 'destroyPelanggan'])->name('pelanggan.destroy');

        // PENJUALAN TERNAK
        Route::resource('penjualan_ternak', PenjualanTernakController::class);
    });
});

// Route bawaan auth (login, register, dll)
require __DIR__.'/auth.php';
