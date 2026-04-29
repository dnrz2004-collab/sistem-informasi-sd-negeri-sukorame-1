<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Models\Pengumuman; 
use Illuminate\Http\Request; 

class BeritaController extends Controller
{
    private function baseData(): array
    {
        return ['sekolah' => Sekolah::first()];
    }


    public function index(Request $request) 
    {
        $query = Pengumuman::query();

        // 1. Logika Filter Pencarian (Search)
        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        // 2. Logika Filter Kategori (Untuk)
        if ($request->filled('untuk')) {
            $query->where('untuk', $request->untuk);
        }

        // Ambil datanya, urutkan yang terbaru
        $pengumuman = $query->latest()->paginate(9)->withQueryString(); 
        // ^ withQueryString() itu penting biar pas pindah halaman (pagination), 
        // filternya nggak ilang di URL.

        // 3. Tambahan buat variabel totalAktif (biar statistik di hero section jalan)
        $totalAktif = Pengumuman::where('is_aktif', true)->count();

        return view('public.berita.index', array_merge($this->baseData(), [
            'pageTitle'   => 'Berita Sekolah — SDN Sukorame 1',
            'pengumuman'  => $pengumuman,
            'totalAktif'  => $totalAktif, // Kirim ini juga ya!
        ]));
    }

    public function show($id)
    {
        $item = Pengumuman::findOrFail($id);

        return view('public.berita.show', array_merge($this->baseData(), [
            'pageTitle' => $item->judul . ' — SDN Sukorame 1',
            'item'      => $item,
        ]));
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::latest()->paginate(10);

        return view('public.berita.pengumuman', array_merge($this->baseData(), [
            'pageTitle'   => 'Pengumuman — SDN Sukorame 1',
            'pengumuman'  => $pengumuman,
        ]));
    }

    public function agenda()
    {
        return view('public.berita.agenda', array_merge($this->baseData(), [
            'pageTitle' => 'Agenda Kegiatan — SDN Sukorame 1',
        ]));
    }

    public function infoDinas()
    {
        return view('public.berita.info-dinas', array_merge($this->baseData(), [
            'pageTitle' => 'Info Dinas Pendidikan — SDN Sukorame 1',
        ]));
    }
}