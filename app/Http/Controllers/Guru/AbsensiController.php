<?php
namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\{Absensi, Kelas, Siswa};
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $guru = auth()->user()->guru;
        $kelas = Kelas::where('wali_kelas_id', auth()->id())->with('siswa')->get();
        $absensi = Absensi::whereHas('kelas', fn($q) =>
            $q->where('wali_kelas_id', auth()->id())
        )->latest()->paginate(20);

        return view('guru.absensi.index', compact('kelas', 'absensi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id'  => 'required|exists:kelas,id',
            'tanggal'   => 'required|date',
            'absensi'   => 'required|array',
        ]);

        foreach ($request->absensi as $siswaId => $status) {
            Absensi::updateOrCreate(
                ['siswa_id' => $siswaId, 'tanggal' => $request->tanggal, 'kelas_id' => $request->kelas_id],
                ['status' => $status, 'keterangan' => $request->keterangan[$siswaId] ?? null]
            );
        }

        return back()->with('success', 'Absensi berhasil disimpan.');
    }
}