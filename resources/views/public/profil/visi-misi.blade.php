@extends('layouts.public')

@section('title', $pageTitle)

@section('content')

@php
    $breadcrumb = [
        ['label' => 'Profil', 'url' => '#'],
        ['label' => 'Visi & Misi'],
    ];
    $pageHeading = 'Visi & Misi';
    $pageSubheading = 'Arah dan tujuan SD Negeri Sukorame 1 Kota Kediri';
@endphp

@include('public.partials.page-header')

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 space-y-12">

        {{-- VISI --}}
        <div class="bg-red-50 border border-red-100 rounded-2xl p-8 text-center">
            <div class="w-16 h-16 bg-red-700 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <i class="fa fa-eye text-white text-2xl"></i>
            </div>
            <h2 class="text-xl font-black text-red-700 mb-4">Visi Sekolah</h2>
            <p class="text-gray-700 font-semibold text-base md:text-lg leading-relaxed max-w-2xl mx-auto italic">
                "Terwujudnya peserta didik yang beriman, bertaqwa, berakhlak mulia, cerdas, terampil, berbudaya, dan berwawasan lingkungan."
            </p>
        </div>

        {{-- MISI --}}
        <div>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-red-700 rounded-xl flex items-center justify-center">
                    <i class="fa fa-bullseye text-white text-lg"></i>
                </div>
                <h2 class="text-xl font-black text-gray-800">Misi Sekolah</h2>
            </div>
            <div class="space-y-3">
                @php
                    $misi = [
                        'Menyelenggarakan pembelajaran yang aktif, kreatif, efektif, dan menyenangkan (PAKEM).',
                        'Menumbuhkan semangat keunggulan secara intensif kepada seluruh warga sekolah.',
                        'Mendorong dan membantu setiap siswa untuk mengenali potensi dirinya agar berkembang secara optimal.',
                        'Menerapkan manajemen partisipatif dengan melibatkan seluruh warga sekolah dan kelompok kepentingan.',
                        'Membangun dan mengembangkan karakter islami yang tercermin dalam perilaku sehari-hari.',
                        'Memanfaatkan teknologi informasi dan komunikasi dalam proses pembelajaran.',
                        'Menciptakan lingkungan sekolah yang bersih, sehat, nyaman, dan ramah anak.',
                    ];
                @endphp
                @foreach ($misi as $i => $m)
                <div class="flex items-start gap-4 p-4 bg-gray-50 hover:bg-red-50 rounded-xl border border-gray-100 hover:border-red-100 transition-colors">
                    <div class="w-8 h-8 bg-red-700 text-white rounded-lg flex items-center justify-center font-black text-sm flex-shrink-0">{{ $i + 1 }}</div>
                    <p class="text-gray-700 text-sm leading-relaxed pt-1">{{ $m }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- TUJUAN --}}
        <div>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center">
                    <i class="fa fa-star text-white text-lg"></i>
                </div>
                <h2 class="text-xl font-black text-gray-800">Tujuan Sekolah</h2>
            </div>
            <p class="text-gray-600 text-sm leading-relaxed bg-amber-50 border border-amber-100 rounded-2xl p-6">
                Menghasilkan lulusan yang memiliki kompetensi akademik dan non-akademik, beriman dan bertaqwa kepada Tuhan Yang Maha Esa,
                berakhlak mulia, sehat jasmani dan rohani, serta memiliki kecakapan hidup sebagai bekal untuk melanjutkan pendidikan ke jenjang
                yang lebih tinggi dan menjadi anggota masyarakat yang bertanggung jawab.
            </p>
        </div>

    </div>
</section>

@endsection