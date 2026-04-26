@extends('layouts.public')

@section('title', $pageTitle)

@section('content')

@include('public.partials.page-header', [
    'pageHeading'    => 'Sejarah Sekolah',
    'pageSubheading' => 'Perjalanan panjang SD Negeri Sukorame 1 Kota Kediri',
    'breadcrumb'     => [
        ['label' => 'Profil', 'url' => '#'],
        ['label' => 'Sejarah Sekolah'],
    ],
])

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-gray max-w-none text-sm leading-relaxed space-y-5 text-gray-700">
            <p>
                SD Negeri Sukorame 1 berdiri sejak tahun <strong>1965</strong> dan merupakan salah satu sekolah dasar negeri
                tertua dan paling diminati di Kota Kediri. Sekolah ini berlokasi di Kelurahan Sukorame, Kecamatan Mojoroto,
                dan telah menghasilkan ribuan alumni yang kini berkontribusi di berbagai bidang.
            </p>
            <p>
                Selama puluhan tahun berdiri, SDN Sukorame 1 terus bertransformasi mengikuti perkembangan dunia pendidikan.
                Dari metode pembelajaran konvensional hingga adopsi teknologi modern melalui platform <strong>SIMAS</strong>
                (Sistem Informasi Sekolah), sekolah ini selalu berkomitmen memberikan layanan pendidikan berkualitas.
            </p>

            {{-- Timeline --}}
            <div class="mt-8 space-y-4">
                @php
                    $timeline = [
                        ['year' => '1965', 'desc' => 'Pendirian SDN Sukorame 1 oleh Pemerintah Kota Kediri'],
                        ['year' => '1985', 'desc' => 'Renovasi gedung sekolah dan penambahan ruang kelas'],
                        ['year' => '2000', 'desc' => 'Meraih akreditasi A pertama kali dari BAN-SM'],
                        ['year' => '2010', 'desc' => 'Pengenalan program komputer dan teknologi informasi'],
                        ['year' => '2018', 'desc' => 'Implementasi Kurikulum 2013 secara penuh'],
                        ['year' => '2022', 'desc' => 'Peluncuran SIMAS — Sistem Informasi & E-Learning'],
                        ['year' => '2024', 'desc' => 'Penerapan Kurikulum Merdeka dan peningkatan fasilitas'],
                    ];
                @endphp
                @foreach ($timeline as $t)
                <div class="flex gap-4 items-start">
                    <div class="flex-shrink-0 w-16 bg-red-700 text-white text-center py-2 rounded-xl font-black text-sm">{{ $t['year'] }}</div>
                    <div class="flex-1 pt-2 border-l-2 border-red-100 pl-4">
                        <p class="text-gray-700 text-sm">{{ $t['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection