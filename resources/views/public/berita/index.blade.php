@extends('layouts.public')

@section('title', $pageTitle ?? 'Berita Sekolah')

@section('content')

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Header --}}
        <div class="mb-10 text-center">
            <h1 class="text-3xl md:text-4xl font-black text-gray-900 mb-2">
                Berita & Pengumuman
            </h1>
            <p class="text-gray-500 text-sm">
                Informasi terbaru dari sekolah
            </p>
        </div>

        {{-- Grid berita --}}
        @if ($berita->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($berita as $item)
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition">

                {{-- Thumbnail --}}
                <div class="h-48 bg-gradient-to-br from-blue-100 to-sky-200 flex items-center justify-center">
                    <i class="fa fa-newspaper text-5xl text-blue-300 opacity-70"></i>
                </div>

                {{-- Content --}}
                <div class="p-5">

                    {{-- Tanggal --}}
                    <p class="text-xs text-gray-400 mb-2">
                        <i class="fa fa-calendar-alt mr-1"></i>
                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMM Y') }}
                    </p>

                    {{-- Judul --}}
                    <h3 class="font-bold text-gray-900 text-sm mb-2 line-clamp-2">
                        {{ $item->judul }}
                    </h3>

                    {{-- Ringkasan --}}
                    <p class="text-gray-500 text-xs mb-4 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->isi ?? $item->konten), 100) }}
                    </p>

                    {{-- Button --}}
                    <a href="{{ route('berita.show', $item->id) }}"
                       class="inline-flex items-center gap-1 text-blue-700 text-xs font-bold hover:gap-2 transition-all">
                        Baca Selengkapnya
                        <i class="fa fa-arrow-right text-[10px]"></i>
                    </a>

                </div>
            </div>
            @endforeach

        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $berita->links() }}
        </div>

        @else
        <div class="text-center py-20">
            <p class="text-gray-400">Belum ada berita.</p>
        </div>
        @endif

    </div>
</section>

@endsection