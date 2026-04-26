@extends('layouts.public')

@section('title', $pageTitle ?? 'SD Negeri Sukorame 1 Kediri')

@push('head')
<style>
    /* ── HERO SLIDER ── */
    .slider-outer { position: relative; overflow: hidden; background: #7f1d1d; }
    .slides-track { display: flex; transition: transform .65s cubic-bezier(.77,0,.175,1); will-change: transform; }
    .slide-item { min-width: 100%; position: relative; height: 460px; }
    .slide-item img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .slide-item .slide-bg { width: 100%; height: 100%; }
    .slide-overlay { position: absolute; inset: 0; background: linear-gradient(100deg, rgba(100,0,0,.82) 0%, rgba(100,0,0,.5) 50%, rgba(0,0,0,.25) 100%); }
    .slide-text { position: absolute; inset: 0; display: flex; align-items: center; z-index: 2; }
    .slider-btn { position: absolute; top: 50%; transform: translateY(-50%); z-index: 5;
        width: 44px; height: 44px; border-radius: 50%; border: 2px solid rgba(255,255,255,.5);
        background: rgba(255,255,255,.15); backdrop-filter: blur(4px);
        color: white; display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: background .2s; }
    .slider-btn:hover { background: rgba(255,255,255,.3); }
    .slider-dots { position: absolute; bottom: 18px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 5; }
    .sdot { width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,.4); cursor: pointer; transition: all .2s; border: none; }
    .sdot.active { background: #fff; width: 22px; border-radius: 4px; }

    /* Keunggulan icon animate */
    .keung-icon { transition: transform .3s; }
    .hover-lift:hover .keung-icon { transform: scale(1.15) rotate(-5deg); }

    /* Berita thumbnail */
    .news-thumb { height: 180px; object-fit: cover; width: 100%; }

    /* Profil Guru card */
    .guru-avatar { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; }
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════
     HERO SLIDER
═══════════════════════════════════════════ --}}
<div class="slider-outer">
    <div class="slides-track" id="slidesTrack">

        {{-- Slide 1 --}}
        <div class="slide-item">
            <div class="slide-bg" style="background: linear-gradient(135deg, #7f1d1d 0%, #b91c1c 50%, #991b1b 100%);"></div>
            <div class="slide-overlay"></div>
            <div class="slide-text">
                <div class="max-w-7xl mx-auto px-8 w-full">
                    <span class="inline-block bg-white/20 border border-white/30 text-white text-xs font-bold px-4 py-1.5 rounded-full mb-4">
                        ⭐ Sekolah Unggulan Kota Kediri
                    </span>
                    <h1 class="text-4xl md:text-5xl font-black text-white leading-tight mb-4">
                        Selamat Datang di<br>
                        <span class="text-yellow-300">SDN Sukorame 1</span>
                    </h1>
                    <p class="text-white/85 text-base md:text-lg max-w-lg mb-7 leading-relaxed">
                        Membentuk generasi cerdas, berkarakter, dan berprestasi berlandaskan iman &amp; teknologi.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="#profil" class="bg-white text-red-700 font-bold px-6 py-3 rounded-xl hover:bg-yellow-50 transition-colors shadow-lg text-sm">
                            <i class="fa fa-info-circle mr-2"></i>Profil Sekolah
                        </a>
                        <a href="{{ route('login') }}" class="border-2 border-white/60 text-white font-bold px-6 py-3 rounded-xl hover:bg-white/15 transition-colors text-sm">
                            <i class="fa fa-graduation-cap mr-2"></i>Masuk E-Learning
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Slide 2 --}}
        <div class="slide-item">
            <div class="slide-bg" style="background: linear-gradient(135deg, #1e3a5f 0%, #1e40af 50%, #1d4ed8 100%);"></div>
            <div class="slide-overlay" style="background: linear-gradient(100deg, rgba(10,30,80,.85) 0%, rgba(10,30,80,.45) 100%);"></div>
            <div class="slide-text">
                <div class="max-w-7xl mx-auto px-8 w-full">
                    <span class="inline-block bg-white/20 border border-white/30 text-white text-xs font-bold px-4 py-1.5 rounded-full mb-4">
                        📚 E-Learning SIMAS
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-white leading-tight mb-4">
                        Belajar Lebih Mudah<br>
                        <span class="text-cyan-300">dengan SIMAS</span>
                    </h2>
                    <p class="text-white/85 text-base md:text-lg max-w-lg mb-7 leading-relaxed">
                        Akses materi, nilai, absensi, dan raport digital kapanpun &amp; dimanapun.
                    </p>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-6 py-3 rounded-xl hover:bg-blue-50 transition-colors shadow-lg text-sm">
                        <i class="fa fa-laptop"></i>Masuk Sekarang
                    </a>
                </div>
            </div>
        </div>

        {{-- Slide 3 --}}
        <div class="slide-item">
            <div class="slide-bg" style="background: linear-gradient(135deg, #14532d 0%, #15803d 50%, #16a34a 100%);"></div>
            <div class="slide-overlay" style="background: linear-gradient(100deg, rgba(5,50,20,.85) 0%, rgba(5,50,20,.45) 100%);"></div>
            <div class="slide-text">
                <div class="max-w-7xl mx-auto px-8 w-full">
                    <span class="inline-block bg-white/20 border border-white/30 text-white text-xs font-bold px-4 py-1.5 rounded-full mb-4">
                        🎓 PPDB 2025/2026
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-white leading-tight mb-4">
                        Penerimaan Peserta<br>
                        <span class="text-yellow-300">Didik Baru</span>
                    </h2>
                    <p class="text-white/85 text-base md:text-lg max-w-lg mb-7 leading-relaxed">
                        Daftarkan putra-putri Anda sekarang. Kuota terbatas, segera bergabung bersama kami!
                    </p>
                    <a href="#" class="inline-flex items-center gap-2 bg-white text-green-700 font-bold px-6 py-3 rounded-xl hover:bg-green-50 transition-colors shadow-lg text-sm">
                        <i class="fa fa-user-plus"></i>Info PPDB
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- Slider Controls --}}
    <button class="slider-btn" style="left:16px" onclick="slideBy(-1)"><i class="fa fa-chevron-left text-sm"></i></button>
    <button class="slider-btn" style="right:16px" onclick="slideBy(1)"><i class="fa fa-chevron-right text-sm"></i></button>
    <div class="slider-dots" id="sliderDots">
        <button class="sdot active" onclick="goSlide(0)"></button>
        <button class="sdot" onclick="goSlide(1)"></button>
        <button class="sdot" onclick="goSlide(2)"></button>
    </div>
</div>

{{-- ═══════════════════════════════════════════
     STATISTIK
═══════════════════════════════════════════ --}}
<section id="stats-section" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4">
            @php
                $stats_list = [
                    ['icon'=>'fa-users',               'label'=>'Total Siswa',     'key'=>'siswa',  'color'=>'red'],
                    ['icon'=>'fa-chalkboard-teacher',  'label'=>'Tenaga Pendidik', 'key'=>'guru',   'color'=>'blue'],
                    ['icon'=>'fa-door-open',           'label'=>'Rombel / Kelas',  'key'=>'kelas',  'color'=>'green'],
                    ['icon'=>'fa-book-open',           'label'=>'Mata Pelajaran',  'key'=>'mapel',  'color'=>'amber'],
                ];
                $sc = ['red'=>['bg'=>'bg-red-50','text'=>'text-red-700','ico'=>'text-red-500'],
                       'blue'=>['bg'=>'bg-blue-50','text'=>'text-blue-700','ico'=>'text-blue-500'],
                       'green'=>['bg'=>'bg-green-50','text'=>'text-green-700','ico'=>'text-green-500'],
                       'amber'=>['bg'=>'bg-amber-50','text'=>'text-amber-700','ico'=>'text-amber-500']];
            @endphp
            @foreach ($stats_list as $i => $s)
            @php $c = $sc[$s['color']]; @endphp
            <div class="flex items-center gap-4 p-7 {{ $i < 3 ? 'border-b md:border-b-0 md:border-r' : '' }} border-gray-100">
                <div class="w-14 h-14 {{ $c['bg'] }} rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fa {{ $s['icon'] }} {{ $c['ico'] }} text-2xl"></i>
                </div>
                <div>
                    <p class="text-3xl font-black {{ $c['text'] }}" data-count="{{ $stats[$s['key']] }}">{{ $stats[$s['key']] }}</p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">{{ $s['label'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     MENGAPA MEMILIH
═══════════════════════════════════════════ --}}
<section id="profil" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <span class="badge-section">Keunggulan Kami</span>
            <h2 class="text-2xl md:text-3xl font-black text-gray-800">Mengapa Memilih SDN Sukorame 1?</h2>
            <p class="text-gray-500 mt-3 text-sm max-w-xl mx-auto leading-relaxed">
                Sekolah unggulan dengan moto: <em>santun dalam berperilaku, hebat dalam prestasi</em>
            </p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">
            @php
                $keungs = [
                    ['icon'=>'fa-award',       'title'=>'Sekolah Unggulan',       'color'=>'red'],
                    ['icon'=>'fa-user-tie',    'title'=>'Pendidik Berkualitas',    'color'=>'blue'],
                    ['icon'=>'fa-shield-alt',  'title'=>'Sekolah Berintegritas',   'color'=>'purple'],
                    ['icon'=>'fa-trophy',      'title'=>'Siswa Berprestasi',       'color'=>'amber'],
                    ['icon'=>'fa-heart',       'title'=>'Sekolah Berkarakter',     'color'=>'pink'],
                    ['icon'=>'fa-building',    'title'=>'Fasilitas Lengkap',       'color'=>'teal'],
                ];
                $kc = ['red'=>['bg'=>'bg-red-50','ico'=>'text-red-600'],
                       'blue'=>['bg'=>'bg-blue-50','ico'=>'text-blue-600'],
                       'purple'=>['bg'=>'bg-purple-50','ico'=>'text-purple-600'],
                       'amber'=>['bg'=>'bg-amber-50','ico'=>'text-amber-600'],
                       'pink'=>['bg'=>'bg-pink-50','ico'=>'text-pink-600'],
                       'teal'=>['bg'=>'bg-teal-50','ico'=>'text-teal-600']];
            @endphp
            @foreach ($keungs as $k)
            @php $kcc = $kc[$k['color']]; @endphp
            <div class="hover-lift bg-white rounded-2xl p-5 text-center border border-gray-100 cursor-default">
                <div class="w-14 h-14 {{ $kcc['bg'] }} rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <i class="fa {{ $k['icon'] }} {{ $kcc['ico'] }} text-2xl keung-icon"></i>
                </div>
                <p class="font-bold text-gray-800 text-xs leading-snug">{{ $k['title'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     SAMBUTAN KEPALA SEKOLAH
═══════════════════════════════════════════ --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-12 items-center">
            <div class="flex-shrink-0 text-center">
                <div class="w-48 h-56 rounded-2xl bg-gray-100 border-4 border-red-100 overflow-hidden mx-auto shadow-lg flex items-center justify-center">
                    {{-- Ganti dengan: <img src="{{ asset('images/kepsek.jpg') }}" class="w-full h-full object-cover"> --}}
                    <i class="fa fa-user-tie text-gray-300 text-7xl"></i>
                </div>
                <div class="mt-3">
                    <p class="font-bold text-gray-800 text-sm">{{ $sekolah?->kepala_sekolah ?? 'Nama Kepala Sekolah' }}</p>
                    <p class="text-xs text-gray-500">Kepala Sekolah SDN Sukorame 1</p>
                    <span class="inline-block mt-2 bg-red-50 text-red-700 text-xs font-semibold px-3 py-1 rounded-full border border-red-200">NIP. {{ $sekolah?->nip_kepsek ?? '—' }}</span>
                </div>
            </div>
            <div class="flex-1">
                <span class="badge-section">Sambutan</span>
                <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-4">Sambutan Kepala Sekolah</h2>
                <div class="text-gray-600 text-sm leading-relaxed space-y-3">
                    <p>Assalamu'alaikum Wr. Wb. Puji syukur kehadirat Allah SWT atas segala limpahan rahmat dan karunia-Nya. Selamat datang di website resmi <strong>SD Negeri Sukorame 1 Kota Kediri</strong>.</p>
                    <p>Kami berkomitmen untuk memberikan pelayanan pendidikan terbaik dengan menghadirkan platform <strong>SIMAS</strong> — Sistem Informasi Sekolah yang memudahkan orang tua memantau perkembangan akademik putra-putri secara real-time, mulai dari nilai, absensi, materi pembelajaran, hingga raport digital.</p>
                    <p>Semoga website ini bermanfaat bagi seluruh warga sekolah. Bersama kita wujudkan generasi cerdas, berkarakter, dan berprestasi.</p>
                </div>
                <div class="mt-6 flex gap-4">
                    <a href="#kontak" class="inline-flex items-center gap-2 bg-red-700 hover:bg-red-800 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition-colors">
                        <i class="fa fa-envelope text-xs"></i>Hubungi Kami
                    </a>
                    <a href="#" class="inline-flex items-center gap-2 border border-red-300 text-red-700 font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-red-50 transition-colors">
                        Profil Sekolah <i class="fa fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     INFORMASI SEKOLAH (dari tabel sekolah)
═══════════════════════════════════════════ --}}
<section class="py-14 bg-red-700 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-64 h-64 border-4 border-white rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-40 h-40 border-4 border-white rounded-full translate-y-1/2 -translate-x-1/2"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $infoItems = [
                    ['icon'=>'fa-school',      'label'=>'Nama Sekolah',   'value'=> $sekolah?->nama ?? 'SD Negeri Sukorame 1'],
                    ['icon'=>'fa-barcode',     'label'=>'NPSN',           'value'=> $sekolah?->npsn ?? '20533972'],
                    ['icon'=>'fa-map-marker-alt','label'=>'Alamat',       'value'=> $sekolah?->alamat ?? 'Jl. Sukorame No. 1, Kediri'],
                    ['icon'=>'fa-star',        'label'=>'Akreditasi',     'value'=> $sekolah?->akreditasi ?? 'A (Sangat Baik)'],
                    ['icon'=>'fa-book',        'label'=>'Kurikulum',      'value'=> $sekolah?->kurikulum ?? 'Kurikulum Merdeka'],
                    ['icon'=>'fa-flag',        'label'=>'Status',         'value'=> $sekolah?->status ?? 'Negeri'],
                    ['icon'=>'fa-phone',       'label'=>'Telepon',        'value'=> $sekolah?->telepon ?? '(0354) 123456'],
                    ['icon'=>'fa-envelope',    'label'=>'Email',          'value'=> $sekolah?->email ?? 'sdn.sukorame1@kediri.go.id'],
                ];
            @endphp
            @foreach ($infoItems as $info)
            <div class="bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl p-4 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fa {{ $info['icon'] }} text-yellow-300"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-white/60 text-xs">{{ $info['label'] }}</p>
                        <p class="font-bold text-sm truncate" title="{{ $info['value'] }}">{{ $info['value'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     BERITA & PENGUMUMAN
═══════════════════════════════════════════ --}}
<section id="berita" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-end justify-between mb-10">
            <div>
                <span class="badge-section">Informasi Terkini</span>
                <h2 class="text-2xl md:text-3xl font-black text-gray-800">Berita &amp; Pengumuman</h2>
            </div>
            {{-- <a href="#" class="text-red-700 font-semibold text-sm hover:underline">Lihat Semua →</a> --}}
        </div>

        @if ($pengumuman->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($pengumuman as $idx => $p)
            <div class="hover-lift bg-white rounded-2xl overflow-hidden border border-gray-100 {{ $idx === 0 ? 'md:row-span-1' : '' }}">
                <div class="h-44 bg-gradient-to-br {{ $idx === 0 ? 'from-red-100 to-red-200' : ($idx === 1 ? 'from-blue-100 to-blue-200' : 'from-green-100 to-green-200') }} flex items-center justify-center">
                    <i class="fa fa-newspaper text-5xl {{ $idx === 0 ? 'text-red-300' : ($idx === 1 ? 'text-blue-300' : 'text-green-300') }}"></i>
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $idx === 0 ? 'bg-red-50 text-red-700' : ($idx === 1 ? 'bg-blue-50 text-blue-700' : 'bg-green-50 text-green-700') }}">
                            {{ ucfirst($p->kategori ?? 'Pengumuman') }}
                        </span>
                        <span class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($p->created_at)->locale('id')->isoFormat('D MMM Y') }}
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm leading-snug line-clamp-2 mb-2">{{ $p->judul }}</h3>
                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($p->isi ?? $p->konten ?? ''), 120) }}
                    </p>
                    <a href="#" class="inline-flex items-center gap-1 text-red-700 text-xs font-semibold mt-3 hover:underline">
                        Selengkapnya <i class="fa fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-gray-200">
            <i class="fa fa-newspaper text-gray-200 text-5xl mb-3 block"></i>
            <p class="text-gray-400 text-sm">Belum ada pengumuman terbaru.</p>
        </div>
        @endif
    </div>
</section>

{{-- ═══════════════════════════════════════════
     AGENDA KEGIATAN
═══════════════════════════════════════════ --}}
<section id="agenda" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-12">
            {{-- Agenda --}}
            <div class="flex-1">
                <span class="badge-section">Jadwal</span>
                <h2 class="text-2xl font-black text-gray-800 mb-7">Agenda Kegiatan</h2>
                <div class="space-y-3">
                    @php
                        $agendas = [
                            ['tgl'=>'28','bln'=>'Apr','title'=>'Upacara Hari Pendidikan Nasional','waktu'=>'07.00 WIB','tempat'=>'Lapangan Sekolah','color'=>'red'],
                            ['tgl'=>'02','bln'=>'Mei','title'=>'Penilaian Akhir Tahun (PAT) Kelas 1-5','waktu'=>'07.30 WIB','tempat'=>'Ruang Kelas','color'=>'blue'],
                            ['tgl'=>'15','bln'=>'Mei','title'=>'Pembagian Raport Semester Genap','waktu'=>'08.00 WIB','tempat'=>'Ruang Kelas','color'=>'green'],
                            ['tgl'=>'20','bln'=>'Mei','title'=>'Perpisahan Kelas 6 TA 2024/2025','waktu'=>'09.00 WIB','tempat'=>'Aula Sekolah','color'=>'amber'],
                            ['tgl'=>'01','bln'=>'Jun','title'=>'Libur Akhir Tahun Ajaran 2024/2025','waktu'=>'Seharian','tempat'=>'-','color'=>'purple'],
                            ['tgl'=>'14','bln'=>'Jul','title'=>'Penerimaan Peserta Didik Baru (PPDB)','waktu'=>'08.00 WIB','tempat'=>'Kantor Sekolah','color'=>'teal'],
                        ];
                        $agc = ['red'=>'bg-red-100 text-red-700','blue'=>'bg-blue-100 text-blue-700',
                                'green'=>'bg-green-100 text-green-700','amber'=>'bg-amber-100 text-amber-700',
                                'purple'=>'bg-purple-100 text-purple-700','teal'=>'bg-teal-100 text-teal-700'];
                    @endphp
                    @foreach ($agendas as $ag)
                    <div class="flex items-start gap-4 p-4 bg-gray-50 hover:bg-red-50 rounded-xl border border-gray-100 hover:border-red-100 transition-colors cursor-default">
                        <div class="flex-shrink-0 w-14 text-center {{ $agc[$ag['color']] }} rounded-xl py-2">
                            <p class="text-xl font-black leading-none">{{ $ag['tgl'] }}</p>
                            <p class="text-xs font-bold uppercase">{{ $ag['bln'] }}</p>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-gray-800 text-sm line-clamp-2">{{ $ag['title'] }}</p>
                            <div class="flex flex-wrap gap-3 text-xs text-gray-500 mt-1">
                                <span><i class="fa fa-clock mr-1"></i>{{ $ag['waktu'] }}</span>
                                <span><i class="fa fa-map-marker-alt mr-1"></i>{{ $ag['tempat'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- SIMAS Login Card --}}
            <div class="flex-shrink-0 w-full lg:w-80">
                <div class="bg-red-700 rounded-2xl p-6 text-white sticky top-20">
                    <div class="text-center mb-5">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <i class="fa fa-graduation-cap text-yellow-300 text-3xl"></i>
                        </div>
                        <h3 class="font-black text-lg">Login SIMAS</h3>
                        <p class="text-white/75 text-xs mt-1">Pilih peran Anda</p>
                    </div>
                    <div class="space-y-3">
                        @php
                            $roles = [
                                ['icon'=>'fa-user-graduate','label'=>'Siswa',      'desc'=>'Lihat materi, tugas, nilai'],
                                ['icon'=>'fa-chalkboard-teacher','label'=>'Guru',  'desc'=>'Input nilai, absensi, materi'],
                                ['icon'=>'fa-user-shield','label'=>'Admin',        'desc'=>'Kelola data sekolah'],
                                ['icon'=>'fa-users','label'=>'Orang Tua',          'desc'=>'Pantau perkembangan anak'],
                            ];
                        @endphp
                        @foreach ($roles as $role)
                        <a href="{{ route('login') }}"
                           class="flex items-center gap-3 bg-white/10 hover:bg-white/25 border border-white/20 rounded-xl px-4 py-3 transition-all">
                            <i class="fa {{ $role['icon'] }} text-yellow-300 text-lg w-5 text-center"></i>
                            <div>
                                <p class="font-bold text-sm">{{ $role['label'] }}</p>
                                <p class="text-white/65 text-xs">{{ $role['desc'] }}</p>
                            </div>
                            <i class="fa fa-chevron-right text-xs opacity-50 ml-auto"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     PROGRAM UNGGULAN
═══════════════════════════════════════════ --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <span class="badge-section">Program Sekolah</span>
            <h2 class="text-2xl md:text-3xl font-black text-gray-800">Program Unggulan</h2>
            <p class="text-gray-500 text-sm mt-2 max-w-lg mx-auto">Berbagai program untuk mengembangkan potensi siswa secara holistik</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
            @php
                $progs = [
                    ['icon'=>'fa-pray',         'title'=>'Tahfidz & Imtaq',     'desc'=>'Pembentukan karakter islami', 'color'=>'red'],
                    ['icon'=>'fa-palette',       'title'=>'Seni & Budaya',       'desc'=>'Ekspresi kreativitas siswa',  'color'=>'pink'],
                    ['icon'=>'fa-futbol',        'title'=>'Olahraga Prestasi',   'desc'=>'Kompetisi lokal & nasional',  'color'=>'green'],
                    ['icon'=>'fa-laptop',        'title'=>'Literasi Digital',    'desc'=>'E-learning & teknologi',      'color'=>'blue'],
                    ['icon'=>'fa-seedling',      'title'=>'Adiwiyata',           'desc'=>'Lingkungan hijau & bersih',   'color'=>'teal'],
                    ['icon'=>'fa-language',      'title'=>'Bahasa Inggris',      'desc'=>'Percakapan & kompetensi',     'color'=>'indigo'],
                    ['icon'=>'fa-flask',         'title'=>'Sains & Matematika',  'desc'=>'Olimpiade & riset dasar',     'color'=>'amber'],
                    ['icon'=>'fa-hands-helping', 'title'=>'Kepramukaan',         'desc'=>'Jiwa kepemimpinan siswa',     'color'=>'orange'],
                ];
                $pc = ['red'=>['bg'=>'bg-red-50','ico'=>'text-red-600','bd'=>'border-red-100'],
                       'pink'=>['bg'=>'bg-pink-50','ico'=>'text-pink-600','bd'=>'border-pink-100'],
                       'green'=>['bg'=>'bg-green-50','ico'=>'text-green-600','bd'=>'border-green-100'],
                       'blue'=>['bg'=>'bg-blue-50','ico'=>'text-blue-600','bd'=>'border-blue-100'],
                       'teal'=>['bg'=>'bg-teal-50','ico'=>'text-teal-600','bd'=>'border-teal-100'],
                       'indigo'=>['bg'=>'bg-indigo-50','ico'=>'text-indigo-600','bd'=>'border-indigo-100'],
                       'amber'=>['bg'=>'bg-amber-50','ico'=>'text-amber-600','bd'=>'border-amber-100'],
                       'orange'=>['bg'=>'bg-orange-50','ico'=>'text-orange-600','bd'=>'border-orange-100']];
            @endphp
            @foreach ($progs as $p)
            @php $pcc = $pc[$p['color']]; @endphp
            <div class="hover-lift bg-white rounded-2xl p-5 border {{ $pcc['bd'] }} text-center">
                <div class="w-14 h-14 {{ $pcc['bg'] }} rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <i class="fa {{ $p['icon'] }} {{ $pcc['ico'] }} text-2xl"></i>
                </div>
                <p class="font-bold text-gray-800 text-sm mb-1">{{ $p['title'] }}</p>
                <p class="text-gray-500 text-xs leading-snug">{{ $p['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     GALERI FOTO
═══════════════════════════════════════════ --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-end justify-between mb-8">
            <div>
                <span class="badge-section">Galeri</span>
                <h2 class="text-2xl font-black text-gray-800">Galeri Sekolah</h2>
            </div>
            <a href="#" class="text-red-700 font-semibold text-sm hover:underline">Lihat Semua →</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @php
                $colors = [
                    'from-red-100 to-red-200 text-red-400',
                    'from-blue-100 to-blue-200 text-blue-400',
                    'from-green-100 to-green-200 text-green-400',
                    'from-amber-100 to-amber-200 text-amber-400',
                    'from-purple-100 to-purple-200 text-purple-400',
                    'from-pink-100 to-pink-200 text-pink-400',
                    'from-teal-100 to-teal-200 text-teal-400',
                    'from-indigo-100 to-indigo-200 text-indigo-400',
                ];
            @endphp
            @foreach ($colors as $i => $cls)
            @php [$bg, $tc] = [implode(' ', array_slice(explode(' ', $cls), 0, 2)), last(explode(' ', $cls))]; @endphp
            <div class="hover-lift aspect-square bg-gradient-to-br {{ $bg }} rounded-2xl flex flex-col items-center justify-center cursor-pointer relative overflow-hidden group">
                <i class="fa fa-image {{ $tc }} text-4xl group-hover:scale-110 transition-transform duration-300"></i>
                <p class="text-xs {{ $tc }} font-semibold mt-2 opacity-70">Foto {{ $i + 1 }}</p>
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300 flex items-center justify-center">
                    <i class="fa fa-expand text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-lg"></i>
                </div>
            </div>
            @endforeach
        </div>
        <p class="text-center text-xs text-gray-400 mt-4 italic">
            * Ganti placeholder dengan foto asli menggunakan tag &lt;img&gt; dan storage Laravel.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     LAYANAN SEKOLAH
═══════════════════════════════════════════ --}}
<section class="py-16 bg-gray-50" id="layanan">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <span class="badge-section">Layanan</span>
            <h2 class="text-2xl md:text-3xl font-black text-gray-800">Layanan Sekolah</h2>
            <p class="text-gray-500 text-sm mt-2">Berbagai layanan administratif yang tersedia secara online</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @php
                $layanan = [
                    ['icon'=>'fa-exchange-alt','label'=>'Mutasi Siswa',        'color'=>'red'],
                    ['icon'=>'fa-file-alt',    'label'=>'Surat Keterangan',    'color'=>'blue'],
                    ['icon'=>'fa-id-card',     'label'=>'Cek / Cetak NISN',   'color'=>'green'],
                    ['icon'=>'fa-graduation-cap','label'=>'Beasiswa PIP',      'color'=>'amber'],
                    ['icon'=>'fa-download',    'label'=>'Unduhan Dokumen',     'color'=>'purple'],
                    ['icon'=>'fa-users',       'label'=>'Penjaringan Alumni',  'color'=>'teal'],
                ];
            @endphp
            @foreach ($layanan as $l)
            @php $lcc = ['red'=>['bg'=>'bg-red-50','ico'=>'text-red-600'],
                         'blue'=>['bg'=>'bg-blue-50','ico'=>'text-blue-600'],
                         'green'=>['bg'=>'bg-green-50','ico'=>'text-green-600'],
                         'amber'=>['bg'=>'bg-amber-50','ico'=>'text-amber-600'],
                         'purple'=>['bg'=>'bg-purple-50','ico'=>'text-purple-600'],
                         'teal'=>['bg'=>'bg-teal-50','ico'=>'text-teal-600']][$l['color']]; @endphp
            <a href="#" class="hover-lift bg-white rounded-2xl p-5 text-center border border-gray-100 hover:border-red-100 group">
                <div class="w-12 h-12 {{ $lcc['bg'] }} rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fa {{ $l['icon'] }} {{ $lcc['ico'] }} text-xl"></i>
                </div>
                <p class="font-bold text-gray-800 text-xs leading-snug">{{ $l['label'] }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // ── HERO SLIDER ──
    let currentSlide = 0;
    const totalSlides = 3;
    const track = document.getElementById('slidesTrack');
    const dots = document.querySelectorAll('.sdot');

    function goSlide(n) {
        currentSlide = (n + totalSlides) % totalSlides;
        track.style.transform = `translateX(-${currentSlide * 100}%)`;
        dots.forEach((d, i) => d.classList.toggle('active', i === currentSlide));
    }
    function slideBy(dir) { goSlide(currentSlide + dir); }

    // Auto slide setiap 5 detik
    setInterval(() => slideBy(1), 5000);
</script>
@endpush