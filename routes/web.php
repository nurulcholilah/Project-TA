<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisAkunController;
use App\Http\Controllers\KasbonController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanPemasukanController;
use App\Http\Controllers\LaporanPengeluaranController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:admin|pegawai'])
    ->name('dashboard');

Route::middleware(['auth', 'verified',])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('pemasukan', PemasukanController::class)->middleware(['auth', 'verified', 'role:admin']);
    Route::resource('kategori', KategoriController::class)->middleware(['auth', 'verified', 'role:admin|pegawai']);
    Route::resource('saldo', SaldoController::class)->middleware(['auth', 'verified', 'role:admin']);
    Route::resource('pengeluaran', PengeluaranController::class)->middleware(['auth', 'verified', 'role:admin']);
    Route::get('pengeluaran/{id_pengeluaran}', 'PengeluaranController@show')->name('pengeluaran.show')->middleware(['auth', 'verified', 'role:admin']);
    Route::resource('user', UserController::class)->middleware(['auth', 'verified', 'role:admin']);
    Route::resource('anggaran', AnggaranController::class)->middleware(['auth', 'verified', 'role:admin|pegawai']);
    Route::resource('kasbon', KasbonController::class)->middleware(['auth', 'verified', 'role:admin']);
    Route::resource('pengajuan', PengajuanController::class)->middleware(['auth', 'verified', 'role:admin|pegawai']);
    Route::post('/pengajuan/{id}/approve', [PengajuanController::class, 'approve'])->name('pengajuan.approve')->middleware(['auth', 'verified', 'role:admin']);
    Route::post('/pengajuan/{id}/reject', [PengajuanController::class, 'reject'])->name('pengajuan.reject')->middleware(['auth', 'verified', 'role:admin']);
    Route::get('laporan-pemasukan', [LaporanPemasukanController::class, 'index'])->name('laporan.pemasukan')->middleware(['auth', 'verified', 'role:admin|pegawai']);
    Route::get('/laporan-pemasukan/pdf', [LaporanPemasukanController::class, 'exportPDF'])->name('laporan.pemasukan.pdf');
    Route::get('laporan-pengeluaran', [LaporanPengeluaranController::class, 'index'])->name('laporan.pengeluaran')->middleware(['auth', 'verified', 'role:admin|pegawai']);
    Route::get('/laporan-pengeluaran/pdf', [LaporanPengeluaranController::class, 'exportPDF'])->name('laporan.pengeluaran.pdf');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index')->middleware(['auth', 'verified', 'role:admin|pegawai']);
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPDF'])->name('laporan.exportPDF');
});

require __DIR__ . '/auth.php';
