<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;

class LayananController extends Controller
{
    private function baseData(): array
    {
        return ['sekolah' => Sekolah::first()];
    }

    public function mutasi()
    {
        return view('public.layanan.mutasi', array_merge($this->baseData(), [
            'pageTitle' => 'Mutasi Siswa — SDN Sukorame 1',
        ]));
    }

    public function surat()
    {
        return view('public.layanan.surat', array_merge($this->baseData(), [
            'pageTitle' => 'Surat Keterangan Siswa — SDN Sukorame 1',
        ]));
    }

    public function izin()
    {
        return view('public.layanan.izin', array_merge($this->baseData(), [
            'pageTitle' => 'Izin Penelitian / PKL — SDN Sukorame 1',
        ]));
    }

    public function nisn()
    {
        return view('public.layanan.nisn', array_merge($this->baseData(), [
            'pageTitle' => 'Cek / Cetak NISN — SDN Sukorame 1',
        ]));
    }

    public function pip()
    {
        return view('public.layanan.pip', array_merge($this->baseData(), [
            'pageTitle' => 'Cek Beasiswa PIP — SDN Sukorame 1',
        ]));
    }

    public function unduhan()
    {
        return view('public.layanan.unduhan', array_merge($this->baseData(), [
            'pageTitle' => 'Unduhan Dokumen — SDN Sukorame 1',
        ]));
    }

    public function alumni()
    {
        return view('public.layanan.alumni', array_merge($this->baseData(), [
            'pageTitle' => 'Penjaringan Alumni — SDN Sukorame 1',
        ]));
    }
}