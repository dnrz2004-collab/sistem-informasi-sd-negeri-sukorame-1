<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

// Controllers public baru
use App\Http\Controllers\Public\ProfilController;
use App\Http\Controllers\Public\AkademikController;
use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\PpdbController;
use App\Http\Controllers\Public\LayananController;

// ─── PUBLIC ──────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/visi-misi',   [ProfilController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/sejarah',     [ProfilController::class, 'sejarah'])->name('sejarah');
    Route::get('/struktur',    [ProfilController::class, 'struktur'])->name('struktur');
    Route::get('/komite',      [ProfilController::class, 'komite'])->name('komite');
    Route::get('/guru',        [ProfilController::class, 'guru'])->name('guru');
    Route::get('/sarana',      [ProfilController::class, 'sarana'])->name('sarana');
    Route::get('/akreditasi',  [ProfilController::class, 'akreditasi'])->name('akreditasi');
    Route::get('/prestasi',    [ProfilController::class, 'prestasi'])->name('prestasi');
});

// Akademik
Route::prefix('akademik')->name('akademik.')->group(function () {
    Route::get('/kurikulum',       [AkademikController::class, 'kurikulum'])->name('kurikulum');
    Route::get('/kalender',        [AkademikController::class, 'kalender'])->name('kalender');
    Route::get('/karakter',        [AkademikController::class, 'karakter'])->name('karakter');
    Route::get('/ekstrakurikuler', [AkademikController::class, 'ekstrakurikuler'])->name('ekstrakurikuler');
    Route::get('/literasi',        [AkademikController::class, 'literasi'])->name('literasi');
});

// Berita — urutan spesifik harus di atas /{id}
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/',           [BeritaController::class, 'index'])->name('index');
    Route::get('/pengumuman', [BeritaController::class, 'pengumuman'])->name('pengumuman');
    Route::get('/agenda',     [BeritaController::class, 'agenda'])->name('agenda');
    Route::get('/info-dinas', [BeritaController::class, 'infoDinas'])->name('info-dinas');
    Route::get('/{id}',       [BeritaController::class, 'show'])->name('show');
});

// Galeri
Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/foto',  [GaleriController::class, 'foto'])->name('foto');
    Route::get('/video', [GaleriController::class, 'video'])->name('video');
});

// PPDB
Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('/informasi', [PpdbController::class, 'info'])->name('info');
    Route::get('/syarat',    [PpdbController::class, 'syarat'])->name('syarat');
    Route::get('/jadwal',    [PpdbController::class, 'jadwal'])->name('jadwal');
    Route::get('/alur',      [PpdbController::class, 'alur'])->name('alur');
});

// Layanan
Route::prefix('layanan')->name('layanan.')->group(function () {
    Route::get('/mutasi',  [LayananController::class, 'mutasi'])->name('mutasi');
    Route::get('/surat',   [LayananController::class, 'surat'])->name('surat');
    Route::get('/izin',    [LayananController::class, 'izin'])->name('izin');
    Route::get('/nisn',    [LayananController::class, 'nisn'])->name('nisn');
    Route::get('/pip',     [LayananController::class, 'pip'])->name('pip');
    Route::get('/unduhan', [LayananController::class, 'unduhan'])->name('unduhan');
    Route::get('/alumni',  [LayananController::class, 'alumni'])->name('alumni');
});

// ─── AUTH ────────────────────────────────────────────────────────────────────
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ─── ADMIN ───────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('siswa', SiswaController::class);
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::put('/guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');
    Route::get('/guru/export', [GuruController::class, 'export'])->name('guru.export');
    Route::post('/guru/import', [GuruController::class, 'import'])->name('guru.import');
    Route::resource('kelas', KelasController::class);
    Route::get('/mata-pelajaran', [MataPelajaranController::class, 'index'])->name('mata-pelajaran.index');
    Route::post('/mata-pelajaran', [MataPelajaranController::class, 'store'])->name('mata-pelajaran.store');
    Route::put('/mata-pelajaran/{mata_pelajaran}', [MataPelajaranController::class, 'update'])->name('mata-pelajaran.update');
    Route::delete('/mata-pelajaran/{mata_pelajaran}', [MataPelajaranController::class, 'destroy'])->name('mata-pelajaran.destroy');
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