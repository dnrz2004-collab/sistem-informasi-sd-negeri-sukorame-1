<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\{Tugas, PengumpulanTugas, Kelas, MataPelajaran, Guru};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    private function getGuruId()
    {
        return auth()->user()->guru->id;
    }

    // ── DAFTAR TUGAS ──────────────────────────────────────────────────────────
    public function index(Request $request)
    {
        $guru   = auth()->user()->guru;
        $kelas  = Kelas::where('wali_kelas_id', auth()->id())->get();
        $mapel  = MataPelajaran::where('guru_id', $guru->id)->get();

        $query = Tugas::with(['kelas', 'mataPelajaran', 'pengumpulan'])
            ->where('guru_id', $guru->id);

        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tugas = $query->latest()->paginate(10)->withQueryString();

        return view('guru.tugas.index', compact('tugas', 'kelas', 'mapel'));
    }

    // ── FORM BUAT TUGAS ───────────────────────────────────────────────────────
    public function create()
    {
        $guru  = auth()->user()->guru;
        $kelas = Kelas::where('wali_kelas_id', auth()->id())->get();
        $mapel = MataPelajaran::where('guru_id', $guru->id)->get();

        return view('guru.tugas.create', compact('kelas', 'mapel'));
    }

    // ── SIMPAN TUGAS BARU ─────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'kelas_id'          => 'required|exists:kelas,id',
            'deadline'          => 'nullable|date|after:now',
            'file'              => 'nullable|file|max:10240',
            'status'            => 'required|in:aktif,draft',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tugas/file', 'public');
        }

        Tugas::create([
            'judul'             => $request->judul,
            'deskripsi'         => $request->deskripsi,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'kelas_id'          => $request->kelas_id,
            'guru_id'           => $this->getGuruId(),
            'deadline'          => $request->deadline,
            'file'              => $filePath,
            'status'            => $request->status,
        ]);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dibuat.');
    }

    // ── DETAIL TUGAS ──────────────────────────────────────────────────────────
    public function show(Tugas $tugas)
    {
        $this->authorize_guru($tugas);

        $pengumpulan = PengumpulanTugas::with('siswa.user')
            ->where('tugas_id', $tugas->id)
            ->get()
            ->keyBy('siswa_id');

        $siswaKelas = $tugas->kelas->siswa()->with('user')->get();

        return view('guru.tugas.show', compact('tugas', 'pengumpulan', 'siswaKelas'));
    }

    // ── EDIT TUGAS ────────────────────────────────────────────────────────────
    public function edit(Tugas $tugas)
    {
        $this->authorize_guru($tugas);
        $kelas = Kelas::where('wali_kelas_id', auth()->id())->get();
        $mapel = MataPelajaran::where('guru_id', $this->getGuruId())->get();

        return view('guru.tugas.edit', compact('tugas', 'kelas', 'mapel'));
    }

    // ── UPDATE TUGAS ──────────────────────────────────────────────────────────
    public function update(Request $request, Tugas $tugas)
    {
        $this->authorize_guru($tugas);

        $request->validate([
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'kelas_id'          => 'required|exists:kelas,id',
            'deadline'          => 'nullable|date',
            'file'              => 'nullable|file|max:10240',
            'status'            => 'required|in:aktif,draft,selesai',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'mata_pelajaran_id', 'kelas_id', 'deadline', 'status']);

        if ($request->hasFile('file')) {
            if ($tugas->file) Storage::disk('public')->delete($tugas->file);
            $data['file'] = $request->file('file')->store('tugas/file', 'public');
        }

        $tugas->update($data);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    // ── HAPUS TUGAS ───────────────────────────────────────────────────────────
    public function destroy(Tugas $tugas)
    {
        $this->authorize_guru($tugas);
        if ($tugas->file) Storage::disk('public')->delete($tugas->file);
        $tugas->delete();

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }

    // ── HALAMAN PENILAIAN TUGAS ───────────────────────────────────────────────
    public function penilaian(Tugas $tugas)
    {
        $this->authorize_guru($tugas);

        $siswaKelas  = $tugas->kelas->siswa()->with('user')->get();
        $pengumpulan = PengumpulanTugas::with('siswa')
            ->where('tugas_id', $tugas->id)
            ->get()
            ->keyBy('siswa_id');

        return view('guru.tugas.penilaian', compact('tugas', 'siswaKelas', 'pengumpulan'));
    }

    // ── SIMPAN NILAI TUGAS ────────────────────────────────────────────────────
    public function simpanNilai(Request $request, Tugas $tugas)
    {
        $this->authorize_guru($tugas);

        $request->validate([
            'nilai'    => 'required|array',
            'feedback' => 'nullable|array',
        ]);

        foreach ($request->nilai as $siswaId => $nilai) {
            PengumpulanTugas::where('tugas_id', $tugas->id)
                ->where('siswa_id', $siswaId)
                ->update([
                    'nilai'    => $nilai,
                    'feedback' => $request->feedback[$siswaId] ?? null,
                ]);
        }

        return back()->with('success', 'Nilai berhasil disimpan.');
    }

    // ── HELPER ────────────────────────────────────────────────────────────────
    private function authorize_guru(Tugas $tugas)
    {
        if ($tugas->guru_id !== $this->getGuruId()) {
            abort(403, 'Anda tidak memiliki akses ke tugas ini.');
        }
    }
}
