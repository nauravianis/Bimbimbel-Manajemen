<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RekapAbsensiGuruController;
use App\Http\Controllers\JadwalSiswaController;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.page');

    //siswa
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('keuangan', KeuanganController::class)->only(['index', 'create', 'store']);

    //keuangan
    Route::get('/keuangan/riwayat', [TransaksiController::class, 'riwayat'])->name('keuangan.riwayat');
    Route::get('/transaksi/paket', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/paket', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/struk/{id}', [TransaksiController::class, 'struk'])->name('transaksi.struk');

    //absensi (guru)
    Route::controller(AbsensiController::class)->group(function () {
        Route::get('/absensi', 'index')->name('absensi.index');
        Route::get('/absensi/scan', 'scanPage')->name('absensi.scan.page');
        Route::post('/absensi/scan', 'scan')->name('absensi.scan');
        Route::get('/absensi/qr-guru', 'qrGuru')->name('absensi.qr.guru');
        Route::post('/absensi/qr-guru/{guru}', 'generateQr')->name('absensi.qr.generate');
    });

    //jadwal
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/siswa/{paket_id}/{siswa_id}', [JadwalSiswaController::class, 'siswaJadwal'])->name('jadwal.siswa');

    // Manage jadwal
    Route::get('/jadwal/manage', [JadwalController::class, 'manage'])->name('jadwal.manage');

    // CRUD
    Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');


    //absen siswa
    Route::get('/jadwal/absen/{id}', [JadwalSiswaController::class, 'showAbsenKelas'])->name('absen.kelas');
    Route::post('/jadwal/absen/simpan', [JadwalSiswaController::class, 'simpanAbsenMasal'])->name('absen.simpan');
    Route::get('/monitoring-kuota', [JadwalSiswaController::class, 'monitoringKuota'])->name('monitoring.kuota');

    //gaji
    Route::get('/gaji', [GajiController::class, 'index'])->name('gaji.index');
    Route::get('/gaji/slip/{id}', [GajiController::class, 'show'])->name('gaji.show');
    Route::post('/gaji/store', [GajiController::class, 'store'])->name('gaji.store');
    Route::post('/guru/update-tarif/{id}', [GuruController::class, 'updateTarif'])->name('guru.update-tarif');

    //rekap guru
    Route::get('/absensi/rekap-guru', [RekapAbsensiGuruController::class, 'index'])->name('absensi.rekap-guru');

    //jadwal guru
    Route::get('/jadwal/jadwal_guru/{guru_id}', [JadwalController::class, 'guruJadwal'])->name('jadwal.jadwal_guru');



});