<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\{Tugas, PengumpulanTugas};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    private function getSiswa()
    {
        return auth()->user()->siswa;
    }

    // ── DAFTAR TUGAS SISWA ────────────────────────────────────────────────────
    public function index(Request $request)
    {
        $siswa = $this->getSiswa();

        $query = Tugas::with(['mataPelajaran', 'guru.user'])
            ->where('kelas_id', $siswa->kelas_id)
            ->where('status', '!=', 'draft');

        if ($request->filled('status_kumpul')) {
            $sudahKumpul = PengumpulanTugas::where('siswa_id', $siswa->id)->pluck('tugas_id');
            if ($request->status_kumpul === 'sudah') {
                $query->whereIn('id', $sudahKumpul);
            } else {
                $query->whereNotIn('id', $sudahKumpul);
            }
        }

        $tugas = $query->latest()->paginate(10)->withQueryString();

        // Tandai mana yang sudah dikumpulkan
        $dikumpulkan = PengumpulanTugas::where('siswa_id', $siswa->id)
            ->pluck('siswa_id', 'tugas_id');

        return view('siswa.tugas.index', compact('tugas', 'dikumpulkan', 'siswa'));
    }

    // ── DETAIL & KUMPULKAN TUGAS ──────────────────────────────────────────────
    public function show(Tugas $tugas)
    {
        $siswa       = $this->getSiswa();
        $pengumpulan = PengumpulanTugas::where('tugas_id', $tugas->id)
            ->where('siswa_id', $siswa->id)
            ->first();

        return view('siswa.tugas.show', compact('tugas', 'pengumpulan', 'siswa'));
    }

    // ── KUMPULKAN TUGAS ───────────────────────────────────────────────────────
    public function kumpulkan(Request $request, Tugas $tugas)
    {
        $siswa = $this->getSiswa();

        $request->validate([
            'file'    => 'nullable|file|max:10240',
            'catatan' => 'nullable|string|max:500',
        ]);

        $sudahAda = PengumpulanTugas::where('tugas_id', $tugas->id)
            ->where('siswa_id', $siswa->id)
            ->exists();

        if ($sudahAda) {
            return back()->with('error', 'Kamu sudah mengumpulkan tugas ini.');
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tugas/pengumpulan', 'public');
        }

        $status = 'tepat_waktu';
        if ($tugas->deadline && now()->gt($tugas->deadline)) {
            $status = 'terlambat';
        }

        PengumpulanTugas::create([
            'tugas_id'        => $tugas->id,
            'siswa_id'        => $siswa->id,
            'file'            => $filePath,
            'catatan'         => $request->catatan,
            'dikumpulkan_at'  => now(),
            'status'          => $status,
        ]);

        return back()->with('success', 'Tugas berhasil dikumpulkan.');
    }
}
