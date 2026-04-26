@extends('layouts.public')

@section('title', $pageTitle ?? 'Detail Berita')

@section('content')

<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">

        {{-- Tombol kembali --}}
        <a href="{{ route('berita.index') }}"
           class="inline-flex items-center gap-2 text-blue-700 font-semibold text-sm mb-6 hover:underline">
            <i class="fa fa-arrow-left"></i> Kembali ke Berita
        </a>

        {{-- Card utama --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- Thumbnail --}}
            <div class="h-64 bg-gradient-to-br from-blue-100 to-sky-200 flex items-center justify-center">
                <i class="fa fa-newspaper text-6xl text-blue-300 opacity-70"></i>
            </div>

            {{-- Konten --}}
            <div class="p-8">

                {{-- Judul --}}
                <h1 class="text-2xl md:text-3xl font-black text-gray-900 mb-4 leading-tight">
                    {{ $item->judul }}
                </h1>

                {{-- Meta --}}
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-400 mb-6">
                    <span>
                        <i class="fa fa-calendar-alt mr-1"></i>
                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM Y') }}
                    </span>

                    <span>
                        <i class="fa fa-tag mr-1"></i>
                        {{ ucfirst($item->kategori ?? 'Pengumuman') }}
                    </span>
                </div>

                {{-- Isi --}}
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! $item->isi ?? $item->konten !!}
                </div>

            </div>
        </div>

    </div>
</section>

@endsection