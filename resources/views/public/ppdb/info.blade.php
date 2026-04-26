@extends('layouts.public')

@section('title', $pageTitle)

@section('content')

@include('public.partials.page-header', [
    'pageHeading'    => 'Informasi PPDB 2025/2026',
    'pageSubheading' => 'Penerimaan Peserta Didik Baru SD Negeri Sukorame 1 Kota Kediri',
    'breadcrumb'     => [
        ['label' => 'PPDB', 'url' => '#'],
        ['label' => 'Informasi PPDB'],
    ],
])

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 space-y-10">

        {{-- Banner PPDB --}}
        <div class="bg-gradient-to-r from-green-700 to-green-600 rounded-2xl p-8 text-white text-center">
            <i class="fa fa-graduation-cap text-5xl text-yellow-300 mb-4 block"></i>
            <h2 class="text-2xl font-black mb-2">PPDB Tahun Ajaran 2025/2026</h2>
            <p class="text-white/80 text-sm max-w-lg mx-auto">
                SD Negeri Sukorame 1 membuka pendaftaran peserta didik baru. Kuota terbatas, segera daftarkan putra-putri Anda!
            </p>
        </div>

        {{-- Info penting --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @php
                $info = [
                    ['icon'=>'fa-calendar-alt','label'=>'Jadwal Pendaftaran','value'=>'14 Juli – 25 Juli 2025','color'=>'blue'],
                    ['icon'=>'fa-users','label'=>'Kuota Penerimaan','value'=>'32 Siswa per Rombel','color'=>'green'],
                    ['icon'=>'fa-birthday-cake','label'=>'Usia Minimal','value'=>'6 tahun per 1 Juli 2025','color'=>'amber'],
                    ['icon'=>'fa-map-marker-alt','label'=>'Tempat Pendaftaran','value'=>'Kantor TU SDN Sukorame 1','color'=>'red'],
                ];
                $ic = ['blue'=>'bg-blue-50 text-blue-600','green'=>'bg-green-50 text-green-600',
                       'amber'=>'bg-amber-50 text-amber-600','red'=>'bg-red-50 text-red-600'];
            @endphp
            @foreach ($info as $inf)
            <div class="bg-gray-50 rounded-xl p-5 flex items-center gap-4 border border-gray-100">
                <div class="w-12 h-12 {{ $ic[$inf['color']] }} rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fa {{ $inf['icon'] }} text-lg"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-0.5">{{ $inf['label'] }}</p>
                    <p class="font-bold text-gray-800 text-sm">{{ $inf['value'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Navigasi ke halaman lain PPDB --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('ppdb.syarat') }}" class="hover-lift flex items-center gap-3 bg-white border border-gray-100 rounded-xl p-4 hover:border-green-200 hover:bg-green-50 transition-colors">
                <i class="fa fa-list-check text-green-600 text-xl w-8 text-center"></i>
                <div>
                    <p class="font-bold text-gray-800 text-sm">Syarat Pendaftaran</p>
                    <p class="text-xs text-gray-500">Dokumen yang diperlukan</p>
                </div>
                <i class="fa fa-chevron-right text-xs text-gray-400 ml-auto"></i>
            </a>
            <a href="{{ route('ppdb.jadwal') }}" class="hover-lift flex items-center gap-3 bg-white border border-gray-100 rounded-xl p-4 hover:border-blue-200 hover:bg-blue-50 transition-colors">
                <i class="fa fa-calendar text-blue-600 text-xl w-8 text-center"></i>
                <div>
                    <p class="font-bold text-gray-800 text-sm">Jadwal PPDB</p>
                    <p class="text-xs text-gray-500">Timeline pendaftaran</p>
                </div>
                <i class="fa fa-chevron-right text-xs text-gray-400 ml-auto"></i>
            </a>
            <a href="{{ route('ppdb.alur') }}" class="hover-lift flex items-center gap-3 bg-white border border-gray-100 rounded-xl p-4 hover:border-amber-200 hover:bg-amber-50 transition-colors">
                <i class="fa fa-route text-amber-600 text-xl w-8 text-center"></i>
                <div>
                    <p class="font-bold text-gray-800 text-sm">Alur Pendaftaran</p>
                    <p class="text-xs text-gray-500">Langkah demi langkah</p>
                </div>
                <i class="fa fa-chevron-right text-xs text-gray-400 ml-auto"></i>
            </a>
        </div>

    </div>
</section>

@endsection