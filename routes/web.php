<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AkunBelanjaController;
use App\Http\Controllers\TransaksiAnggaranController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KerjasamaController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/testenv', function () {
    return 'CONFIGKEY:' . config('app.key') . '--ENVKEY:' . env('APP_KEY');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Capaian Route
    Route::get('/capaian', function () {
        return view('capaian.index');
    })->name('capaian');

    // DTS Routes
    Route::prefix('dts')->name('dts.')->group(function () {
        Route::get('/program', function () {
            return view('dts.program');
        })->name('program');
    });

    // Pegawai Routes
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/kp', [PegawaiController::class, 'kpDashboard'])->name('pegawai.kp');
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai/import', [PegawaiController::class, 'import'])->name('pegawai.import');
    Route::get('/pegawai/export/pdf', [PegawaiController::class, 'exportPdf'])->name('pegawai.exportPdf');
    Route::get('/pegawai/chart', [PegawaiController::class, 'chart'])->name('pegawai.chart');
    Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::post('/pegawai/{id}/update', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

    // Kerjasama Routes
    Route::get('/kerjasama/laporan', [KerjasamaController::class, 'laporan'])->name('kerjasama.laporan');
    Route::resource('kerjasama', KerjasamaController::class);
    Route::post('/kerjasama/import', [KerjasamaController::class, 'import'])->name('kerjasama.import');
    Route::get('/kerjasama/export/pdf', [KerjasamaController::class, 'exportPdf'])->name('kerjasama.exportPdf');
    Route::get('/kerjasama/{id}/download', [KerjasamaController::class, 'download'])->name('kerjasama.download');

    // Keuangan Routes
    Route::get('keuangan/laporan', [FinanceController::class, 'laporan'])->name('keuangan.laporan');
    Route::get('keuangan/export/excel', [FinanceController::class, 'exportExcel'])->name('keuangan.export.excel');
    Route::get('keuangan/export/pdf', [FinanceController::class, 'exportPdf'])->name('keuangan.export.pdf');

    Route::resource('akun-belanja', AkunBelanjaController::class);
    Route::resource('transaksi-anggaran', TransaksiAnggaranController::class);

    Route::middleware(['role:super_admin,admin'])->group(function () {
        Route::resource('admins', AdminController::class);
        Route::resource('keuangan', FinanceController::class);
    });

    // Anggaran Routes
    Route::prefix('anggaran')->group(function () {
        Route::get('/', [AnggaranController::class, 'index'])->name('anggaran.index');
        Route::get('/create', [AnggaranController::class, 'create'])->name('anggaran.create');
        Route::post('/', [AnggaranController::class, 'store'])->name('anggaran.store');
        Route::get('/{id}/edit', [AnggaranController::class, 'edit'])->name('anggaran.edit');
        Route::put('/{id}', [AnggaranController::class, 'update'])->name('anggaran.update');
        Route::delete('/{id}', [AnggaranController::class, 'destroy'])->name('anggaran.destroy');

        // Realisasi Routes
        Route::get('/realisasi/input', [AnggaranController::class, 'realisasi'])->name('anggaran.realisasi'); // Input view
        Route::get('/laporan', [AnggaranController::class, 'laporan'])->name('anggaran.laporan'); // Report view
        Route::get('/laporan/pdf', [AnggaranController::class, 'exportLaporan'])->name('anggaran.laporan.pdf'); // Export PDF
        Route::post('/realisasi/store', [AnggaranController::class, 'storeRealisasi'])->name('anggaran.storeRealisasi');
        Route::put('/realisasi/update/{id}', [AnggaranController::class, 'updateRealisasi'])->name('anggaran.updateRealisasi');

        // Quick update for inline editing
        Route::post('/{id}/quick-update', [AnggaranController::class, 'quickUpdate'])->name('anggaran.quickUpdate');

        // API endpoints for cascade dropdowns
        Route::get('/api/children/{parentId}', [AnggaranController::class, 'getChildren']);
    });
});