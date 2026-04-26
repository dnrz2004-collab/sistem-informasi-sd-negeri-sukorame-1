<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;

class GaleriController extends Controller
{
    private function baseData(): array
    {
        return ['sekolah' => Sekolah::first()];
    }

    public function foto()
    {
        return view('public.galeri.foto', array_merge($this->baseData(), [
            'pageTitle' => 'Galeri Foto — SDN Sukorame 1',
        ]));
    }

    public function video()
    {
        return view('public.galeri.video', array_merge($this->baseData(), [
            'pageTitle' => 'Galeri Video — SDN Sukorame 1',
        ]));
    }
}