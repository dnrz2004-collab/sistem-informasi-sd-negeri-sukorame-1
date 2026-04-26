<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Models\Pengumuman; // Sesuaikan nama model

class BeritaController extends Controller
{
    private function baseData(): array
    {
        return ['sekolah' => Sekolah::first()];
    }

    public function index()
    {
        // Sesuaikan dengan model & kolom yang ada
        $berita = Pengumuman::latest()->paginate(9);

        return view('public.berita.index', array_merge($this->baseData(), [
            'pageTitle' => 'Berita Sekolah — SDN Sukorame 1',
            'berita'    => $berita,
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