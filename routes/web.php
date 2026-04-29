<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// ─── ADMIN ───────────────────────────────────────────────────────────────────
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboard,
    SiswaController,
    GuruController,
    KelasController,
    MataPelajaranController,
    PengumumanController,
    SekolahController
};

// ─── GURU ────────────────────────────────────────────────────────────────────
use App\Http\Controllers\Guru\{
    DashboardController as GuruDashboard,
    AbsensiController,
    NilaiController,
    MateriController,
    MbgController,
    TugasController as GuruTugas,
    ForumController as GuruForum
};

// ─── WALI MURID ──────────────────────────────────────────────────────────────
use App\Http\Controllers\Wali\{
    DashboardController as WaliDashboard,
    RaportWaliController,
    KehadiranWaliController,
    TugasWaliController,
    PengumumanWaliController
};

// ─── SISWA ───────────────────────────────────────────────────────────────────
use App\Http\Controllers\Siswa\{
    DashboardController as SiswaDashboard,
    ElearningController,
    RaportSiswaController,
    MateriController as SiswaMateri,
    TugasController as SiswaTugas,
    AbsensiController as SiswaAbsensi
};

// ─── AUTH ────────────────────────────────────────────────────────────────────
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

// ─── PASSWORD RESET ───────────────────────────────────────────────────────────
Route::get('/forgot-password',          [LoginController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password',         [LoginController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}',   [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password',          [LoginController::class, 'resetPassword'])->name('password.store');

// ─── ADMIN ───────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::resource('siswa', SiswaController::class);

    // Guru
    Route::get('/guru',             [GuruController::class, 'index'])->name('guru.index');
    Route::post('/guru',            [GuruController::class, 'store'])->name('guru.store');
    Route::put('/guru/{guru}',      [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{guru}',   [GuruController::class, 'destroy'])->name('guru.destroy');
    Route::get('/guru/export',      [GuruController::class, 'export'])->name('guru.export');
    Route::post('/guru/import',     [GuruController::class, 'import'])->name('guru.import');

    Route::resource('kelas', KelasController::class);

    // Mata Pelajaran
    Route::get('/mata-pelajaran',                       [MataPelajaranController::class, 'index'])->name('mata-pelajaran.index');
    Route::post('/mata-pelajaran',                      [MataPelajaranController::class, 'store'])->name('mata-pelajaran.store');
    Route::put('/mata-pelajaran/{mata_pelajaran}',      [MataPelajaranController::class, 'update'])->name('mata-pelajaran.update');
    Route::delete('/mata-pelajaran/{mata_pelajaran}',   [MataPelajaranController::class, 'destroy'])->name('mata-pelajaran.destroy');

    Route::resource('pengumuman', PengumumanController::class);

    Route::get('/sekolah',  [SekolahController::class, 'index'])->name('sekolah');
    Route::put('/sekolah',  [SekolahController::class, 'update'])->name('sekolah.update');
});

// ─── GURU ────────────────────────────────────────────────────────────────────
Route::prefix('guru')->name('guru.')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');

    // ── LAMA ──────────────────────────────────────────────────────────────────
    Route::resource('absensi', AbsensiController::class);
    Route::resource('nilai',   NilaiController::class);
    Route::resource('materi',  MateriController::class);
    Route::get('/mbg', [MbgController::class, 'index'])->name('mbg');

    // ── BARU: Tugas ───────────────────────────────────────────────────────────
    Route::resource('tugas', GuruTugas::class);
    Route::get('/tugas/{tugas}/penilaian',      [GuruTugas::class, 'penilaian'])->name('tugas.penilaian');
    Route::post('/tugas/{tugas}/simpan-nilai',  [GuruTugas::class, 'simpanNilai'])->name('tugas.simpan-nilai');

    // ── BARU: Forum Diskusi ───────────────────────────────────────────────────
    Route::get('/forum',                        [GuruForum::class, 'index'])->name('forum.index');
    Route::post('/forum',                       [GuruForum::class, 'store'])->name('forum.store');
    Route::get('/forum/{forum}',                [GuruForum::class, 'show'])->name('forum.show');
    Route::delete('/forum/{forum}',             [GuruForum::class, 'destroy'])->name('forum.destroy');
    Route::post('/forum/{forum}/komentar',      [GuruForum::class, 'komentar'])->name('forum.komentar');
    Route::delete('/forum/komentar/{komentar}', [GuruForum::class, 'hapusKomentar'])->name('forum.komentar.hapus');
    Route::patch('/forum/{forum}/pin',          [GuruForum::class, 'togglePin'])->name('forum.pin');
});

// ─── WALI MURID ──────────────────────────────────────────────────────────────
Route::prefix('wali')->name('wali.')->middleware(['auth', 'role:wali_murid'])->group(function () {
    Route::get('/dashboard', [WaliDashboard::class, 'index'])->name('dashboard');

    // ── LAMA ──────────────────────────────────────────────────────────────────
    Route::get('/raport',     [RaportWaliController::class,  'index'])->name('raport');
    Route::get('/kehadiran',  [KehadiranWaliController::class, 'index'])->name('kehadiran');

    // ── BARU: Tugas Anak ──────────────────────────────────────────────────────
    Route::get('/tugas', [TugasWaliController::class, 'index'])->name('tugas');

    // ── BARU: Pengumuman ──────────────────────────────────────────────────────
    Route::get('/pengumuman',               [PengumumanWaliController::class, 'index'])->name('pengumuman.index');
    Route::get('/pengumuman/{pengumuman}',  [PengumumanWaliController::class, 'show'])->name('pengumuman.show');
});

// ─── SISWA ───────────────────────────────────────────────────────────────────
Route::prefix('siswa')->name('siswa.')->middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

    // ── LAMA ──────────────────────────────────────────────────────────────────
    Route::get('/elearning', [ElearningController::class,  'index'])->name('elearning');
    Route::get('/raport',    [RaportSiswaController::class, 'index'])->name('raport');

    // ── BARU: Materi ──────────────────────────────────────────────────────────
    Route::get('/materi',           [SiswaMateri::class, 'index'])->name('materi.index');
    Route::get('/materi/{materi}',  [SiswaMateri::class, 'show'])->name('materi.show');

    // ── BARU: Tugas ───────────────────────────────────────────────────────────
    Route::get('/tugas',                        [SiswaTugas::class, 'index'])->name('tugas.index');
    Route::get('/tugas/{tugas}',                [SiswaTugas::class, 'show'])->name('tugas.show');
    Route::post('/tugas/{tugas}/kumpulkan',     [SiswaTugas::class, 'kumpulkan'])->name('tugas.kumpulkan');

    // ── BARU: Absensi ─────────────────────────────────────────────────────────
    Route::get('/absensi', [SiswaAbsensi::class, 'index'])->name('absensi.index');
});