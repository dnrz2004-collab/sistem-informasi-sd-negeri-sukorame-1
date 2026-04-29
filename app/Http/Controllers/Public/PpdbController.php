<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;

class PpdbController extends Controller
{
    private function baseData(): array
    {
        return ['sekolah' => Sekolah::first()];
    }

    public function info()
    {
        return view('public.ppdb.info', array_merge($this->baseData(), [
            'pageTitle' => 'Informasi PPDB 2025/2026 — SDN Sukorame 1',
        ]));
    }

    public function syarat()
    {
        return view('public.ppdb.syarat', array_merge($this->baseData(), [
            'pageTitle' => 'Syarat Pendaftaran PPDB — SDN Sukorame 1',
        ]));
    }

    public function jadwal()
    {
        return view('public.ppdb.jadwal', array_merge($this->baseData(), [
            'pageTitle' => 'Jadwal PPDB — SDN Sukorame 1',
        ]));
    }

    public function alur()
    {
        return view('public.ppdb.alur', array_merge($this->baseData(), [
            'pageTitle' => 'Alur Pendaftaran PPDB — SDN Sukorame 1',
        ]));
    }
}