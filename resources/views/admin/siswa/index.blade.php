@extends('layouts.app')
@section('title', 'Data Siswa')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Data Siswa</h1>
        <p class="page-subtitle">Kelola data seluruh siswa</p>
    </div>
    <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Siswa
    </a>
</div>

<div class="content-card">
    <div class="table-toolbar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari siswa..." onkeyup="filterTable()">
        </div>
        <div class="filter-group">
            <select class="form-select" id="filterKelas">
                <option value="">Semua Kelas</option>
                {{-- Populate via controller --}}
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="data-table" id="siswaTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $i => $s)
                <tr>
                    <td>{{ $siswa->firstItem() + $i }}</td>
                    <td><span class="badge badge-light">{{ $s->nisn }}</span></td>
                    <td>
                        <div class="user-cell">
                            <div class="avatar">{{ substr($s->nama_lengkap, 0, 1) }}</div>
                            <span>{{ $s->nama_lengkap }}</span>
                        </div>
                    </td>
                    <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $s->jenis_kelamin === 'L' ? 'badge-blue' : 'badge-pink' }}">
                            {{ $s->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.siswa.edit', $s) }}" class="btn-icon btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.siswa.destroy', $s) }}" method="POST"
                                  onsubmit="return confirm('Hapus data siswa ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icon btn-delete" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="empty-row">Tidak ada data siswa.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $siswa->links() }}
    </div>
</div>

<script>
function filterTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#siswaTable tbody tr');
    rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(input) ? '' : 'none';
    });
}
</script>
@endsection