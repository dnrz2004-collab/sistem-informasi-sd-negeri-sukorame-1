<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;

class AkademikController extends Controller
{
    private function baseData(): array
    {
        return ['sekolah' => Sekolah::first()];
    }

    public function kurikulum()
    {
        return view('public.akademik.kurikulum', array_merge($this->baseData(), [
            'pageTitle' => 'Kurikulum — SDN Sukorame 1',
        ]));
    }

    public function kalender()
    {
        return view('public.akademik.kalender', array_merge($this->baseData(), [
            'pageTitle' => 'Kalender Pendidikan — SDN Sukorame 1',
        ]));
    }

    public function karakter()
    {
        return view('public.akademik.karakter', array_merge($this->baseData(), [
            'pageTitle' => 'Pendidikan Karakter — SDN Sukorame 1',
        ]));
    }

    public function ekstrakurikuler()
    {
        return view('public.akademik.ekstrakurikuler', array_merge($this->baseData(), [
            'pageTitle' => 'Ekstrakulikuler — SDN Sukorame 1',
        ]));
    }

    public function literasi()
    {
        return view('public.akademik.literasi', array_merge($this->baseData(), [
            'pageTitle' => 'Gerakan Literasi — SDN Sukorame 1',
        ]));
    }
}