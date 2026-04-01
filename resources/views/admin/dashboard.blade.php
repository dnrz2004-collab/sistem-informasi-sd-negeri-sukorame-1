@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard Admin</h1>
    <p class="page-subtitle">Selamat datang, {{ auth()->user()->name }}!</p>
</div>

<div class="stats-grid">
    <div class="stat-card stat-blue">
        <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
        <div class="stat-info">
            <span class="stat-number">{{ $data['total_siswa'] }}</span>
            <span class="stat-label">Total Siswa</span>
        </div>
    </div>
    <div class="stat-card stat-green">
        <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
        <div class="stat-info">
            <span class="stat-number">{{ $data['total_guru'] }}</span>
            <span class="stat-label">Total Guru</span>
        </div>
    </div>
    <div class="stat-card stat-orange">
        <div class="stat-icon"><i class="fas fa-door-open"></i></div>
        <div class="stat-info">
            <span class="stat-number">{{ $data['total_kelas'] }}</span>
            <span class="stat-label">Total Kelas</span>
        </div>
    </div>
    <div class="stat-card stat-purple">
        <div class="stat-icon"><i class="fas fa-bullhorn"></i></div>
        <div class="stat-info">
            <span class="stat-number">{{ $data['pengumuman_terbaru']->count() }}</span>
            <span class="stat-label">Pengumuman Aktif</span>
        </div>
    </div>
</div>

<div class="content-grid">
    <div class="content-card">
        <div class="card-header">
            <h3>Pengumuman Terbaru</h3>
            <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
        <div class="card-body">
            @forelse($data['pengumuman_terbaru'] as $p)
                <div class="announcement-item">
                    <div class="ann-icon"><i class="fas fa-bell"></i></div>
                    <div class="ann-content">
                        <p class="ann-title">{{ $p->judul }}</p>
                        <span class="ann-meta">{{ $p->created_at->diffForHumans() }} · Untuk: {{ $p->untuk }}</span>
                    </div>
                </div>
            @empty
                <p class="empty-state">Belum ada pengumuman.</p>
            @endforelse
        </div>
    </div>

    <div class="content-card">
        <div class="card-header">
            <h3>Aksi Cepat</h3>
        </div>
        <div class="quick-actions">
            <a href="{{ route('admin.siswa.create') }}" class="quick-btn">
                <i class="fas fa-user-plus"></i>
                <span>Tambah Siswa</span>
            </a>
            <a href="{{ route('admin.guru.create') }}" class="quick-btn">
                <i class="fas fa-user-tie"></i>
                <span>Tambah Guru</span>
            </a>
            <a href="{{ route('admin.kelas.create') }}" class="quick-btn">
                <i class="fas fa-plus-square"></i>
                <span>Buat Kelas</span>
            </a>
            <a href="{{ route('admin.pengumuman.create') }}" class="quick-btn">
                <i class="fas fa-bullhorn"></i>
                <span>Pengumuman</span>
            </a>
        </div>
    </div>
</div>
@endsection