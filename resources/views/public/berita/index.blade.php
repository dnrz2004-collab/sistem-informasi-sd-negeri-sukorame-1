@extends('layouts.public')

@section('title', $pageTitle ?? 'Berita Sekolah — SDN Sukorame 1')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .font-display { font-family: 'Playfair Display', serif; }

    .page-hero {
        background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 45%, #1d4ed8 75%, #3b82f6 100%);
        position: relative; overflow: hidden;
    }
    .hero-pattern {
        position: absolute; inset: 0; opacity: .05;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 28px 28px;
    }
    .sec-label {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        color: #1d4ed8; background: #eff6ff; border: 1px solid #bfdbfe;
        padding: 4px 14px; border-radius: 999px; margin-bottom: 12px;
    }
    .sec-label::before { content: ''; width: 6px; height: 6px; background: #1d4ed8; border-radius: 50%; }
    .section-divider { height: 1px; background: linear-gradient(90deg, transparent, #e5e7eb 30%, #e5e7eb 70%, transparent); }

    /* ── ARTIKEL CARD UTAMA (featured) ── */
    .article-featured {
        background: white; border-radius: 24px;
        border: 1.5px solid #e0e7ff; overflow: hidden;
        transition: all .28s;
        display: grid; grid-template-columns: 1fr 1fr;
    }
    @media (max-width: 768px) { .article-featured { grid-template-columns: 1fr; } }
    .article-featured:hover {
        border-color: #93c5fd;
        box-shadow: 0 16px 48px rgba(29,78,216,.14);
        transform: translateY(-4px);
    }
    .article-featured-img {
        min-height: 280px; background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 60%, #1d4ed8 100%);
        display: flex; align-items: center; justify-content: center;
        position: relative; overflow: hidden;
    }
    .article-featured-img::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, transparent 50%, rgba(29,78,216,.2));
    }
    .article-featured-body { padding: 32px 28px; display: flex; flex-direction: column; justify-content: center; }

    /* ── ARTIKEL CARD BIASA ── */
    .article-card {
        background: white; border-radius: 20px;
        border: 1.5px solid #e0e7ff; overflow: hidden;
        transition: all .25s; display: flex; flex-direction: column;
    }
    .article-card:hover {
        border-color: #93c5fd;
        box-shadow: 0 12px 32px rgba(29,78,216,.12);
        transform: translateY(-3px);
    }
    .article-card-img {
        height: 180px;
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        display: flex; align-items: center; justify-content: center;
        position: relative; overflow: hidden;
    }
    .article-card-img img { width: 100%; height: 100%; object-fit: cover; }
    .article-card-body { padding: 20px; flex: 1; display: flex; flex-direction: column; }

    /* ── ARTIKEL MINI (sidebar / list) ── */
    .article-mini {
        display: flex; gap: 14px; align-items: flex-start;
        padding: 14px; border-radius: 16px; border: 1px solid #f1f5f9;
        background: white; transition: all .22s;
    }
    .article-mini:hover { border-color: #bfdbfe; background: #f8fbff; }
    .article-mini-thumb {
        width: 72px; height: 72px; border-radius: 12px; flex-shrink: 0;
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        display: flex; align-items: center; justify-content: center; overflow: hidden;
    }
    .article-mini-thumb img { width: 100%; height: 100%; object-fit: cover; }

    /* ── KATEGORI BADGE ── */
    .cat-badge {
        display: inline-flex; align-items: center; gap: 4px;
        font-size: 10px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
        padding: 3px 10px; border-radius: 999px;
    }
    .cat-berita      { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .cat-prestasi    { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
    .cat-kegiatan    { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .cat-pengumuman  { background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }

    /* ── SEARCH BOX ── */
    .search-box {
        background: white; border-radius: 16px;
        border: 1.5px solid #e0e7ff; padding: 4px 4px 4px 16px;
        display: flex; align-items: center; gap: 8px;
        transition: border-color .2s;
    }
    .search-box:focus-within { border-color: #93c5fd; box-shadow: 0 0 0 4px rgba(147,197,253,.2); }
    .search-box input { flex: 1; border: none; outline: none; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; background: transparent; }
    .search-box button {
        background: #1d4ed8; color: white; border: none; border-radius: 12px;
        padding: 9px 16px; font-size: 12px; font-weight: 700; cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif; transition: background .2s;
    }
    .search-box button:hover { background: #1e40af; }

    /* Pagination override */
    .pagination-wrap nav { display: flex; justify-content: center; }
    .pagination-wrap nav span, .pagination-wrap nav a {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 36px; height: 36px; padding: 0 10px;
        border-radius: 10px; font-size: 13px; font-weight: 600;
        border: 1.5px solid #e0e7ff; margin: 0 2px;
        color: #374151; background: white; text-decoration: none; transition: all .18s;
    }
    .pagination-wrap nav a:hover { border-color: #93c5fd; background: #eff6ff; color: #1d4ed8; }
    .pagination-wrap [aria-current="page"] span { background: #1d4ed8; color: white; border-color: #1d4ed8; }

    .fade-up { opacity: 0; transform: translateY(18px); transition: opacity .45s ease, transform .45s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
</style>
@endpush

@section('content')

{{-- HERO --}}
<div class="page-hero py-20">
    <div class="hero-pattern"></div>
    <div style="position:absolute;width:400px;height:400px;right:-100px;top:-100px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,.06) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;width:240px;height:240px;left:6%;bottom:-70px;border-radius:50%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);pointer-events:none;"></div>

    <div class="max-w-5xl mx-auto px-6 relative z-10">
        <nav class="flex items-center gap-2 text-white/50 text-xs mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Berita Sekolah</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-end gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Informasi Sekolah
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Berita &amp;<br>
                    <span style="color:#FDE68A;">Artikel Sekolah</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-lg" style="font-size:1rem;">
                    Ikuti perkembangan terkini, kisah inspiratif, dan pencapaian
                    SD Negeri Sukorame 1 Kota Kediri.
                </p>
            </div>
            <div class="flex gap-3 flex-shrink-0">
                @php $hs = [
                    ['val'=> $totalBerita  ?? $berita->total(), 'lbl'=>'Total Artikel', 'ico'=>'fa-newspaper'],
                    ['val'=> $totalBulanIni ?? '—',            'lbl'=>'Bulan Ini',     'ico'=>'fa-calendar-check'],
                ]; @endphp
                @foreach ($hs as $h)
                <div class="bg-white/10 border border-white/20 rounded-2xl p-4 text-center w-24 backdrop-blur-sm">
                    <i class="fa {{ $h['ico'] }} text-amber-300 text-base mb-2 block"></i>
                    <p class="text-white font-black text-xl leading-none">{{ $h['val'] }}</p>
                    <p class="text-white/55 text-[10px] mt-1">{{ $h['lbl'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<main class="bg-gray-50">
<section class="py-20">
    <div class="max-w-5xl mx-auto px-6">

        {{-- Search & Filter --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-12 fade-up">
            <form action="{{ route('berita.index') }}" method="GET" class="flex-1">
                <div class="search-box">
                    <i class="fa fa-search text-gray-400 text-sm"></i>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari artikel, berita sekolah…">
                    <button type="submit">Cari</button>
                </div>
            </form>
            <div class="flex gap-2 flex-wrap">
                @php $cats = [
                    [null,          'Semua',       'cat-berita'],
                    ['berita',      'Berita',      'cat-berita'],
                    ['prestasi',    'Prestasi',    'cat-prestasi'],
                    ['kegiatan',    'Kegiatan',    'cat-kegiatan'],
                ]; @endphp
                @foreach ($cats as [$val, $lbl, $cls])
                <a href="{{ route('berita.index', array_merge(request()->query(), ['kategori' => $val])) }}"
                   class="cat-badge {{ $cls }} {{ request('kategori') == $val ? 'ring-2 ring-offset-1 ring-current' : '' }}">
                    {{ $lbl }}
                </a>
                @endforeach
            </div>
        </div>

        @if ($berita->count() > 0)

        {{-- Featured Article (item pertama) --}}
        @php $featured = $berita->first(); @endphp
        <div class="mb-10 fade-up">
            <a href="{{ route('berita.show', $featured->slug ?? $featured->id) }}" class="article-featured group block">
                <div class="article-featured-img">
                    @if(!empty($featured->thumbnail))
                        <img src="{{ asset('storage/'.$featured->thumbnail) }}" alt="{{ $featured->judul }}" class="w-full h-full object-cover absolute inset-0">
                    @else
                        <i class="fa fa-newspaper text-white/20" style="font-size: 5rem;"></i>
                    @endif
                    <div class="absolute inset-0" style="background: linear-gradient(to right, transparent, rgba(12,20,69,.4));"></div>
                </div>
                <div class="article-featured-body">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="cat-badge cat-berita">
                            <i class="fa fa-fire"></i> Terbaru
                        </span>
                        <span class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($featured->created_at)->locale('id')->isoFormat('D MMM Y') }}
                        </span>
                    </div>
                    <h2 class="font-display text-gray-900 font-black text-2xl leading-tight mb-3 group-hover:text-blue-700 transition-colors">
                        {{ $featured->judul }}
                    </h2>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($featured->isi ?? $featured->konten ?? ''), 200) }}
                    </p>
                    <div class="flex items-center gap-3">
                        @if(!empty($featured->penulis))
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fa fa-user text-blue-600 text-[10px]"></i>
                            </div>
                            {{ $featured->penulis }}
                        </div>
                        @endif
                        <span class="inline-flex items-center gap-1.5 text-blue-700 text-xs font-bold ml-auto group-hover:gap-2.5 transition-all">
                            Baca Artikel <i class="fa fa-arrow-right text-[10px]"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        {{-- Grid Artikel --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach ($berita->skip(1) as $item)
            <a href="{{ route('berita.show', $item->slug ?? $item->id) }}" class="article-card group fade-up">
                <div class="article-card-img">
                    @if(!empty($item->thumbnail))
                        <img src="{{ asset('storage/'.$item->thumbnail) }}" alt="{{ $item->judul }}">
                    @else
                        <i class="fa fa-newspaper text-white/25" style="font-size: 2.5rem;"></i>
                    @endif
                </div>
                <div class="article-card-body">
                    <div class="flex items-center gap-2 mb-3">
                        @php
                            $kat = $item->kategori ?? 'berita';
                            $katCls = match(strtolower($kat)) {
                                'prestasi'   => 'cat-prestasi',
                                'kegiatan'   => 'cat-kegiatan',
                                'pengumuman' => 'cat-pengumuman',
                                default      => 'cat-berita',
                            };
                        @endphp
                        <span class="cat-badge {{ $katCls }}">{{ ucfirst($kat) }}</span>
                        <span class="text-[10px] text-gray-400 ml-auto">
                            {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMM Y') }}
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm mb-2 line-clamp-2 group-hover:text-blue-700 transition-colors leading-snug">
                        {{ $item->judul }}
                    </h3>
                    <p class="text-gray-400 text-xs leading-relaxed mb-4 line-clamp-3 flex-1">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->isi ?? $item->konten ?? ''), 120) }}
                    </p>
                    <div class="flex items-center justify-between mt-auto">
                        @if(!empty($item->penulis))
                        <span class="text-[10px] text-gray-400">
                            <i class="fa fa-user mr-1"></i>{{ $item->penulis }}
                        </span>
                        @endif
                        <span class="inline-flex items-center gap-1 text-blue-600 text-[11px] font-bold ml-auto group-hover:gap-2 transition-all">
                            Baca <i class="fa fa-arrow-right text-[9px]"></i>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrap fade-up">
            {{ $berita->links() }}
        </div>

        @else
        <div class="text-center py-24 fade-up">
            <div class="w-20 h-20 bg-blue-50 rounded-3xl flex items-center justify-center mx-auto mb-4">
                <i class="fa fa-newspaper text-blue-300 text-3xl"></i>
            </div>
            <p class="text-gray-500 font-semibold text-sm mb-1">Belum ada artikel</p>
            <p class="text-gray-400 text-xs">Artikel akan segera ditampilkan di sini.</p>
        </div>
        @endif

    </div>
</section>
</main>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const obs = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 80);
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
});
</script>
@endpush