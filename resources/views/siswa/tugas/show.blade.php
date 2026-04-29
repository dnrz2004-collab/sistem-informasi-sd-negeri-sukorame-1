@extends('layouts.siswa')
@section('title', $tugas->judul)

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Detail Tugas</h1>
        <p class="page-subtitle"><a href="{{ route('siswa.tugas.index') }}" style="color:var(--primary);">Tugas</a> / {{ Str::limit($tugas->judul, 40) }}</p>
    </div>
    <a href="{{ route('siswa.tugas.index') }}" class="btn" style="background:var(--bg);color:var(--text-secondary);border:1px solid var(--border);">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

{{-- Info Tugas --}}
<div class="content-card" style="margin-bottom:16px;">
    <div class="card-header">
        <div>
            <span class="badge badge-blue" style="margin-bottom:8px;">{{ $tugas->mataPelajaran->nama ?? '-' }}</span>
            <h3 style="font-size:18px;margin-top:4px;">{{ $tugas->judul }}</h3>
        </div>
        @if($tugas->deadline)
        <div style="text-align:right;">
            <div style="font-size:12px;color:var(--text-muted);">Deadline</div>
            <div style="font-weight:700;color:{{ $tugas->isTerlambat()?'var(--danger)':'var(--text-primary)' }};">
                {{ $tugas->deadline->format('d/m/Y') }}
            </div>
            <div style="font-size:12px;color:var(--text-muted);">{{ $tugas->deadline->format('H:i') }} WIB</div>
        </div>
        @endif
    </div>
    <div class="card-body">
        @if($tugas->deskripsi)
        <div style="background:var(--bg);padding:16px;border-radius:var(--radius-sm);font-size:14px;line-height:1.8;white-space:pre-line;color:var(--text-primary);">{{ $tugas->deskripsi }}</div>
        @endif

        @if($tugas->file)
        <div style="margin-top:16px;">
            <a href="{{ asset('storage/'.$tugas->file) }}" target="_blank" class="btn btn-primary btn-sm">
                <i class="fas fa-download"></i> Unduh Lampiran Tugas
            </a>
        </div>
        @endif

        <div style="margin-top:16px;font-size:12px;color:var(--text-muted);display:flex;gap:16px;">
            <span><i class="fas fa-user"></i> Guru: {{ $tugas->guru->user->name ?? '-' }}</span>
            <span><i class="fas fa-calendar"></i> {{ $tugas->created_at->isoFormat('D MMMM Y') }}</span>
        </div>
    </div>
</div>

{{-- Status / Form Kumpul --}}
@if($pengumpulan)
<div class="content-card" style="border-left:4px solid var(--secondary);">
    <div class="card-body">
        <h3 style="color:var(--secondary);margin-bottom:12px;"><i class="fas fa-check-circle"></i> Tugas Sudah Dikumpulkan</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <div style="font-size:12px;color:var(--text-muted);">Waktu Pengumpulan</div>
                <div style="font-weight:600;">{{ $pengumpulan->dikumpulkan_at?->isoFormat('D MMMM Y, HH:mm') }}</div>
            </div>
            <div>
                <div style="font-size:12px;color:var(--text-muted);">Status</div>
                <div style="font-weight:600;">{{ str_replace('_',' ', ucfirst($pengumpulan->status)) }}</div>
            </div>
            @if($pengumpulan->nilai !== null)
            <div>
                <div style="font-size:12px;color:var(--text-muted);">Nilai</div>
                <div style="font-size:32px;font-weight:800;color:var(--secondary);">{{ $pengumpulan->nilai }}</div>
            </div>
            @endif
            @if($pengumpulan->feedback)
            <div>
                <div style="font-size:12px;color:var(--text-muted);">Feedback Guru</div>
                <div style="font-weight:500;">{{ $pengumpulan->feedback }}</div>
            </div>
            @endif
        </div>
        @if($pengumpulan->file)
        <div style="margin-top:12px;">
            <a href="{{ asset('storage/'.$pengumpulan->file) }}" target="_blank" class="btn btn-sm" style="background:var(--primary-light);color:var(--primary);">
                <i class="fas fa-file"></i> Lihat File yang Dikumpulkan
            </a>
        </div>
        @endif
    </div>
</div>

@elseif($tugas->status === 'aktif')
<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-upload" style="color:var(--primary);margin-right:8px;"></i>Kumpulkan Tugas</h3>
    </div>
    <div class="card-body">
        @if($tugas->isTerlambat())
        <div class="alert alert-danger" style="margin-bottom:16px;">
            <i class="fas fa-triangle-exclamation"></i> Batas waktu sudah lewat. Tugas akan ditandai <strong>terlambat</strong>.
        </div>
        @endif
        <form action="{{ route('siswa.tugas.kumpulkan', $tugas) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Upload File Jawaban</label>
                <input type="file" name="file" class="form-control">
                <small style="color:var(--text-muted);font-size:12px;">Maksimal 10 MB.</small>
            </div>
            <div class="form-group">
                <label>Catatan (opsional)</label>
                <textarea name="catatan" rows="3" class="form-control" placeholder="Tulis catatan untuk guru..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kumpulkan Tugas</button>
        </form>
    </div>
</div>
@else
<div class="alert alert-danger"><i class="fas fa-lock"></i> Tugas ini sudah ditutup.</div>
@endif

@endsection
