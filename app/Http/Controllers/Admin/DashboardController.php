<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Siswa, Guru, Kelas, Pengumuman};

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_siswa'      => Siswa::count(),
            'total_guru'       => Guru::count(),
            'total_kelas'      => Kelas::count(),
            'pengumuman_terbaru' => Pengumuman::latest()->take(5)->get(),
        ];
        return view('admin.dashboard', compact('data'));
    }
}