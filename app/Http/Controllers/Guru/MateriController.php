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
        $guru  = auth()->user()->guru;
        $mapel = MataPelajaran::where('guru_id', $guru->id)->get();

        $query = Materi::with('mataPelajaran')
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
        return view('guru.materi.create', compact('mapel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'tipe'              => 'required|in:materi,tugas,uts,uas',
            'link_video'        => 'nullable|url',
            'file'              => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480',
            'deadline'          => 'nullable|date',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materi/file', 'public');
        }

        Materi::create([
            'judul'             => $request->judul,
            'deskripsi'         => $request->deskripsi,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'guru_id'           => auth()->user()->guru->id,
            'tipe'              => $request->tipe,
            'link_video'        => $request->link_video,
            'file'              => $filePath,
            'deadline'          => $request->deadline,
        ]);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Materi $materi)
    {
        $mapel = MataPelajaran::where('guru_id', auth()->user()->guru->id)->get();
        return view('guru.materi.edit', compact('materi', 'mapel'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'tipe'              => 'required|in:materi,tugas,uts,uas',
            'link_video'        => 'nullable|url',
            'file'              => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480',
            'deadline'          => 'nullable|date',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'mata_pelajaran_id', 'tipe', 'link_video', 'deadline']);

        if ($request->hasFile('file')) {
            if ($materi->file) Storage::disk('public')->delete($materi->file);
            $data['file'] = $request->file('file')->store('materi/file', 'public');
        }

        $materi->update($data);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->file) Storage::disk('public')->delete($materi->file);
        $materi->delete();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
