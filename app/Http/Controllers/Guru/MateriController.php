<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\{Materi, Kelas, MataPelajaran};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $guru = auth()->user()->guru;
        $mapel = MataPelajaran::where('guru_id', $guru->id)->get();

        $query = Materi::with(['mataPelajaran', 'kelas'])
            ->where('guru_id', $guru->id);

        if ($request->filled('mata_pelajaran_id')) {
            $query->where('mata_pelajaran_id', $request->mata_pelajaran_id);
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        $materi = $query->latest()->paginate(12)->withQueryString();

        return view('guru.materi.index', compact('materi', 'mapel'));
    }

    public function create()
    {
        $guru  = auth()->user()->guru;
        $mapel = MataPelajaran::where('guru_id', $guru->id)->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('guru.materi.create', compact('mapel', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'kelas_id'          => 'required|exists:kelas,id',
            'tipe'              => 'required|in:file,link,video',
            'link_video'        => 'nullable|url|required_if:tipe,link|required_if:tipe,video',
            'file'              => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip|max:20480|required_if:tipe,file',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materi/file', 'public');
        }

        Materi::create([
            'judul'             => $request->judul,
            'deskripsi'         => $request->deskripsi,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'kelas_id'          => $request->kelas_id,
            'guru_id'           => auth()->user()->guru->id,
            'tipe'              => $request->tipe,
            'link_video'        => $request->link_video,
            'file'              => $filePath,
        ]);

        return redirect()->route('guru.materi.index')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(Materi $materi)
    {
        $materi->load(['mataPelajaran', 'kelas']);
        return view('guru.materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        $guru  = auth()->user()->guru;
        $mapel = MataPelajaran::where('guru_id', $guru->id)->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('guru.materi.edit', compact('materi', 'mapel', 'kelas'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'kelas_id'          => 'required|exists:kelas,id',
            'tipe'              => 'required|in:file,link,video',
            'link_video'        => 'nullable|url',
            'file'              => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip|max:20480',
        ]);

        $data = $request->only([
            'judul', 'deskripsi', 'mata_pelajaran_id', 'kelas_id', 'tipe', 'link_video',
        ]);

        if ($request->hasFile('file')) {
            if ($materi->file) {
                Storage::disk('public')->delete($materi->file);
            }
            $data['file'] = $request->file('file')->store('materi/file', 'public');
        }

        // Jika tipe bukan file, kosongkan file lama
        if ($request->tipe !== 'file' && $materi->file) {
            Storage::disk('public')->delete($materi->file);
            $data['file'] = null;
        }

        // Jika tipe file, kosongkan link_video
        if ($request->tipe === 'file') {
            $data['link_video'] = null;
        }

        $materi->update($data);

        return redirect()->route('guru.materi.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->file) {
            Storage::disk('public')->delete($materi->file);
        }
        $materi->delete();

        return redirect()->route('guru.materi.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
}