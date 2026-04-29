@extends('layouts.guru')
@section('title', 'Penilaian Tugas')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Penilaian Tugas</h1>
        <p class="page-subtitle">{{ $tugas->judul }} &nbsp;·&nbsp; {{ $tugas->kelas->nama_kelas ?? '-' }}</p>
    </div>
    <a href="{{ route('guru.tugas.index') }}" class="btn" style="background:var(--bg);color:var(--text-secondary);border:1px solid var(--border);">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

@php
    $sudahKumpul  = $pengumpulan->count();
    $belumKumpul  = $siswaKelas->count() - $sudahKumpul;
    $sudahDinilai = $pengumpulan->whereNotNull('nilai')->count();
@endphp

<div class="stats-grid" style="grid-template-columns:repeat(4,1fr);">
    <div class="stat-card stat-blue">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div><span class="stat-number">{{ $siswaKelas->count() }}</span><span class="stat-label">Total Siswa</span></div>
    </div>
    <div class="stat-card stat-green">
        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
        <div><span class="stat-number">{{ $sudahKumpul }}</span><span class="stat-label">Sudah Kumpul</span></div>
    </div>
    <div class="stat-card stat-orange">
        <div class="stat-icon"><i class="fas fa-clock"></i></div>
        <div><span class="stat-number">{{ $belumKumpul }}</span><span class="stat-label">Belum Kumpul</span></div>
    </div>
    <div class="stat-card stat-purple">
        <div class="stat-icon"><i class="fas fa-star"></i></div>
        <div><span class="stat-number">{{ $sudahDinilai }}</span><span class="stat-label">Sudah Dinilai</span></div>
    </div>
</div>

<form action="{{ route('guru.tugas.simpan-nilai', $tugas) }}" method="POST">
    @csrf
    <div class="content-card">
        <div class="card-header">
            <h3><i class="fas fa-star" style="color:var(--orange);margin-right:8px;"></i>Daftar Pengumpulan Siswa</h3>
            @if($pengumpulan->count() > 0)
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan Semua Nilai</button>
            @endif
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="30">#</th>
                        <th>Nama Siswa</th>
                        <th>Status Kumpul</th>
                        <th>Waktu</th>
                        <th>File</th>
                        <th>Nilai (0–100)</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswaKelas as $i => $siswa)
                    @php $kumpul = $pengumpulan[$siswa->id] ?? null; @endphp
                    <tr>
                        <td style="color:var(--text-muted);">{{ $i + 1 }}</td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar">{{ strtoupper(substr($siswa->nama_lengkap,0,1)) }}</div>
                                <span style="font-weight:600;">{{ $siswa->nama_lengkap }}</span>
                            </div>
                        </td>
                        <td>
                            @if($kumpul)
                                @php $sc = ['tepat_waktu'=>'badge-green','terlambat'=>'badge-light','belum'=>'badge-light'][$kumpul->status] ?? 'badge-light'; @endphp
                                <span class="badge {{ $sc }}">{{ str_replace('_',' ', ucfirst($kumpul->status)) }}</span>
                            @else
                                <span class="badge badge-light" style="color:var(--danger);">Belum kumpul</span>
                            @endif
                        </td>
                        <td style="font-size:12px;color:var(--text-muted);">
                            {{ $kumpul?->dikumpulkan_at?->format('d/m/Y H:i') ?? '-' }}
                        </td>
                        <td>
                            @if($kumpul?->file)
                                <a href="{{ asset('storage/'.$kumpul->file) }}" target="_blank" class="btn btn-sm" style="background:var(--primary-light);color:var(--primary);">
                                    <i class="fas fa-download"></i> Unduh
                                </a>
                            @else
                                <span style="color:var(--text-muted);">-</span>
                            @endif
                        </td>
                        <td>
                            @if($kumpul)
                            <input type="number" name="nilai[{{ $siswa->id }}]" value="{{ $kumpul->nilai }}"
                                   min="0" max="100" class="form-control" style="width:80px;padding:6px 10px;">
                            @else
                                <span style="color:var(--text-muted);">-</span>
                            @endif
                        </td>
                        <td>
                            @if($kumpul)
                            <input type="text" name="feedback[{{ $siswa->id }}]" value="{{ $kumpul->feedback }}"
                                   class="form-control" style="min-width:160px;" placeholder="Tulis feedback...">
                            @else
                                <span style="color:var(--text-muted);">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>

@endsection
