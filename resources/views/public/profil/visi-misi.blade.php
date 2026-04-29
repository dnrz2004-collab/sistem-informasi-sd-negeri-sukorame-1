@extends('layouts.public')

@section('title', $pageTitle)

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --blue: #1D4ED8;
        --blue-dark: #1e3a8a;
        --blue-light: #EFF6FF;
        --gold: #D97706;
        --gold-light: #FEF3C7;
    }
    .font-display { font-family: 'Playfair Display', serif; }

    /* ── PAGE HERO ── */
    .page-hero {
        background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 45%, #1d4ed8 75%, #3b82f6 100%);
        position: relative; overflow: hidden;
    }
    .page-hero-pattern {
        position: absolute; inset: 0; opacity: .05;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 28px 28px;
    }
    .page-hero-circle {
        position: absolute; border-radius: 50%; pointer-events: none;
    }

    /* ── VISI CARD ── */
    .visi-card {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 60%, #3b82f6 100%);
        border-radius: 28px; padding: 52px 48px;
        position: relative; overflow: hidden;
        box-shadow: 0 32px 80px rgba(29,78,216,.35);
    }
    .visi-card::before {
        content: ''; position: absolute; inset: 0; opacity: .04;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 24px 24px;
    }
    .visi-card-deco {
        position: absolute; border-radius: 50%; pointer-events: none;
    }
    .visi-quote {
        font-family: 'Playfair Display', serif;
        font-size: 120px; line-height: .8; color: rgba(255,255,255,.08);
        position: absolute; top: 0; left: 28px; pointer-events: none;
        user-select: none;
    }
    .visi-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.25);
        color: #FDE68A; font-size: 11px; font-weight: 700;
        padding: 5px 14px; border-radius: 999px; letter-spacing: .08em;
        text-transform: uppercase; margin-bottom: 20px;
    }

    /* ── SECTION LABEL ── */
    .sec-label {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        color: #1d4ed8; background: #eff6ff; border: 1px solid #bfdbfe;
        padding: 4px 14px; border-radius: 999px; margin-bottom: 12px;
    }
    .sec-label::before { content: ''; width: 6px; height: 6px; background: #1d4ed8; border-radius: 50%; }

    /* ── MISI ITEMS ── */
    .misi-item {
        display: flex; align-items: flex-start; gap: 18px;
        padding: 20px 24px; border-radius: 20px;
        border: 1px solid #f1f5f9; background: white;
        transition: all .25s; cursor: default;
        position: relative; overflow: hidden;
    }
    .misi-item::before {
        content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px;
        background: transparent; border-radius: 0 2px 2px 0;
        transition: background .25s;
    }
    .misi-item:hover { border-color: #bfdbfe; background: #f8fbff; transform: translateX(4px); box-shadow: 0 8px 24px rgba(29,78,216,.07); }
    .misi-item:hover::before { background: #1d4ed8; }
    .misi-num {
        width: 40px; height: 40px; flex-shrink: 0;
        border-radius: 12px; background: #1d4ed8;
        color: white; font-weight: 800; font-size: 15px;
        display: flex; align-items: center; justify-content: center;
        transition: all .25s;
    }
    .misi-item:hover .misi-num { background: #1e3a8a; transform: scale(1.08); }

    /* ── TUJUAN ── */
    .tujuan-card {
        background: white; border-radius: 24px;
        border: 1px solid #e0e7ff; padding: 36px 40px;
        position: relative; overflow: hidden;
        box-shadow: 0 4px 24px rgba(29,78,216,.06);
    }
    .tujuan-card::after {
        content: ''; position: absolute;
        bottom: 0; left: 0; right: 0; height: 4px;
        background: linear-gradient(90deg, #1e3a8a, #1d4ed8, #3b82f6, #D97706);
    }

    /* ── ORANG TUA TOOLS ── */
    .ortu-card {
        background: white; border-radius: 20px;
        border: 1px solid #f1f5f9; padding: 24px 20px;
        text-align: center; text-decoration: none; display: block;
        transition: all .25s; position: relative; overflow: hidden;
    }
    .ortu-card::after {
        content: ''; position: absolute; inset: 0; opacity: 0;
        background: linear-gradient(135deg, rgba(29,78,216,.03) 0%, rgba(29,78,216,.07) 100%);
        transition: opacity .25s;
    }
    .ortu-card:hover { border-color: #bfdbfe; transform: translateY(-4px); box-shadow: 0 16px 40px rgba(29,78,216,.1); }
    .ortu-card:hover::after { opacity: 1; }
    .ortu-icon {
        width: 58px; height: 58px; border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 14px; font-size: 22px;
        transition: transform .25s;
    }
    .ortu-card:hover .ortu-icon { transform: scale(1.1) rotate(-6deg); }

    /* ── NILAI CARD ── */
    .nilai-card {
        background: white; border-radius: 20px; padding: 28px 24px;
        border: 1px solid #f1f5f9; text-align: center;
        transition: all .3s; position: relative;
    }
    .nilai-card:hover { border-color: #bfdbfe; box-shadow: 0 12px 32px rgba(29,78,216,.08); transform: translateY(-3px); }
    .nilai-icon-ring {
        width: 68px; height: 68px; border-radius: 50%; margin: 0 auto 16px;
        display: flex; align-items: center; justify-content: center;
        position: relative; font-size: 26px;
    }
    .nilai-icon-ring::before {
        content: ''; position: absolute; inset: -4px; border-radius: 50%;
        border: 2px dashed; opacity: .25;
        animation: spin-slow 12s linear infinite;
    }
    @keyframes spin-slow { to { transform: rotate(360deg); } }

    /* ── DIVIDER ── */
    .section-divider { height: 1px; background: linear-gradient(90deg, transparent, #e5e7eb 30%, #e5e7eb 70%, transparent); }

    /* ── CTA BAND ── */
    .cta-band {
        background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 50%, #1d4ed8 100%);
        position: relative; overflow: hidden;
    }
    .cta-band::before {
        content: ''; position: absolute; inset: 0; opacity: .04;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 24px 24px;
    }
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════
     PAGE HERO
══════════════════════════════════════ --}}
<div class="page-hero py-20">
    <div class="page-hero-pattern"></div>
    <div class="page-hero-circle" style="width:400px;height:400px;right:-100px;top:-100px;background:radial-gradient(circle,rgba(255,255,255,.06) 0%,transparent 70%);"></div>
    <div class="page-hero-circle" style="width:260px;height:260px;left:10%;bottom:-80px;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);"></div>

    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        {{-- Breadcrumb --}}
        <nav class="flex items-center justify-center gap-2 text-white/50 text-xs mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <a href="#" class="hover:text-white transition-colors">Profil</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Visi &amp; Misi</span>
        </nav>

        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
            <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Halaman Profil Sekolah
        </div>

        <h1 class="font-display text-white font-black leading-tight mb-5" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
            Visi &amp; Misi<br>
            <span style="color:#FDE68A;">SDN Sukorame 1</span>
        </h1>
        <p class="text-white/70 max-w-2xl mx-auto leading-relaxed" style="font-size: 1rem;">
            Arah, tujuan, dan nilai-nilai yang menjadi landasan pendidikan berkualitas
            di SD Negeri Sukorame 1 Kota Kediri.
        </p>

        {{-- Quick nav pills --}}
        <div class="flex flex-wrap items-center justify-center gap-3 mt-8">
            @foreach ([['#visi','fa-eye','Visi'],['#misi','fa-bullseye','Misi'],['#tujuan','fa-star','Tujuan'],['#nilai','fa-heart','Nilai'],['#ortu','fa-users','Info Orang Tua']] as $nav)
            <a href="{{ $nav[0] }}" class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full transition-all">
                <i class="fa {{ $nav[1] }} text-amber-300 text-[10px]"></i> {{ $nav[2] }}
            </a>
            @endforeach
        </div>
    </div>
</div>

<main class="bg-gray-50">

    {{-- ══════════════════════════════════════
         VISI
    ══════════════════════════════════════ --}}
    <section id="visi" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-10">
                <div class="sec-label">Visi Sekolah</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900">Ke Mana Kami Melangkah</h2>
            </div>

            <div class="visi-card">
                {{-- Deco --}}
                <div class="visi-card-deco" style="width:260px;height:260px;right:-60px;top:-60px;background:radial-gradient(circle,rgba(255,255,255,.07) 0%,transparent 65%);"></div>
                <div class="visi-card-deco" style="width:180px;height:180px;left:20%;bottom:-60px;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 65%);"></div>
                <div class="visi-quote">"</div>

                <div class="relative z-10 text-center max-w-2xl mx-auto">
                    <div class="visi-badge">
                        <i class="fa fa-eye text-[10px]"></i> Visi Sekolah
                    </div>
                    <p class="font-display text-white leading-relaxed mb-8" style="font-size: clamp(1.15rem, 2.5vw, 1.5rem); font-weight: 700; font-style: italic;">
                        "Terwujudnya peserta didik yang beriman, bertaqwa, berakhlak mulia, cerdas, terampil, berbudaya, dan berwawasan lingkungan."
                    </p>

                    {{-- Kata kunci visi --}}
                    <div class="flex flex-wrap justify-center gap-2">
                        @foreach (['Beriman & Bertaqwa','Berakhlak Mulia','Cerdas','Terampil','Berbudaya','Berwawasan Lingkungan'] as $kw)
                        <span class="inline-flex items-center gap-1 bg-white/15 border border-white/25 text-white/90 text-xs font-semibold px-3 py-1.5 rounded-full">
                            <i class="fa fa-check text-amber-300 text-[9px]"></i> {{ $kw }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Penjelasan visi --}}
            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-5">
                @php
                    $visi_points = [
                        ['icon'=>'fa-mosque',       'color'=>'blue',   'title'=>'Iman & Taqwa',     'desc'=>'Membentuk pribadi yang kuat secara spiritual, menjunjung nilai-nilai agama dalam setiap aspek kehidupan.'],
                        ['icon'=>'fa-graduation-cap','color'=>'indigo', 'title'=>'Kecerdasan Ilmu',  'desc'=>'Mendorong siswa berkembang secara akademik dan non-akademik dengan pendekatan pembelajaran yang modern.'],
                        ['icon'=>'fa-leaf',          'color'=>'green',  'title'=>'Peduli Lingkungan','desc'=>'Menumbuhkan kesadaran menjaga bumi sejak dini melalui program Adiwiyata dan budaya bersih sekolah.'],
                    ];
                    $vp_c = [
                        'blue'  =>['bg'=>'bg-blue-50',  'ico'=>'text-blue-600',  'ring'=>'border-blue-200'],
                        'indigo'=>['bg'=>'bg-indigo-50','ico'=>'text-indigo-600','ring'=>'border-indigo-200'],
                        'green' =>['bg'=>'bg-green-50', 'ico'=>'text-green-600', 'ring'=>'border-green-200'],
                    ];
                @endphp
                @foreach ($visi_points as $vp)
                @php $vc = $vp_c[$vp['color']]; @endphp
                <div class="bg-white border border-gray-100 rounded-2xl p-6 text-center hover:border-blue-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 {{ $vc['bg'] }} border {{ $vc['ring'] }} rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fa {{ $vp['icon'] }} {{ $vc['ico'] }} text-lg"></i>
                    </div>
                    <p class="font-bold text-gray-900 text-sm mb-2">{{ $vp['title'] }}</p>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $vp['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- ══════════════════════════════════════
         MISI
    ══════════════════════════════════════ --}}
    <section id="misi" class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
                <div>
                    <div class="sec-label">Misi Sekolah</div>
                    <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900">Cara Kami Mewujudkan</h2>
                    <p class="text-gray-500 text-sm mt-2 max-w-lg leading-relaxed">
                        Langkah-langkah konkret yang kami ambil setiap hari untuk mewujudkan visi mulia sekolah.
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <span class="inline-flex items-center gap-2 bg-blue-700 text-white text-xs font-bold px-4 py-2 rounded-xl">
                        <i class="fa fa-list-check"></i> 7 Misi Utama
                    </span>
                </div>
            </div>

            @php
                $misi = [
                    ['icon'=>'fa-chalkboard',     'title'=>'Pembelajaran PAKEM',          'desc'=>'Menyelenggarakan pembelajaran yang Aktif, Kreatif, Efektif, dan Menyenangkan sehingga setiap anak belajar dengan gairah dan bermakna.'],
                    ['icon'=>'fa-trophy',         'title'=>'Budaya Keunggulan',           'desc'=>'Menumbuhkan semangat keunggulan secara intensif kepada seluruh warga sekolah agar selalu berupaya menjadi yang terbaik.'],
                    ['icon'=>'fa-seedling',       'title'=>'Pengembangan Potensi Diri',   'desc'=>'Mendorong dan membantu setiap siswa mengenali bakat dan potensi uniknya agar dapat berkembang secara optimal.'],
                    ['icon'=>'fa-handshake',      'title'=>'Manajemen Partisipatif',      'desc'=>'Menerapkan pola manajemen yang melibatkan seluruh warga sekolah, orang tua, dan masyarakat sebagai mitra aktif.'],
                    ['icon'=>'fa-heart',          'title'=>'Karakter Islami',             'desc'=>'Membangun dan mengembangkan karakter yang berlandaskan nilai-nilai islami, tercermin dalam perilaku dan interaksi sehari-hari.'],
                    ['icon'=>'fa-laptop-code',    'title'=>'Literasi Digital & Teknologi','desc'=>'Memanfaatkan teknologi informasi dan komunikasi sebagai media pembelajaran yang inovatif, relevan, dan menyenangkan.'],
                    ['icon'=>'fa-leaf',           'title'=>'Lingkungan Bersih & Sehat',   'desc'=>'Menciptakan lingkungan sekolah yang bersih, hijau, nyaman, dan ramah anak sebagai wujud tanggung jawab terhadap bumi.'],
                ];
            @endphp

            <div class="space-y-3">
                @foreach ($misi as $i => $m)
                <div class="misi-item">
                    <div class="misi-num">{{ $i + 1 }}</div>
                    <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fa {{ $m['icon'] }} text-blue-500 text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-900 text-sm mb-1">{{ $m['title'] }}</p>
                        <p class="text-gray-500 text-xs leading-relaxed">{{ $m['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- ══════════════════════════════════════
         TUJUAN
    ══════════════════════════════════════ --}}
    <section id="tujuan" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-10">
                <div class="sec-label">Tujuan Sekolah</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900">Apa yang Kami Targetkan</h2>
            </div>

            <div class="tujuan-card">
                <div class="flex items-start gap-5 mb-8">
                    <div class="w-14 h-14 bg-amber-50 border-2 border-amber-200 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-star text-amber-500 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-base mb-1">Tujuan Umum Pendidikan</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Menghasilkan lulusan yang memiliki kompetensi akademik dan non-akademik, beriman dan bertaqwa kepada Tuhan Yang Maha Esa,
                            berakhlak mulia, sehat jasmani dan rohani, serta memiliki kecakapan hidup sebagai bekal untuk melanjutkan pendidikan
                            ke jenjang yang lebih tinggi dan menjadi anggota masyarakat yang bertanggung jawab.
                        </p>
                    </div>
                </div>

                {{-- Target spesifik --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @php
                        $targets = [
                            ['icon'=>'fa-book-open',      'color'=>'blue',   'title'=>'100% Lulus UN/US',               'desc'=>'Seluruh siswa kelas VI lulus ujian sekolah dengan nilai memuaskan.'],
                            ['icon'=>'fa-medal',          'color'=>'amber',  'title'=>'Berprestasi di Lomba',            'desc'=>'Siswa aktif mengikuti dan meraih prestasi di kompetisi lokal hingga nasional.'],
                            ['icon'=>'fa-school',         'color'=>'green',  'title'=>'Diterima di Sekolah Favorit',    'desc'=>'Lulusan dapat melanjutkan ke SMP negeri unggulan pilihan orang tua.'],
                            ['icon'=>'fa-user-check',     'color'=>'indigo', 'title'=>'Berkarakter & Berakhlak',        'desc'=>'Setiap siswa tumbuh menjadi pribadi yang jujur, disiplin, dan santun.'],
                        ];
                        $tc = [
                            'blue'  =>['bg'=>'bg-blue-50',  'ico'=>'text-blue-600',  'bdr'=>'border-blue-100'],
                            'amber' =>['bg'=>'bg-amber-50', 'ico'=>'text-amber-600', 'bdr'=>'border-amber-100'],
                            'green' =>['bg'=>'bg-green-50', 'ico'=>'text-green-600', 'bdr'=>'border-green-100'],
                            'indigo'=>['bg'=>'bg-indigo-50','ico'=>'text-indigo-600','bdr'=>'border-indigo-100'],
                        ];
                    @endphp
                    @foreach ($targets as $t)
                    @php $tcc = $tc[$t['color']]; @endphp
                    <div class="flex items-start gap-4 p-4 {{ $tcc['bg'] }} border {{ $tcc['bdr'] }} rounded-2xl">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa {{ $t['icon'] }} {{ $tcc['ico'] }} text-base"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm mb-1">{{ $t['title'] }}</p>
                            <p class="text-gray-600 text-xs leading-relaxed">{{ $t['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- ══════════════════════════════════════
         NILAI-NILAI SEKOLAH
    ══════════════════════════════════════ --}}
    <section id="nilai" class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <div class="sec-label">Nilai Inti</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Nilai-Nilai yang Kami Pegang</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto leading-relaxed">
                    Prinsip-prinsip yang menjadi fondasi budaya sekolah dan tercermin dalam perilaku seluruh warga SDN Sukorame 1.
                </p>
            </div>

            @php
                $nilai = [
                    ['icon'=>'fa-praying-hands', 'ring'=>'#1d4ed8', 'bg'=>'bg-blue-50',   'ico'=>'text-blue-600',   'title'=>'Religius',      'desc'=>'Mengedepankan nilai spiritual dalam setiap kegiatan'],
                    ['icon'=>'fa-shield-alt',    'ring'=>'#7c3aed', 'bg'=>'bg-purple-50',  'ico'=>'text-purple-600', 'title'=>'Integritas',    'desc'=>'Jujur, amanah, dan bertanggung jawab'],
                    ['icon'=>'fa-users',         'ring'=>'#059669', 'bg'=>'bg-emerald-50', 'ico'=>'text-emerald-600','title'=>'Kolaboratif',   'desc'=>'Bekerja sama dan saling menghargai perbedaan'],
                    ['icon'=>'fa-lightbulb',     'ring'=>'#d97706', 'bg'=>'bg-amber-50',   'ico'=>'text-amber-600',  'title'=>'Inovatif',      'desc'=>'Terbuka pada ide baru dan terus berkembang'],
                    ['icon'=>'fa-hand-holding-heart','ring'=>'#db2777','bg'=>'bg-pink-50','ico'=>'text-pink-600',   'title'=>'Peduli',        'desc'=>'Empati terhadap sesama dan lingkungan sekitar'],
                    ['icon'=>'fa-star',          'ring'=>'#0891b2', 'bg'=>'bg-cyan-50',    'ico'=>'text-cyan-600',   'title'=>'Berprestasi',   'desc'=>'Pantang menyerah dan selalu berusaha menjadi terbaik'],
                ];
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                @foreach ($nilai as $n)
                <div class="nilai-card">
                    <div class="nilai-icon-ring {{ $n['bg'] }}" style="border-color: {{ $n['ring'] }};">
                        <div class="nilai-icon-ring {{ $n['bg'] }}" style="width:68px;height:68px;border-color:{{ $n['ring'] }};"></div>
                        <i class="fa {{ $n['icon'] }} {{ $n['ico'] }} text-2xl relative z-10" style="position:absolute;"></i>
                    </div>
                    <p class="font-bold text-gray-900 text-sm mb-1 mt-2">{{ $n['title'] }}</p>
                    <p class="text-gray-400 text-xs leading-snug">{{ $n['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</main>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── FAQ Accordion ──
    window.toggleFaq = function(btn) {
        const item   = btn.closest('.faq-item');
        const body   = item.querySelector('.faq-body');
        const icon   = btn.querySelector('.faq-chevron');
        const isOpen = !body.classList.contains('hidden');

        // Tutup semua
        document.querySelectorAll('.faq-item').forEach(el => {
            el.querySelector('.faq-body').classList.add('hidden');
            el.querySelector('.faq-chevron').style.transform = '';
            el.classList.remove('border-blue-200', 'bg-blue-50/50');
            el.classList.add('border-gray-100', 'bg-gray-50');
        });

        // Buka yang diklik (kalau belum open)
        if (!isOpen) {
            body.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
            item.classList.remove('border-gray-100', 'bg-gray-50');
            item.classList.add('border-blue-200', 'bg-blue-50/50');
        }
    };

    // ── Smooth scroll untuk quick nav ──
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ── Animasi misi item masuk saat scroll ──
    if ('IntersectionObserver' in window) {
        const items = document.querySelectorAll('.misi-item');
        const obs = new IntersectionObserver(entries => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateX(0)';
                    }, i * 60);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        items.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateX(-16px)';
            el.style.transition = 'opacity .4s ease, transform .4s ease';
            obs.observe(el);
        });
    }

});
</script>
@endpush