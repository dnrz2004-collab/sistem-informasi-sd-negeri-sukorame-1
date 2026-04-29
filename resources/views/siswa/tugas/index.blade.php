@extends('layouts.siswa')
@section('title', 'Tugas Saya')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Tugas Saya</h1>
        <p class="page-subtitle">Lihat dan kumpulkan tugas dari guru</p>
    </div>
</div>

<div class="content-card">
    <div class="table-toolbar">
        <form method="GET" style="display:flex;gap:10px;width:100%;">
            <select name="status_kumpul" class="form-control" style="width:auto;">
                <option value="">Semua Tugas</option>
                <option value="belum" @selected(request('status_kumpul')=='belum')>Belum Dikumpulkan</option>
                <option value="sudah" @selected(request('status_kumpul')=='sudah')>Sudah Dikumpulkan</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
            <a href="{{ route('siswa.tugas.index') }}" class="btn btn-sm" style="background:var(--bg);color:var(--text-secondary);border:1px solid var(--border);">Reset</a>
        </form>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul Tugas</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tugas as $t)
                @php $sudah = isset($dikumpulkan[$t->id]); @endphp
                <tr>
                    <td style="font-weight:600;">{{ $t->judul }}</td>
                    <td>{{ $t->mataPelajaran->nama ?? '-' }}</td>
                    <td>{{ $t->guru->user->name ?? '-' }}</td>
                    <td>
                        @if($t->deadline)
                            <span style="color:{{ $t->isTerlambat()?'var(--danger)':'var(--text-primary)' }};font-size:13px;">
                                <i class="fas fa-clock"></i> {{ $t->deadline->format('d/m/Y H:i') }}
                            </span>
                        @else
                            <span style="color:var(--text-muted);">-</span>
                        @endif
                    </td>
                    <td>
                        @if($sudah)
                            <span class="badge badge-green"><i class="fas fa-check"></i> Dikumpulkan</span>
                        @elseif($t->isTerlambat())
                            <span class="badge badge-light" style="color:var(--danger);">Terlambat</span>
                        @else
                            <span class="badge badge-light" style="color:var(--warning);">Belum dikumpulkan</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('siswa.tugas.show', $t) }}" class="btn btn-sm btn-primary">
                            {{ $sudah ? 'Lihat' : 'Kumpulkan' }}
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="empty-row"><i class="fas fa-inbox" style="font-size:24px;display:block;margin-bottom:8px;"></i>Tidak ada tugas saat ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrapper">{{ $tugas->links() }}</div>
</div>

@endsection
