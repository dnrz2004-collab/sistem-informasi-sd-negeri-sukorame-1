<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\{DashboardController as AdminDashboard,
    SiswaController, GuruController, KelasController,
    MataPelajaranController, PengumumanController, SekolahController};
use App\Http\Controllers\Guru\{DashboardController as GuruDashboard,
    AbsensiController, NilaiController, MateriController, MbgController};
use App\Http\Controllers\Wali\{DashboardController as WaliDashboard,
    RaportWaliController, KehadiranWaliController};
use App\Http\Controllers\Siswa\{DashboardController as SiswaDashboard,
    ElearningController, RaportSiswaController};

// ─── AUTH ────────────────────────────────────────────────────────────────────
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ─── ADMIN ───────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('mata-pelajaran', MataPelajaranController::class);
    Route::resource('pengumuman', PengumumanController::class);
    Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah');
    Route::put('/sekolah', [SekolahController::class, 'update'])->name('sekolah.update');
});

// ─── GURU ────────────────────────────────────────────────────────────────────
Route::prefix('guru')->name('guru.')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');
    Route::resource('absensi', AbsensiController::class);
    Route::resource('nilai', NilaiController::class);
    Route::resource('materi', MateriController::class);
    Route::get('/mbg', [MbgController::class, 'index'])->name('mbg');
});

// ─── WALI MURID ──────────────────────────────────────────────────────────────
Route::prefix('wali')->name('wali.')->middleware(['auth', 'role:wali_murid'])->group(function () {
    Route::get('/dashboard', [WaliDashboard::class, 'index'])->name('dashboard');
    Route::get('/raport', [RaportWaliController::class, 'index'])->name('raport');
    Route::get('/kehadiran', [KehadiranWaliController::class, 'index'])->name('kehadiran');
});

// ─── SISWA ───────────────────────────────────────────────────────────────────
Route::prefix('siswa')->name('siswa.')->middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');
    Route::get('/elearning', [ElearningController::class, 'index'])->name('elearning');
    Route::get('/raport', [RaportSiswaController::class, 'index'])->name('raport');
});