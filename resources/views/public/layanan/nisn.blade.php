@extends('layouts.public')

@section('title', $pageTitle)

@section('content')

@include('public.partials.page-header', [
    'pageHeading'    => 'Cek / Cetak NISN',
    'pageSubheading' => 'Verifikasi Nomor Induk Siswa Nasional',
    'breadcrumb'     => [
        ['label' => 'Layanan', 'url' => '#'],
        ['label' => 'Cek / Cetak NISN'],
    ],
])

<section class="py-16 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4">

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa fa-id-card text-green-600 text-2xl"></i>
                </div>
                <h2 class="font-black text-gray-800 text-lg">Cek NISN Siswa</h2>
                <p class="text-gray-500 text-sm mt-2">Masukkan nama lengkap atau NISN untuk mencari data</p>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6 text-sm text-blue-700 flex gap-3">
                <i class="fa fa-info-circle mt-0.5 flex-shrink-0"></i>
                <span>Untuk pencarian resmi, kunjungi <a href="https://nisn.data.kemdikbud.go.id" target="_blank" class="underline font-semibold">nisn.data.kemdikbud.go.id</a> atau hubungi operator sekolah.</span>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Lengkap Siswa</label>
                    <input type="text" placeholder="Masukkan nama lengkap..."
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-400">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Ibu Kandung</label>
                    <input type="text" placeholder="Masukkan nama ibu kandung..."
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-400">
                </div>
                <button class="w-full bg-red-700 hover:bg-red-800 text-white font-bold py-3 rounded-xl transition-colors text-sm flex items-center justify-center gap-2">
                    <i class="fa fa-search"></i> Cari NISN
                </button>
            </div>

            <div class="border-t border-gray-100 mt-6 pt-5">
                <p class="text-xs text-gray-500 text-center">Butuh bantuan? Hubungi operator sekolah di <strong>(0354) 123456</strong></p>
            </div>
        </div>

    </div>
</section>

@endsection