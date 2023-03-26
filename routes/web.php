<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JenisObatController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriObatController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ResepController;
use App\Models\JenisObat;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Auth;
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
Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create')->middleware('role:admin');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/showdokter/{id}', [DashboardController::class, 'showDokter'])->name('showDokter')->middleware('auth');
Route::get('/fetchobat/{id}', [PenjualanController::class, 'fetchObat'])->name('fetchObat')->middleware('auth');
Route::get('/penjualan-konfirm/{id}', [PenjualanController::class, 'konfirmasi'])->name('penjualan-konfirm')->middleware('auth');
Route::put('/penjualan-konfirm/{id}', [PenjualanController::class, 'konfirmasiUpdate'])->name('penjualan-konfirm-update')->middleware('auth');
Route::get('/dashboard/showapoteker/{id}', [DashboardController::class, 'showApoteker'])->name('showApoteker')->middleware('auth');
Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'index'])->name('pendaftaran.index')->middleware(['role:admin|dokter']);
Route::get('/cekantrian', [PendaftaranController::class, 'cekantrian'])->name('cekantrian')->middleware(['role:admin|dokter']);
Route::get('/live-antrian', [PendaftaranController::class, 'live'])->name('live')->middleware(['role:admin|dokter']);
Route::get('/pendaftaran-all', [PendaftaranController::class, 'all'])->name('pendaftaran.all')->middleware(['role:admin|dokter']);
Route::post('/pendaftaran/create', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::resource('poli', PoliController::class)->middleware(['role:admin']);
Route::resource('dokter', DokterController::class)->middleware(['role:admin']);
Route::resource('obat', ObatController::class)->middleware(['role:admin|apoteker']);
Route::resource('jadwal', JadwalController::class)->middleware(['role:admin']);
Route::resource('admin', AdminController::class)->middleware(['role:admin']);
Route::resource('kasir', KasirController::class)->middleware(['role:admin']);
Route::resource('apoteker', ApotekerController::class)->middleware(['role:admin']);
Route::get('/pasien', [PasienController::class, 'index'])->middleware(['role:dokter'])->name('pasien.index');
Route::get('/resep', [ResepController::class, 'index'])->middleware(['role:apoteker'])->name('resep.index');
Route::get('/resep/detail/{id}', [ResepController::class, 'show'])->middleware(['role:apoteker'])->name('resep.show');
Route::get('/resep/edit/{id}', [ResepController::class, 'edit'])->middleware('role:apoteker')->name('resep.edit');
Route::put('/resep/edit/{id}', [ResepController::class, 'update'])->middleware('role:apoteker')->name('resep.update');
Route::get('/periksa', [PeriksaController::class, 'index'])->middleware('role:dokter')->name('periksa.index');
Route::get('/periksa/create/{id}', [PeriksaController::class, 'create'])->middleware('role:dokter')->name('periksa.create');
Route::post('/periksa/create', [PeriksaController::class, 'store'])->middleware('role:dokter')->name('periksa.store');
Route::get('/periksa/edit/{id}', [PeriksaController::class, 'edit'])->middleware('role:dokter')->name('periksa.edit');
Route::put('/periksa/edit/{id}', [PeriksaController::class, 'update'])->middleware('role:dokter')->name('periksa.update');
Route::delete('/periksa/delete/{id}', [PeriksaController::class, 'destroy'])->middleware('role:dokter')->name('periksa.destroy');
Route::get('/pembayaran/create/{id}', [PembayaranController::class, 'create'])->middleware('role:apoteker')->name('pembayaran.create');
Route::post('/pembayaran/create', [PembayaranController::class, 'store'])->middleware('role:apoteker')->name('pembayaran.store');
Route::get('/laporan-pemeriksaan', [LaporanController::class, 'index'])->middleware('role:admin')->name('laporan.index');
Route::get('/laporan-penjualan', [LaporanController::class, 'penjualan'])->middleware(['role:apoteker|kasir'])->name('laporan.penjualan');
Route::resource('penjualan', PenjualanController::class)->middleware(['role:apoteker|kasir']);
Route::get('cetak-penjualan/{id}', [PenjualanController::class, 'invoice'])->middleware(['role:apoteker|kasir'])->name('cetak_penjualan');
Route::get('cetak-pembayaran/{id}', [PembayaranController::class, 'invoice'])->middleware(['role:apoteker'])->name('cetak_pembayaran');
Route::get('penjualan-sukses/{id}', [PenjualanController::class, 'sukses'])->middleware(['role:apoteker|kasir'])->name('penjualan-sukses');
Route::get('pembayaran-sukses/{id}', [PembayaranController::class, 'sukses'])->middleware(['role:apoteker'])->name('pembayaran-sukses');
Route::resource('jenis', JenisObatController::class)->middleware(['role:apoteker|admin']);
Route::resource('kategori', KategoriObatController::class)->middleware(['role:apoteker|admin']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
