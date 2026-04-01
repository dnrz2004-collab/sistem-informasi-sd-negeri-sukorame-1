<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo">
            <i class="fas fa-school"></i>
        </div>
        <div class="brand-text">
            <span class="brand-name">SDN Sukorame 1</span>
            <span class="brand-sub">Kediri</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        @php $role = auth()->user()->role; @endphp

        @if($role === 'admin')
            <div class="nav-section-title">Menu Admin</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.sekolah') }}" class="nav-item {{ request()->routeIs('admin.sekolah*') ? 'active' : '' }}">
                <i class="fas fa-building-columns"></i> <span>Data Sekolah</span>
            </a>
            <a href="{{ route('admin.kelas.index') }}" class="nav-item {{ request()->routeIs('admin.kelas*') ? 'active' : '' }}">
                <i class="fas fa-door-open"></i> <span>Kelas & Rombel</span>
            </a>
            <a href="{{ route('admin.siswa.index') }}" class="nav-item {{ request()->routeIs('admin.siswa*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate"></i> <span>Data Siswa</span>
            </a>
            <a href="{{ route('admin.guru.index') }}" class="nav-item {{ request()->routeIs('admin.guru*') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i> <span>Data Guru</span>
            </a>
            <a href="{{ route('admin.mata-pelajaran.index') }}" class="nav-item {{ request()->routeIs('admin.mata-pelajaran*') ? 'active' : '' }}">
                <i class="fas fa-book-open"></i> <span>Mata Pelajaran</span>
            </a>
            <a href="{{ route('admin.pengumuman.index') }}" class="nav-item {{ request()->routeIs('admin.pengumuman*') ? 'active' : '' }}">
                <i class="fas fa-bullhorn"></i> <span>Pengumuman</span>
            </a>

        @elseif($role === 'guru')
            <div class="nav-section-title">Menu Guru</div>
            <a href="{{ route('guru.dashboard') }}" class="nav-item {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('guru.absensi.index') }}" class="nav-item">
                <i class="fas fa-clipboard-check"></i> <span>Absensi Siswa</span>
            </a>
            <a href="{{ route('guru.nilai.index') }}" class="nav-item">
                <i class="fas fa-star"></i> <span>Data Nilai</span>
            </a>
            <a href="{{ route('guru.materi.index') }}" class="nav-item">
                <i class="fas fa-laptop-code"></i> <span>E-Learning</span>
            </a>
            <a href="{{ route('guru.mbg') }}" class="nav-item">
                <i class="fas fa-utensils"></i> <span>Program MBG</span>
            </a>

        @elseif($role === 'wali_murid')
            <div class="nav-section-title">Menu Wali Murid</div>
            <a href="{{ route('wali.dashboard') }}" class="nav-item">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('wali.raport') }}" class="nav-item">
                <i class="fas fa-file-alt"></i> <span>E-Raport</span>
            </a>
            <a href="{{ route('wali.kehadiran') }}" class="nav-item">
                <i class="fas fa-calendar-check"></i> <span>Kehadiran</span>
            </a>

        @elseif($role === 'siswa')
            <div class="nav-section-title">Menu Siswa</div>
            <a href="{{ route('siswa.dashboard') }}" class="nav-item">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('siswa.elearning') }}" class="nav-item">
                <i class="fas fa-book"></i> <span>E-Learning</span>
            </a>
            <a href="{{ route('siswa.raport') }}" class="nav-item">
                <i class="fas fa-scroll"></i> <span>Raport</span>
            </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>