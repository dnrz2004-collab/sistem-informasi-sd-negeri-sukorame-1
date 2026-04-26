<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pengumuman;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'siswa'  => Siswa::count(),
            'guru'   => Guru::count(),
            'kelas'  => Kelas::count(),
            'mapel'  => MataPelajaran::count(),
        ];

        // Ambil 3 pengumuman terbaru untuk ditampilkan di landing
        $pengumuman = Pengumuman::latest()->take(3)->get();

        // Judul halaman
        $pageTitle = 'SD Negeri Sukorame 1 - Sistem Informasi Sekolah';

        return view('welcome', compact('stats', 'pengumuman', 'pageTitle'));
    }
}