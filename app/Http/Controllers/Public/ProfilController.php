<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Models\Guru;

class ProfilController extends Controller
{
    private function baseData(): array
    {
        return [
            'sekolah' => Sekolah::first(),
        ];
    }

    public function visiMisi()
    {
        return view('public.profil.visi-misi', array_merge($this->baseData(), [
            'pageTitle' => 'Visi & Misi — SDN Sukorame 1',
        ]));
    }

    public function sejarah()
    {
        return view('public.profil.sejarah', array_merge($this->baseData(), [
            'pageTitle' => 'Sejarah Sekolah — SDN Sukorame 1',
        ]));
    }

    public function struktur()
    {
        return view('public.profil.struktur', array_merge($this->baseData(), [
            'pageTitle' => 'Struktur Organisasi — SDN Sukorame 1',
        ]));
    }

    public function komite()
    {
        return view('public.profil.komite', array_merge($this->baseData(), [
            'pageTitle' => 'Komite Sekolah — SDN Sukorame 1',
        ]));
    }

    public function guru()
    {
        // Sesuaikan model/query dengan struktur database Anda
        $guru = Guru::orderBy('nama')->get();

        return view('public.profil.guru', array_merge($this->baseData(), [
            'pageTitle' => 'Profil Guru & Karyawan — SDN Sukorame 1',
            'guru'      => $guru,
        ]));
    }

    public function sarana()
    {
        return view('public.profil.sarana', array_merge($this->baseData(), [
            'pageTitle' => 'Sarana & Prasarana — SDN Sukorame 1',
        ]));
    }

    public function akreditasi()
    {
        return view('public.profil.akreditasi', array_merge($this->baseData(), [
            'pageTitle' => 'Akreditasi Sekolah — SDN Sukorame 1',
        ]));
    }

    public function prestasi()
    {
        return view('public.profil.prestasi', array_merge($this->baseData(), [
            'pageTitle' => 'Prestasi Sekolah — SDN Sukorame 1',
        ]));
    }
}