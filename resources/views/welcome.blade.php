@extends('layouts.public')

@section('title', $pageTitle ?? 'SD Negeri Sukorame 1 Kediri')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --red: #1D4ED8;
        --red-dark: #1e3a8a;
        --red-light: #EFF6FF;
        --gold: #D97706;
        --gold-light: #FEF3C7;
    }

    .font-display { font-family: 'Playfair Display', serif; }

    /* ── HERO ── */
    .hero-wrap {
        position: relative;
        min-height: 580px;
        background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 40%, #1d4ed8 70%, #3b82f6 100%);
        overflow: hidden;
        display: flex;
        align-items: center;
    }
    .hero-pattern {
        position: absolute; inset: 0; opacity: .06;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 32px 32px;
    }
    .hero-circle-1 {
        position: absolute; right: -80px; top: -80px;
        width: 500px; height: 500px; border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,.08) 0%, transparent 70%);
        pointer-events: none;
    }
    .hero-circle-2 {
        position: absolute; left: 30%; bottom: -120px;
        width: 320px; height: 320px; border-radius: 50%;
        background: radial-gradient(circle, rgba(217,119,6,.15) 0%, transparent 70%);
        pointer-events: none;
    }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.25);
        color: #FDE68A; font-size: 11px; font-weight: 700;
        padding: 6px 14px; border-radius: 999px; letter-spacing: .06em;
        text-transform: uppercase; margin-bottom: 20px;
    }
    .hero-badge span { width: 6px; height: 6px; background: #FDE68A; border-radius: 50%; animation: pulse-dot 2s infinite; }
    @keyframes pulse-dot { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(.7)} }

    /* Slides */
    .slides-track { display: flex; transition: transform .65s cubic-bezier(.77,0,.175,1); }
    .slide-item { min-width: 100%; }
    .slider-btn {
        position: absolute; top: 50%; transform: translateY(-50%); z-index: 10;
        width: 44px; height: 44px; border-radius: 50%;
        border: 2px solid rgba(255,255,255,.3);
        background: rgba(255,255,255,.1); backdrop-filter: blur(6px);
        color: white; display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all .2s;
    }
    .slider-btn:hover { background: rgba(255,255,255,.25); border-color: rgba(255,255,255,.6); }
    .slider-dots { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 10; }
    .sdot { width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,.35); cursor: pointer; transition: all .25s; border: none; }
    .sdot.active { background: #fff; width: 24px; border-radius: 4px; }

    /* ── STATISTIK ── */
    .stat-card {
        position: relative; overflow: hidden;
        background: white;
        transition: transform .25s, box-shadow .25s;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 16px 32px rgba(0,0,0,.08); }
    .stat-card::before {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
    }

    /* ── KEUNGGULAN ── */
    .keung-card {
        background: white; border-radius: 20px; padding: 28px 20px; text-align: center;
        border: 1px solid #f1f5f9;
        transition: all .3s;
        position: relative; overflow: hidden;
    }
    .keung-card::after {
        content: ''; position: absolute; inset: 0; opacity: 0;
        background: linear-gradient(135deg, rgba(29,78,216,.03) 0%, rgba(29,78,216,.06) 100%);
        transition: opacity .3s;
    }
    .keung-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(29,78,216,.1); border-color: #bfdbfe; }
    .keung-card:hover::after { opacity: 1; }
    .keung-icon-wrap {
        width: 64px; height: 64px; border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px; font-size: 24px;
        transition: transform .3s;
    }
    .keung-card:hover .keung-icon-wrap { transform: scale(1.1) rotate(-5deg); }

    /* ── SAMBUTAN ── */
    .kepsek-photo {
        width: 200px; height: 240px; border-radius: 24px;
        background: linear-gradient(145deg, #f8fafc, #f1f5f9);
        border: 4px solid #bfdbfe;
        overflow: hidden; display: flex; align-items: center; justify-content: center;
        position: relative; box-shadow: 0 20px 48px rgba(29,78,216,.12);
    }
    .kepsek-photo::before {
        content: ''; position: absolute;
        top: -20px; right: -20px; width: 80px; height: 80px;
        background: #dbeafe; border-radius: 50%; opacity: .5;
    }
    .quote-mark {
        font-family: 'Playfair Display', serif;
        font-size: 96px; line-height: 1; color: #dbeafe;
        position: absolute; top: -16px; left: 20px; pointer-events: none;
    }

    /* ── INFO BAND ── */
    .info-band {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);
        position: relative; overflow: hidden;
    }
    .info-band::before {
        content: ''; position: absolute; inset: 0; opacity: .04;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 24px 24px;
    }
    .info-item {
        background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.15);
        border-radius: 16px; padding: 18px; transition: background .2s;
    }
    .info-item:hover { background: rgba(255,255,255,.15); }

    /* ── BERITA ── */
    .news-card {
        background: white; border-radius: 20px; overflow: hidden;
        border: 1px solid #f1f5f9;
        transition: all .3s;
    }
    .news-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,.09); border-color: #bfdbfe; }
    .news-thumb {
        height: 200px; display: flex; align-items: center; justify-content: center;
        position: relative; overflow: hidden;
    }
    .news-thumb::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,.15) 0%, transparent 60%);
    }
    .news-kategori {
        display: inline-flex; align-items: center; gap: 4px;
        font-size: 10px; font-weight: 700; padding: 3px 10px;
        border-radius: 999px; letter-spacing: .05em; text-transform: uppercase;
    }

    /* ── AGENDA ── */
    .agenda-item {
        display: flex; align-items: flex-start; gap: 16px; padding: 16px;
        border-radius: 16px; border: 1px solid #f1f5f9; background: white;
        transition: all .25s; cursor: default;
    }
    .agenda-item:hover { background: #eff6ff; border-color: #bfdbfe; transform: translateX(4px); }
    .agenda-date {
        flex-shrink: 0; width: 56px; text-align: center;
        border-radius: 14px; padding: 10px 4px;
    }

    /* ── LOGIN CARD ── */
    .login-card {
        background: linear-gradient(145deg, #1e3a8a 0%, #1d4ed8 100%);
        border-radius: 24px; padding: 28px;
        box-shadow: 0 24px 56px rgba(30,58,138,.35);
        position: sticky; top: 88px;
    }
    .role-btn {
        display: flex; align-items: center; gap: 12px;
        background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
        border-radius: 14px; padding: 12px 16px;
        transition: all .2s; text-decoration: none;
    }
    .role-btn:hover { background: rgba(255,255,255,.22); border-color: rgba(255,255,255,.4); transform: translateX(3px); }

    /* ── GALERI ── */
    .gallery-item {
        aspect-ratio: 1; border-radius: 18px; overflow: hidden;
        position: relative; cursor: pointer;
        transition: transform .3s, box-shadow .3s;
    }
    .gallery-item:hover { transform: scale(1.02); box-shadow: 0 16px 40px rgba(0,0,0,.15); }
    .gallery-item .overlay {
        position: absolute; inset: 0;
        background: rgba(0,0,0,0); display: flex; align-items: center; justify-content: center;
        transition: background .3s;
    }
    .gallery-item:hover .overlay { background: rgba(0,0,0,.2); }
    .gallery-item:hover .overlay i { opacity: 1; transform: scale(1); }
    .gallery-item .overlay i { opacity: 0; transform: scale(.8); transition: all .3s; color: white; font-size: 24px; }

    /* ── LAYANAN ── */
    .layanan-card {
        background: white; border-radius: 18px; padding: 24px 16px;
        text-align: center; border: 1px solid #f1f5f9;
        text-decoration: none; display: block;
        transition: all .25s;
    }
    .layanan-card:hover { border-color: #bfdbfe; transform: translateY(-4px); box-shadow: 0 16px 32px rgba(29,78,216,.1); }
    .layanan-icon {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 12px; font-size: 20px;
        transition: transform .25px;
    }
    .layanan-card:hover .layanan-icon { transform: scale(1.12) rotate(-5deg); }

    /* ── MAPS ── */
    .maps-frame {
        border-radius: 20px; overflow: hidden;
        border: 3px solid #bfdbfe;
        box-shadow: 0 16px 40px rgba(29,78,216,.12);
    }

    /* ── SECTION LABEL ── */
    .sec-label {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        color: var(--red); background: var(--red-light); border: 1px solid #bfdbfe;
        padding: 4px 14px; border-radius: 999px; margin-bottom: 10px;
    }
    .sec-label::before { content: ''; width: 6px; height: 6px; background: var(--red); border-radius: 50%; }

    /* ── DIVIDER ── */
    .section-divider { height: 1px; background: linear-gradient(90deg, transparent, #e5e7eb 30%, #e5e7eb 70%, transparent); margin: 0; }

    /* Hover lift utility */
    .hover-lift { transition: transform .25s, box-shadow .25s; }
    .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 12px 28px rgba(0,0,0,.1); }
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO SLIDER
═══════════════════════════════════════════════════ --}}
<div class="hero-wrap relative" style="min-height: 580px;">
    <div class="hero-pattern"></div>
    <div class="hero-circle-1"></div>
    <div class="hero-circle-2"></div>

    <div class="w-full relative z-10 overflow-hidden">
        <div class="slides-track" id="slidesTrack">

            {{-- ── Slide 1: Selamat Datang ── --}}
            <div class="slide-item" style="min-width:100%">
                <div class="max-w-7xl mx-auto px-8 py-20 flex flex-col md:flex-row items-center gap-10 relative z-10">
                    <div class="flex-1">
                        <div class="hero-badge">
                            <span></span> Sekolah Unggulan Kota Kediri
                        </div>
                        <h1 class="font-display text-white leading-tight mb-5" style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 900;">
                            Selamat Datang di<br>
                            <span style="color: #FDE68A;">SDN Sukorame 1</span>
                        </h1>
                        <p class="text-white/80 leading-relaxed mb-8 max-w-lg" style="font-size: 1rem;">
                            Membentuk generasi cerdas, berkarakter, dan berprestasi berlandaskan iman, ilmu, dan teknologi. <em>Santun dalam berperilaku, hebat dalam prestasi.</em>
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('profil.visi-misi') }}"
                               class="inline-flex items-center gap-2 bg-white text-blue-800 font-bold px-6 py-3 rounded-2xl hover:bg-amber-50 transition-all shadow-xl text-sm">
                                <i class="fa fa-info-circle"></i> Profil Sekolah
                            </a>
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center gap-2 border-2 border-white/40 text-white font-bold px-6 py-3 rounded-2xl hover:bg-white/15 transition-all text-sm backdrop-blur-sm">
                                <i class="fa fa-graduation-cap"></i> Masuk E-Learning
                            </a>
                        </div>
                    </div>
                    {{-- Decorative card kanan --}}
                    <div class="hidden md:flex flex-col gap-3 flex-shrink-0">
                        <div class="bg-white/12 backdrop-blur-sm border border-white/20 rounded-2xl p-4 w-56">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-amber-400/30 rounded-xl flex items-center justify-center"><i class="fa fa-trophy text-amber-300 text-sm"></i></div>
                                <span class="text-white font-bold text-sm">Akreditasi A</span>
                            </div>
                            <p class="text-white/65 text-xs">Nilai sangat baik dari BAN-SM</p>
                        </div>
                        <div class="bg-white/12 backdrop-blur-sm border border-white/20 rounded-2xl p-4 w-56">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-blue-400/30 rounded-xl flex items-center justify-center"><i class="fa fa-laptop text-blue-300 text-sm"></i></div>
                                <span class="text-white font-bold text-sm">Platform SIMAS</span>
                            </div>
                            <p class="text-white/65 text-xs">E-learning & raport digital</p>
                        </div>
                        <div class="bg-white/12 backdrop-blur-sm border border-white/20 rounded-2xl p-4 w-56">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-green-400/30 rounded-xl flex items-center justify-center"><i class="fa fa-book text-green-300 text-sm"></i></div>
                                <span class="text-white font-bold text-sm">Kurikulum Merdeka</span>
                            </div>
                            <p class="text-white/65 text-xs">Pembelajaran inovatif & kreatif</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Slide 2: E-Learning SIMAS ── --}}
            <div class="slide-item" style="min-width:100%; background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 50%, #1d4ed8 100%);">
                <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 32px 32px;"></div>
                <div class="max-w-7xl mx-auto px-8 py-20 relative z-10">
                    <div class="hero-badge" style="color: #93C5FD; background: rgba(147,197,253,.15); border-color: rgba(147,197,253,.3);">
                        <span style="background:#93C5FD"></span> E-Learning SIMAS
                    </div>
                    <h2 class="font-display text-white leading-tight mb-5" style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 900; max-width: 600px;">
                        Belajar Kapanpun,<br>
                        <span style="color:#7DD3FC">Dimanapun bersama SIMAS</span>
                    </h2>
                    <p class="text-white/75 leading-relaxed mb-8 max-w-lg" style="font-size:1rem;">
                        Akses materi pelajaran, pantau nilai harian, absensi, tugas, dan raport digital — semua dalam satu platform terintegrasi.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-white text-blue-800 font-bold px-6 py-3 rounded-2xl hover:bg-blue-50 transition-all shadow-xl text-sm">
                            <i class="fa fa-sign-in-alt"></i> Masuk Sekarang
                        </a>
                        <a href="{{ route('akademik.kurikulum') }}" class="inline-flex items-center gap-2 border-2 border-white/30 text-white font-bold px-6 py-3 rounded-2xl hover:bg-white/15 transition-all text-sm">
                            <i class="fa fa-book-open"></i> Info Kurikulum
                        </a>
                    </div>
                </div>
            </div>

            {{-- ── Slide 3: PPDB ── --}}
            <div class="slide-item" style="min-width:100%; background: linear-gradient(135deg, #052e16 0%, #14532d 50%, #15803d 100%);">
                <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 32px 32px;"></div>
                <div class="max-w-7xl mx-auto px-8 py-20 relative z-10">
                    <div class="hero-badge" style="color: #86EFAC; background: rgba(134,239,172,.15); border-color: rgba(134,239,172,.3);">
                        <span style="background:#86EFAC"></span> PPDB 2025/2026
                    </div>
                    <h2 class="font-display text-white leading-tight mb-5" style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 900; max-width: 600px;">
                        Bergabunglah Bersama<br>
                        <span style="color:#FDE68A">Keluarga Besar SDN Sukorame 1</span>
                    </h2>
                    <p class="text-white/75 leading-relaxed mb-8 max-w-lg" style="font-size:1rem;">
                        Penerimaan peserta didik baru tahun ajaran 2025/2026 kini dibuka. Kuota terbatas — segera daftarkan putra-putri Anda!
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('ppdb.info') }}" class="inline-flex items-center gap-2 bg-white text-green-800 font-bold px-6 py-3 rounded-2xl hover:bg-green-50 transition-all shadow-xl text-sm">
                            <i class="fa fa-user-plus"></i> Info PPDB
                        </a>
                        <a href="{{ route('ppdb.syarat') }}" class="inline-flex items-center gap-2 border-2 border-white/30 text-white font-bold px-6 py-3 rounded-2xl hover:bg-white/15 transition-all text-sm">
                            <i class="fa fa-list-check"></i> Syarat Pendaftaran
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Controls --}}
        <button class="slider-btn" style="left:16px" onclick="slideBy(-1)"><i class="fa fa-chevron-left text-sm"></i></button>
        <button class="slider-btn" style="right:16px" onclick="slideBy(1)"><i class="fa fa-chevron-right text-sm"></i></button>
        <div class="slider-dots" id="sliderDots">
            <button class="sdot active" onclick="goSlide(0)"></button>
            <button class="sdot" onclick="goSlide(1)"></button>
            <button class="sdot" onclick="goSlide(2)"></button>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════
     STATISTIK
═══════════════════════════════════════════════════ --}}
<section id="stats-section" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-y md:divide-y-0 divide-gray-100">
            @php
                $stats_list = [
                    ['icon'=>'fa-users','label'=>'Total Siswa','key'=>'siswa','color'=>'blue','accent'=>'border-blue-500'],
                    ['icon'=>'fa-chalkboard-teacher','label'=>'Tenaga Pendidik','key'=>'guru','color'=>'blue','accent'=>'border-blue-500'],
                    ['icon'=>'fa-door-open','label'=>'Rombel / Kelas','key'=>'kelas','color'=>'green','accent'=>'border-green-500'],
                    ['icon'=>'fa-book-open','label'=>'Mata Pelajaran','key'=>'mapel','color'=>'amber','accent'=>'border-amber-500'],
                ];
                $sc = [
                    'blue' => ['bg'=>'bg-blue-50','text'=>'text-blue-700','ico'=>'text-blue-500'],
                    'green'=> ['bg'=>'bg-green-50','text'=>'text-green-700','ico'=>'text-green-500'],
                    'amber'=> ['bg'=>'bg-amber-50','text'=>'text-amber-700','ico'=>'text-amber-500'],
                ];
            @endphp
            @foreach ($stats_list as $i => $s)
            @php $c = $sc[$s['color']]; @endphp
            <div class="stat-card flex items-center gap-5 p-8 border-b-4 {{ $s['accent'] }} border-t-0 border-l-0 border-r-0">
                <div class="w-14 h-14 {{ $c['bg'] }} rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fa {{ $s['icon'] }} {{ $c['ico'] }} text-2xl"></i>
                </div>
                <div>
                    <p class="text-3xl font-black {{ $c['text'] }} leading-none" data-count="{{ $stats[$s['key']] }}">{{ $stats[$s['key']] }}</p>
                    <p class="text-xs text-gray-500 font-semibold mt-1 uppercase tracking-wide">{{ $s['label'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     MENGAPA MEMILIH
═══════════════════════════════════════════════════ --}}
<section id="keunggulan" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14">
            <div class="sec-label">Keunggulan Kami</div>
            <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Mengapa Memilih SDN Sukorame 1?</h2>
            <p class="text-gray-500 text-sm max-w-xl mx-auto leading-relaxed">
                Sekolah kami hadir dengan komitmen penuh membangun generasi yang
                <em class="text-blue-700 not-italic font-semibold">santun dalam berperilaku, hebat dalam prestasi</em>
            </p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">
            @php
                $keungs = [
                    ['icon'=>'fa-award',      'title'=>'Sekolah Unggulan',      'desc'=>'Terbaik di Kota Kediri',   'color'=>'blue'],
                    ['icon'=>'fa-user-tie',   'title'=>'Pendidik Berkualitas',   'desc'=>'Guru berpengalaman & tersertifikasi', 'color'=>'indigo'],
                    ['icon'=>'fa-shield-alt', 'title'=>'Berintegritas',          'desc'=>'Transparan & akuntabel',   'color'=>'purple'],
                    ['icon'=>'fa-trophy',     'title'=>'Siswa Berprestasi',      'desc'=>'Juara lokal & nasional',   'color'=>'amber'],
                    ['icon'=>'fa-heart',      'title'=>'Berkarakter',            'desc'=>'Berbudi pekerti luhur',    'color'=>'pink'],
                    ['icon'=>'fa-building',   'title'=>'Fasilitas Lengkap',      'desc'=>'Sarana modern & nyaman',   'color'=>'teal'],
                ];
                $kc = [
                    'blue'  =>['bg'=>'bg-blue-50',   'ico'=>'text-blue-600'],
                    'indigo'=>['bg'=>'bg-indigo-50',  'ico'=>'text-indigo-600'],
                    'purple'=>['bg'=>'bg-purple-50','ico'=>'text-purple-600'],
                    'amber' =>['bg'=>'bg-amber-50', 'ico'=>'text-amber-600'],
                    'pink'  =>['bg'=>'bg-pink-50',  'ico'=>'text-pink-600'],
                    'teal'  =>['bg'=>'bg-teal-50',  'ico'=>'text-teal-600'],
                ];
            @endphp
            @foreach ($keungs as $k)
            @php $kcc = $kc[$k['color']]; @endphp
            <div class="keung-card">
                <div class="keung-icon-wrap {{ $kcc['bg'] }}">
                    <i class="fa {{ $k['icon'] }} {{ $kcc['ico'] }}"></i>
                </div>
                <p class="font-bold text-gray-800 text-sm mb-1">{{ $k['title'] }}</p>
                <p class="text-gray-400 text-xs leading-snug">{{ $k['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="section-divider"></div>

{{-- ═══════════════════════════════════════════════════
     SAMBUTAN KEPALA SEKOLAH
═══════════════════════════════════════════════════ --}}
<section id="sambutan" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-16 items-start">

            {{-- Foto --}}
            <div class="flex-shrink-0 text-center mx-auto md:mx-0">
                <div class="kepsek-photo mx-auto">
                    <i class="fa fa-user-tie text-gray-200 relative z-10" style="font-size: 80px;"></i>
                </div>
                <div class="mt-5 text-center">
                    <p class="font-bold text-gray-900 text-base">{{ $sekolah?->kepala_sekolah ?? 'Nama Kepala Sekolah' }}</p>
                    <p class="text-gray-500 text-xs mt-1">Kepala Sekolah SDN Sukorame 1</p>
                    <span class="inline-block mt-3 bg-blue-50 text-blue-700 text-xs font-bold px-4 py-1.5 rounded-full border border-blue-200">
                        NIP. {{ $sekolah?->nip_kepsek ?? '—' }}
                    </span>
                </div>
            </div>

            {{-- Teks --}}
            <div class="flex-1 relative">
                <div class="quote-mark">"</div>
                <div class="sec-label">Sambutan</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-6">Sambutan<br>Kepala Sekolah</h2>
                <div class="space-y-4 text-gray-600 text-sm leading-relaxed">
                    <p>
                        <em class="font-semibold text-gray-800">Assalamu'alaikum Warahmatullahi Wabarakatuh.</em>
                        Puji syukur kami panjatkan kehadirat Allah SWT atas segala limpahan rahmat dan karunia-Nya.
                        Selamat datang di website resmi <strong class="text-blue-700">SD Negeri Sukorame 1 Kota Kediri</strong>.
                    </p>
                    <p>
                        Sebagai sekolah dasar negeri yang telah berdiri puluhan tahun dan meraih akreditasi A, kami terus berkomitmen
                        menghadirkan pendidikan berkualitas yang berakar pada nilai-nilai keislaman, keilmuan, dan teknologi modern.
                    </p>
                    <p>
                        Platform <strong>SIMAS</strong> kami hadirkan sebagai jembatan komunikasi antara sekolah dan orang tua —
                        memudahkan pemantauan nilai, absensi, materi pembelajaran, hingga raport digital secara real-time,
                        kapanpun dan dimanapun Anda berada.
                    </p>
                    <p>
                        Semoga website ini bermanfaat dan menjadi salah satu wujud nyata komitmen kami. Bersama, kita wujudkan
                        generasi yang <em>cerdas, berkarakter, dan berprestasi.</em>
                    </p>
                    <p class="font-semibold text-gray-700 italic">Wassalamu'alaikum Warahmatullahi Wabarakatuh.</p>
                </div>
                <div class="flex flex-wrap gap-3 mt-8">
                    <a href="#kontak" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-bold text-sm px-6 py-3 rounded-2xl transition-colors shadow-lg">
                        <i class="fa fa-envelope text-xs"></i> Hubungi Kami
                    </a>
                    <a href="{{ route('profil.visi-misi') }}" class="inline-flex items-center gap-2 border-2 border-blue-200 text-blue-700 font-bold text-sm px-6 py-3 rounded-2xl hover:bg-blue-50 transition-colors">
                        Profil Sekolah <i class="fa fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     INFORMASI SEKOLAH (band biru)
═══════════════════════════════════════════════════ --}}
<section class="info-band py-14">
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-10">
            <h3 class="font-display text-2xl font-black text-white mb-1">Identitas Sekolah</h3>
            <p class="text-white/60 text-xs uppercase tracking-widest">Data Resmi SD Negeri Sukorame 1</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $infoItems = [
                    ['icon'=>'fa-school',        'label'=>'Nama Sekolah',  'value'=> $sekolah?->nama ?? 'SD Negeri Sukorame 1'],
                    ['icon'=>'fa-barcode',        'label'=>'NPSN',          'value'=> $sekolah?->npsn ?? '20534318'],
                    ['icon'=>'fa-map-marker-alt', 'label'=>'Alamat',        'value'=> $sekolah?->alamat ?? 'Jl. Dr. Saharjo No. 1, Kediri'],
                    ['icon'=>'fa-star',           'label'=>'Akreditasi',    'value'=> $sekolah?->akreditasi ?? 'B'],
                    ['icon'=>'fa-book',           'label'=>'Kurikulum',     'value'=> $sekolah?->kurikulum ?? 'Kurikulum Merdeka'],
                    ['icon'=>'fa-flag',           'label'=>'Status',        'value'=> $sekolah?->status ?? 'Negeri'],
                    ['icon'=>'fa-phone',          'label'=>'Telepon',       'value'=> $sekolah?->telepon ?? '(0354) 123456'],
                    ['icon'=>'fa-envelope',       'label'=>'Email',         'value'=> $sekolah?->email ?? 'sdn.sukorame1@kediri.go.id'],
                ];
            @endphp
            @foreach ($infoItems as $info)
            <div class="info-item">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 bg-white/15 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fa {{ $info['icon'] }} text-amber-300 text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-white/55 text-xs mb-0.5 uppercase tracking-wider">{{ $info['label'] }}</p>
                        <p class="text-white font-bold text-sm truncate" title="{{ $info['value'] }}">{{ $info['value'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     BERITA & PENGUMUMAN
═══════════════════════════════════════════════════ --}}
<section id="berita" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-end justify-between mb-12">
            <div>
                <div class="sec-label">Informasi Terkini</div>
                <h2 class="font-display text-3xl font-black text-gray-900">Berita &amp; Pengumuman</h2>
            </div>
            <a href="{{ route('berita.index') }}"
               class="hidden sm:inline-flex items-center gap-2 text-blue-700 font-bold text-sm border-2 border-blue-200 px-4 py-2 rounded-xl hover:bg-blue-50 transition-colors">
                Lihat Semua <i class="fa fa-arrow-right text-xs"></i>
            </a>
        </div>

        @if ($pengumuman->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $newsColors = [
                    ['thumb'=>'from-blue-100 to-sky-200',      'dot'=>'text-blue-300',  'badge'=>'bg-blue-50 text-blue-700',   'link'=>'text-blue-700'],
                    ['thumb'=>'from-indigo-100 to-blue-200',   'dot'=>'text-indigo-300','badge'=>'bg-indigo-50 text-indigo-700','link'=>'text-indigo-700'],
                    ['thumb'=>'from-emerald-100 to-green-200', 'dot'=>'text-green-300', 'badge'=>'bg-green-50 text-green-700', 'link'=>'text-green-700'],
                ];
            @endphp
            @foreach ($pengumuman as $idx => $p)
            @php $nc = $newsColors[$idx % 3]; @endphp
            <div class="news-card">
                <div class="news-thumb bg-gradient-to-br {{ $nc['thumb'] }}">
                    <i class="fa fa-newspaper text-6xl {{ $nc['dot'] }} opacity-60 relative z-10"></i>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="news-kategori {{ $nc['badge'] }}">
                            <i class="fa fa-tag text-[9px]"></i>
                            {{ ucfirst($p->kategori ?? 'Pengumuman') }}
                        </span>
                        <span class="text-xs text-gray-400 ml-auto">
                            <i class="fa fa-calendar-alt mr-1"></i>
                            {{ \Carbon\Carbon::parse($p->created_at)->locale('id')->isoFormat('D MMM Y') }}
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-base leading-snug mb-2 line-clamp-2">{{ $p->judul }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed line-clamp-3 mb-4">
                        {{ \Illuminate\Support\Str::limit(strip_tags($p->isi ?? $p->konten ?? ''), 150) }}
                    </p>
                    <a href="{{ route('berita.show', $p->id) }}"
                       class="inline-flex items-center gap-1.5 {{ $nc['link'] }} text-xs font-bold hover:gap-2.5 transition-all">
                        Baca Selengkapnya <i class="fa fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-6 sm:hidden">
            <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 text-blue-700 font-bold text-sm border-2 border-blue-200 px-5 py-2.5 rounded-xl hover:bg-blue-50 transition-colors">
                Lihat Semua Berita <i class="fa fa-arrow-right text-xs"></i>
            </a>
        </div>
        @else
        <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200">
            <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fa fa-newspaper text-gray-300 text-3xl"></i>
            </div>
            <p class="font-semibold text-gray-400 text-sm">Belum ada pengumuman terbaru.</p>
            <p class="text-gray-300 text-xs mt-1">Silakan cek kembali nanti.</p>
        </div>
        @endif
    </div>
</section>

<div class="section-divider"></div>

{{-- ═══════════════════════════════════════════════════
     AGENDA + LOGIN CARD
═══════════════════════════════════════════════════ --}}
<section id="agenda" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-12">

            {{-- Agenda --}}
            <div class="flex-1">
                <div class="sec-label">Jadwal Sekolah</div>
                <h2 class="font-display text-3xl font-black text-gray-900 mb-8">Agenda Kegiatan</h2>
                <div class="space-y-3">
                    @php
                        $agendas = [
                            ['tgl'=>'28','bln'=>'Apr','title'=>'Upacara Hari Pendidikan Nasional','waktu'=>'07.00 WIB','tempat'=>'Lapangan Sekolah','color'=>'blue'],
                            ['tgl'=>'02','bln'=>'Mei','title'=>'Penilaian Akhir Tahun (PAT) Kelas I – V','waktu'=>'07.30 WIB','tempat'=>'Ruang Kelas','color'=>'indigo'],
                            ['tgl'=>'15','bln'=>'Mei','title'=>'Pembagian Raport Semester Genap','waktu'=>'08.00 WIB','tempat'=>'Ruang Kelas','color'=>'green'],
                            ['tgl'=>'20','bln'=>'Mei','title'=>'Perpisahan Kelas VI TA 2024/2025','waktu'=>'09.00 WIB','tempat'=>'Aula Sekolah','color'=>'amber'],
                            ['tgl'=>'01','bln'=>'Jun','title'=>'Libur Akhir Tahun Ajaran 2024/2025','waktu'=>'Seharian','tempat'=>'—','color'=>'purple'],
                            ['tgl'=>'14','bln'=>'Jul','title'=>'Penerimaan Peserta Didik Baru (PPDB)','waktu'=>'08.00 WIB','tempat'=>'Kantor Sekolah','color'=>'teal'],
                        ];
                        $agc = [
                            'blue'  =>'bg-blue-100 text-blue-700',
                            'indigo'=>'bg-indigo-100 text-indigo-700',
                            'green' =>'bg-green-100 text-green-700',
                            'amber' =>'bg-amber-100 text-amber-700',
                            'purple'=>'bg-purple-100 text-purple-700',
                            'teal'  =>'bg-teal-100 text-teal-700',
                        ];
                    @endphp
                    @foreach ($agendas as $ag)
                    <div class="agenda-item">
                        <div class="agenda-date {{ $agc[$ag['color']] }}">
                            <p class="text-2xl font-black leading-none">{{ $ag['tgl'] }}</p>
                            <p class="text-[10px] font-bold uppercase tracking-wider mt-0.5">{{ $ag['bln'] }}</p>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-gray-900 text-sm leading-snug">{{ $ag['title'] }}</p>
                            <div class="flex flex-wrap gap-4 text-xs text-gray-400 mt-2">
                                <span class="flex items-center gap-1"><i class="fa fa-clock text-gray-300"></i>{{ $ag['waktu'] }}</span>
                                <span class="flex items-center gap-1"><i class="fa fa-map-marker-alt text-gray-300"></i>{{ $ag['tempat'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    <a href="{{ route('berita.agenda') }}" class="inline-flex items-center gap-2 text-blue-700 font-bold text-sm border-2 border-blue-200 px-5 py-2.5 rounded-xl hover:bg-blue-50 transition-colors">
                        Lihat Semua Agenda <i class="fa fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            {{-- Login Card --}}
            <div class="flex-shrink-0 w-full lg:w-80">
                <div class="login-card">
                    <div class="text-center mb-6">
                        <div class="w-18 h-18 bg-white/15 rounded-2xl flex items-center justify-center mx-auto mb-4" style="width:72px;height:72px;">
                            <i class="fa fa-graduation-cap text-amber-300 text-3xl"></i>
                        </div>
                        <h3 class="font-display font-black text-white text-xl">Login SIMAS</h3>
                        <p class="text-white/60 text-xs mt-1">Sistem Informasi Manajemen Sekolah</p>
                        <div class="w-16 h-0.5 bg-white/20 mx-auto mt-3"></div>
                    </div>
                    <div class="space-y-3">
                        @php
                            $roles = [
                                ['icon'=>'fa-user-graduate',    'label'=>'Siswa',      'desc'=>'Materi, tugas & nilai',        'color'=>'text-cyan-300'],
                                ['icon'=>'fa-chalkboard-teacher','label'=>'Guru',       'desc'=>'Kelola nilai, absensi, materi','color'=>'text-green-300'],
                                ['icon'=>'fa-user-shield',       'label'=>'Admin',      'desc'=>'Kelola data sekolah',          'color'=>'text-amber-300'],
                                ['icon'=>'fa-users',             'label'=>'Orang Tua',  'desc'=>'Pantau perkembangan anak',     'color'=>'text-pink-300'],
                            ];
                        @endphp
                        @foreach ($roles as $role)
                        <a href="{{ route('login') }}" class="role-btn">
                            <div class="w-10 h-10 bg-white/12 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fa {{ $role['icon'] }} {{ $role['color'] }} text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-white font-bold text-sm">{{ $role['label'] }}</p>
                                <p class="text-white/55 text-xs">{{ $role['desc'] }}</p>
                            </div>
                            <i class="fa fa-chevron-right text-white/30 text-xs"></i>
                        </a>
                        @endforeach
                    </div>
                    <div class="mt-5 pt-5 border-t border-white/15 text-center">
                        <p class="text-white/40 text-xs">Belum punya akun?</p>
                        <a href="{{ route('ppdb.info') }}" class="text-amber-300 font-bold text-xs hover:text-amber-200 transition-colors">Info PPDB & Pendaftaran →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     GALERI FOTO
═══════════════════════════════════════════════════ --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-end justify-between mb-12">
            <div>
                <div class="sec-label">Galeri</div>
                <h2 class="font-display text-3xl font-black text-gray-900">Galeri Sekolah</h2>
                <p class="text-gray-500 text-sm mt-2">Momen berharga kegiatan SDN Sukorame 1</p>
            </div>
            <a href="{{ route('galeri.foto') }}" class="hidden sm:inline-flex items-center gap-2 text-blue-700 font-bold text-sm border-2 border-blue-200 px-4 py-2 rounded-xl hover:bg-blue-50 transition-colors">
                Lihat Semua <i class="fa fa-arrow-right text-xs"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $galeri = [
                    ['bg'=>'from-blue-100 to-sky-200',       'tc'=>'text-blue-300',   'label'=>'Upacara Bendera'],
                    ['bg'=>'from-indigo-100 to-blue-200',    'tc'=>'text-indigo-300', 'label'=>'Kegiatan Belajar'],
                    ['bg'=>'from-emerald-100 to-green-200',  'tc'=>'text-green-300',  'label'=>'Ekstrakulikuler'],
                    ['bg'=>'from-amber-100 to-yellow-200',   'tc'=>'text-amber-400',  'label'=>'Prestasi Siswa'],
                    ['bg'=>'from-purple-100 to-violet-200',  'tc'=>'text-purple-300', 'label'=>'Pentas Seni'],
                    ['bg'=>'from-pink-100 to-rose-200',      'tc'=>'text-pink-300',   'label'=>'Olahraga'],
                    ['bg'=>'from-teal-100 to-cyan-200',      'tc'=>'text-teal-300',   'label'=>'Adiwiyata'],
                    ['bg'=>'from-cyan-100 to-blue-200',      'tc'=>'text-cyan-300',   'label'=>'Literasi'],
                ];
            @endphp
            @foreach ($galeri as $g)
            <div class="gallery-item bg-gradient-to-br {{ $g['bg'] }}">
                <div class="w-full h-full flex flex-col items-center justify-center p-4">
                    <i class="fa fa-image {{ $g['tc'] }} text-4xl mb-2"></i>
                    <p class="text-xs {{ $g['tc'] }} font-semibold text-center opacity-75">{{ $g['label'] }}</p>
                </div>
                <div class="overlay">
                    <i class="fa fa-expand-alt"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="section-divider"></div>

{{-- ═══════════════════════════════════════════════════
     LAYANAN SEKOLAH
═══════════════════════════════════════════════════ --}}
<section class="py-20 bg-white" id="layanan">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <div class="sec-label">Layanan Online</div>
            <h2 class="font-display text-3xl font-black text-gray-900 mb-3">Layanan Sekolah</h2>
            <p class="text-gray-500 text-sm max-w-lg mx-auto">Berbagai layanan administratif yang dapat diakses secara online dengan mudah</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @php
                $layanan = [
                    ['icon'=>'fa-exchange-alt',  'label'=>'Mutasi Siswa',      'sub'=>'Pindah masuk/keluar', 'color'=>'blue',   'route'=>'layanan.mutasi'],
                    ['icon'=>'fa-file-alt',       'label'=>'Surat Keterangan', 'sub'=>'Permohonan surat',    'color'=>'indigo', 'route'=>'layanan.surat'],
                    ['icon'=>'fa-id-card',        'label'=>'Cek NISN',         'sub'=>'Verifikasi nomor induk','color'=>'green', 'route'=>'layanan.nisn'],
                    ['icon'=>'fa-graduation-cap', 'label'=>'Beasiswa PIP',     'sub'=>'Cek status PIP',      'color'=>'amber',  'route'=>'layanan.pip'],
                    ['icon'=>'fa-download',       'label'=>'Unduhan',          'sub'=>'Dokumen & formulir',  'color'=>'purple', 'route'=>'layanan.unduhan'],
                    ['icon'=>'fa-users',          'label'=>'Alumni',           'sub'=>'Jaringan alumni',     'color'=>'teal',   'route'=>'layanan.alumni'],
                ];
                $lcc = [
                    'blue'  =>['bg'=>'bg-blue-50',   'ico'=>'text-blue-600'],
                    'indigo'=>['bg'=>'bg-indigo-50',  'ico'=>'text-indigo-600'],
                    'green' =>['bg'=>'bg-green-50',  'ico'=>'text-green-600'],
                    'amber' =>['bg'=>'bg-amber-50',  'ico'=>'text-amber-600'],
                    'purple'=>['bg'=>'bg-purple-50', 'ico'=>'text-purple-600'],
                    'teal'  =>['bg'=>'bg-teal-50',   'ico'=>'text-teal-600'],
                ];
            @endphp
            @foreach ($layanan as $l)
            @php $lc = $lcc[$l['color']]; @endphp
            <a href="{{ route($l['route']) }}" class="layanan-card">
                <div class="layanan-icon {{ $lc['bg'] }}">
                    <i class="fa {{ $l['icon'] }} {{ $lc['ico'] }}"></i>
                </div>
                <p class="font-bold text-gray-900 text-xs mb-1">{{ $l['label'] }}</p>
                <p class="text-gray-400 text-xs leading-snug">{{ $l['sub'] }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     LOKASI SEKOLAH (MAPS)
═══════════════════════════════════════════════════ --}}
<section class="py-20 bg-gray-50" id="lokasi">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <div class="sec-label">Lokasi</div>
            <h2 class="font-display text-3xl font-black text-gray-900 mb-2">Temukan Kami</h2>
            <p class="text-gray-500 text-sm">SD Negeri Sukorame 1, Kota Kediri, Jawa Timur</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-stretch">

            {{-- Info Panel --}}
            <div class="w-full lg:w-80 flex-shrink-0 flex flex-col gap-4">

                {{-- Info card --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex-1">
                    <h3 class="font-bold text-gray-900 text-base mb-5 flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i class="fa fa-location-dot text-blue-600 text-sm"></i>
                        </div>
                        Info Kontak
                    </h3>
                    <div class="space-y-4">
                        @php
                            $contacts = [
                                ['icon'=>'fa-map-marker-alt','color'=>'bg-blue-50 text-blue-600',   'label'=>'Alamat',          'value'=>'Jl. Sukorame No. 1, Sukorame, Kec. Mojoroto, Kota Kediri, Jawa Timur 64161'],
                                ['icon'=>'fa-phone',         'color'=>'bg-indigo-50 text-indigo-600','label'=>'Telepon',         'value'=>'(0354) 123456'],
                                ['icon'=>'fa-envelope',      'color'=>'bg-amber-50 text-amber-600',  'label'=>'Email',           'value'=>'sdn.sukorame1@kediri.go.id'],
                                ['icon'=>'fa-clock',         'color'=>'bg-green-50 text-green-600',  'label'=>'Jam Operasional', 'value'=>'Senin – Sabtu: 07.00 – 13.00 WIB'],
                            ];
                        @endphp
                        @foreach ($contacts as $ct)
                        <div class="flex gap-3">
                            <div class="w-9 h-9 {{ $ct['color'] }} rounded-xl flex items-center justify-center flex-shrink-0 text-sm">
                                <i class="fa {{ $ct['icon'] }}"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 mb-0.5">{{ $ct['label'] }}</p>
                                <p class="text-gray-700 text-xs leading-snug">{{ $ct['value'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tombol --}}
                <a href="https://maps.app.goo.gl/P5GbK9JDJcaWFkZq6"
                   target="_blank"
                   class="flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-bold text-sm py-3.5 rounded-2xl transition-colors shadow-lg">
                    <i class="fa fa-directions"></i> Buka di Google Maps
                </a>
            </div>

            {{-- Maps --}}
            <div class="flex-1 maps-frame" style="min-height: 420px;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d988.1960707736812!2d111.9908234775055!3d-7.812645247027267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7856dd765d85fb%3A0xbde787f5a27b66ac!2sSDN%20Sukorame%201%20%26%203!5e0!3m2!1sid!2sid!4v1777221061970!5m2!1sid!2sid"
                    width="100%"
                    height="100%"
                    style="border:0; display:block; min-height: 420px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi SD Negeri Sukorame 1 Kediri">
                </iframe>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {

        // ── SLIDER ──
        let cur = 0;
        const total = 3;
        const track = document.getElementById('slidesTrack');
        const dots  = document.querySelectorAll('.sdot');
        let autoSlide;

        function goSlide(n) {
            cur = (n + total) % total;
            track.style.transform = `translateX(-${cur * 100}%)`;

            dots.forEach((d, i) => {
                d.classList.toggle('active', i === cur);
            });
        }

        function slideBy(d) {
            goSlide(cur + d);
        }

        // ⬇️ bikin global supaya onclick bisa akses
        window.goSlide = goSlide;
        window.slideBy = slideBy;

        // auto slide
        function startAutoSlide() {
            autoSlide = setInterval(() => slideBy(1), 5500);
        }

        function stopAutoSlide() {
            clearInterval(autoSlide);
        }

        startAutoSlide();

        // pause saat hover (biar UX lebih enak)
        if (track) {
            track.addEventListener('mouseenter', stopAutoSlide);
            track.addEventListener('mouseleave', startAutoSlide);
        }

        // ── COUNTER ──
        const statsEl = document.getElementById('stats-section');

        if (statsEl) {
            const observer = new IntersectionObserver(entries => {
                if (!entries[0].isIntersecting) return;

                document.querySelectorAll('[data-count]').forEach(el => {
                    const target = +el.dataset.count;
                    const step = Math.max(1, Math.ceil(target / 60));
                    let current = 0;

                    const timer = setInterval(() => {
                        current = Math.min(current + step, target);
                        el.textContent = current.toLocaleString('id-ID');

                        if (current >= target) {
                            clearInterval(timer);
                        }
                    }, 20);
                });

                observer.disconnect(); // biar ga jalan berulang
            }, { threshold: 0.3 });

            observer.observe(statsEl);
        }

    });
</script>
@endpush