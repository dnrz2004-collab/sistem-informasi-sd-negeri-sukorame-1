<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pengumuman;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Absensi 7 hari terakhir
        $absensiRaw = Absensi::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(6))
            ->where('status', 'hadir')
            ->groupBy(DB::raw('DATE(created_at)')) // ← ganti ini
            ->orderBy(DB::raw('DATE(created_at)'))
            ->get()
            ->keyBy('tanggal');

        $absensiLabels = [];
        $absensiData   = [];
        for ($i = 6; $i >= 0; $i--) {
            $tgl = now()->subDays($i)->format('Y-m-d');
            $absensiLabels[] = now()->subDays($i)->format('d/m');
            $absensiData[]   = $absensiRaw[$tgl]->total ?? 0;
        }

        // Aktivitas terbaru — gabungan siswa & guru baru
        $aktivitas = collect();

        Siswa::latest()->take(3)->get()->each(function ($s) use (&$aktivitas) {
            $aktivitas->push([
                'pesan' => 'Siswa baru ditambahkan: ' . $s->nama_lengkap,
                'waktu' => $s->created_at->diffForHumans(),
            ]);
        });

        Guru::with('user')->latest()->take(2)->get()->each(function ($g) use (&$aktivitas) {
            $aktivitas->push([
                'pesan' => 'Guru baru ditambahkan: ' . ($g->user?->name ?? '-'),
                'waktu' => $g->created_at->diffForHumans(),
            ]);
        });

        $aktivitas = $aktivitas->sortByDesc('waktu')->take(5)->values();

        $data = [
            'total_siswa'        => Siswa::count(),
            'total_guru'         => Guru::count(),
            'total_kelas'        => Kelas::count(),
            'total_mapel'        => MataPelajaran::count(),
            'pengumuman_terbaru' => Pengumuman::latest()->take(5)->get(),
            'siswa_terbaru'      => Siswa::with('kelas')->latest()->take(5)->get(),
            'absensi_labels'     => $absensiLabels,
            'absensi_data'       => $absensiData,
            'aktivitas'          => $aktivitas,
        ];

        return view('admin.dashboard', compact('data'));
    }
}