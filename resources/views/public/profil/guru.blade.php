@extends('layouts.public')

@section('title', $pageTitle)

@section('content')

@include('public.partials.page-header', [
    'pageHeading'    => 'Profil Guru & Karyawan',
    'pageSubheading' => 'Tenaga pendidik dan kependidikan SD Negeri Sukorame 1',
    'breadcrumb'     => [
        ['label' => 'Profil', 'url' => '#'],
        ['label' => 'Profil Guru & Karyawan'],
    ],
])

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">

        @if(isset($guru) && $guru->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
            @foreach ($guru as $g)
            <div class="bg-white rounded-2xl p-5 border border-gray-100 text-center hover:shadow-md transition-shadow">
                <div class="w-20 h-20 rounded-full bg-gray-100 border-2 border-red-100 overflow-hidden mx-auto mb-3 flex items-center justify-center">
                    @if($g->user?->foto)
                        <img src="{{ asset('storage/' . $g->user->foto) }}" alt="{{ $g->user->name }}" class="w-full h-full object-cover">
                    @else
                        <i class="fa fa-user text-gray-300 text-3xl"></i>
                    @endif
                </div>
                <p class="font-bold text-gray-800 text-xs leading-snug">{{ $g->user?->name ?? '—' }}</p>
                <p class="text-gray-500 text-xs mt-1">{{ $g->mata_pelajaran ?? 'Guru' }}</p>
                @if($g->nip)
                <span class="inline-block mt-2 text-xs bg-red-50 text-red-700 px-2 py-0.5 rounded-full font-semibold">NIP: {{ $g->nip }}</span>
                @endif
            </div>
            @endforeach
        </div>
        @else
        {{-- Placeholder data jika belum ada guru di database --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
            @php
                $guruPlaceholder = [
                    ['nama' => 'Nama Kepala Sekolah', 'jabatan' => 'Kepala Sekolah'],
                    ['nama' => 'Nama Guru Kelas 1', 'jabatan' => 'Wali Kelas I'],
                    ['nama' => 'Nama Guru Kelas 2', 'jabatan' => 'Wali Kelas II'],
                    ['nama' => 'Nama Guru Kelas 3', 'jabatan' => 'Wali Kelas III'],
                    ['nama' => 'Nama Guru Kelas 4', 'jabatan' => 'Wali Kelas IV'],
                    ['nama' => 'Nama Guru Kelas 5', 'jabatan' => 'Wali Kelas V'],
                    ['nama' => 'Nama Guru Kelas 6', 'jabatan' => 'Wali Kelas VI'],
                    ['nama' => 'Guru Agama Islam', 'jabatan' => 'Guru PAI'],
                    ['nama' => 'Guru Olahraga', 'jabatan' => 'Guru PJOK'],
                    ['nama' => 'Staff TU', 'jabatan' => 'Tenaga Administrasi'],
                ];
            @endphp
            @foreach ($guruPlaceholder as $g)
            <div class="bg-white rounded-2xl p-5 border border-gray-100 text-center hover:shadow-md transition-shadow">
                <div class="w-20 h-20 rounded-full bg-gray-100 border-2 border-red-100 flex items-center justify-center mx-auto mb-3">
                    <i class="fa fa-user text-gray-300 text-3xl"></i>
                </div>
                <p class="font-bold text-gray-800 text-xs leading-snug">{{ $g['nama'] }}</p>
                <p class="text-gray-500 text-xs mt-1">{{ $g['jabatan'] }}</p>
            </div>
            @endforeach
        </div>
        <p class="text-center text-xs text-gray-400 mt-6 italic">* Data guru akan ditampilkan sesuai database sekolah.</p>
        @endif

    </div>
</section>

@endsection