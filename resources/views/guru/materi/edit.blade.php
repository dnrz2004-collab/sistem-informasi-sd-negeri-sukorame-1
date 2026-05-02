@extends('layouts.guru')

@section('title', 'Edit Materi')

@section('content')

<div class="page-header">
    <div style="display:flex;align-items:center;gap:12px;">
        <a href="{{ route('guru.materi.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="page-title">Edit Materi</h1>
            <p class="page-subtitle">{{ $materi->judul }}</p>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;">

    <form action="{{ route('guru.materi.update', $materi) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="content-card">
            <div class="card-header">
                <h3><i class="fas fa-pencil-alt" style="color:var(--orange);margin-right:8px;"></i>Edit Informasi Materi</h3>
            </div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:18px;">

                {{-- Judul --}}
                <div class="form-group">
                    <label class="form-label">Judul Materi <span class="required">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $materi->judul) }}"
                           class="form-input @error('judul') is-invalid @enderror">
                    @error('judul') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                              class="form-input @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                    @error('deskripsi') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- Mata Pelajaran & Kelas --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Mata Pelajaran <span class="required">*</span></label>
                        <select name="mata_pelajaran_id"
                                class="form-input @error('mata_pelajaran_id') is-invalid @enderror">
                            <option value="">-- Pilih Mapel --</option>
                            @foreach($mapel as $mp)
                                <option value="{{ $mp->id }}"
                                    {{ old('mata_pelajaran_id', $materi->mata_pelajaran_id) == $mp->id ? 'selected' : '' }}>
                                    {{ $mp->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('mata_pelajaran_id') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kelas <span class="required">*</span></label>
                        <select name="kelas_id"
                                class="form-input @error('kelas_id') is-invalid @enderror">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}"
                                    {{ old('kelas_id', $materi->kelas_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('kelas_id') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Tipe Materi --}}
                <div class="form-group">
                    <label class="form-label">Tipe Materi <span class="required">*</span></label>
                    <div class="tipe-selector">
                        @foreach(['file' => ['label'=>'File Dokumen','icon'=>'fa-file-alt'], 'link' => ['label'=>'Tautan (Link)','icon'=>'fa-link'], 'video' => ['label'=>'Video','icon'=>'fa-play-circle']] as $val => $cfg)
                        <label class="tipe-option {{ old('tipe', $materi->tipe) == $val ? 'active' : '' }}" for="tipe_{{ $val }}">
                            <input type="radio" name="tipe" id="tipe_{{ $val }}" value="{{ $val }}"
                                   {{ old('tipe', $materi->tipe) == $val ? 'checked' : '' }}
                                   onchange="toggleTipeInput(this)">
                            <i class="fas {{ $cfg['icon'] }}"></i>
                            <span>{{ $cfg['label'] }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Input File --}}
                <div id="input-file" class="form-group">
                    <label class="form-label">Ganti File</label>
                    @if($materi->file)
                    <div class="current-file-info">
                        <i class="fas fa-file-earmark-text" style="color:var(--primary);"></i>
                        <span>File saat ini: <strong>{{ basename($materi->file) }}</strong></span>
                        <a href="{{ Storage::url($materi->file) }}" target="_blank" class="btn-action btn-view" style="margin-left:auto;">
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                    @endif
                    <div class="file-drop-area" style="margin-top:8px;">
                        <i class="fas fa-cloud-upload-alt" style="font-size:24px;color:var(--primary);opacity:.6;margin-bottom:6px;"></i>
                        <div style="font-size:13px;color:var(--text-muted);margin-bottom:8px;">Pilih file baru (kosongkan jika tidak ingin mengganti)</div>
                        <input type="file" name="file"
                               class="@error('file') is-invalid @enderror"
                               accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip"
                               onchange="showFileName(this)">
                        <div id="file-name" style="margin-top:6px;font-size:12px;color:var(--primary);font-weight:600;"></div>
                    </div>
                    @error('file') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- Input Link/Video --}}
                <div id="input-link" class="form-group" style="display:none;">
                    <label class="form-label" id="link-label">URL Tautan</label>
                    <div style="position:relative;">
                        <i class="fas fa-link" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:13px;"></i>
                        <input type="url" name="link_video" value="{{ old('link_video', $materi->link_video) }}"
                               class="form-input @error('link_video') is-invalid @enderror"
                               style="padding-left:36px;"
                               placeholder="https://...">
                    </div>
                    @error('link_video') <div class="form-error">{{ $message }}</div> @enderror
                </div>

            </div>

            <div class="card-footer" style="display:flex;gap:10px;padding:16px 20px;border-top:1px solid var(--border);">
                <button type="submit" class="btn-primary-action" style="background:var(--orange,#f9ab00);">
                    <i class="fas fa-save"></i> Perbarui Materi
                </button>
                <a href="{{ route('guru.materi.index') }}" class="btn-secondary-action">Batal</a>
            </div>
        </div>
    </form>

    {{-- Info Singkat --}}
    <div class="content-card" style="position:sticky;top:20px;">
        <div class="card-header">
            <h3><i class="fas fa-history" style="color:var(--text-muted);margin-right:8px;"></i>Riwayat</h3>
        </div>
        <div class="card-body">
            <dl style="display:grid;grid-template-columns:auto 1fr;gap:8px 12px;font-size:13px;margin:0;">
                <dt style="color:var(--text-muted);">Dibuat</dt>
                <dd style="margin:0;font-weight:600;">{{ $materi->created_at->format('d M Y, H:i') }}</dd>
                <dt style="color:var(--text-muted);">Diperbarui</dt>
                <dd style="margin:0;font-weight:600;">{{ $materi->updated_at->format('d M Y, H:i') }}</dd>
                <dt style="color:var(--text-muted);">Mata Pelajaran</dt>
                <dd style="margin:0;">{{ $materi->mataPelajaran->nama ?? '-' }}</dd>
                <dt style="color:var(--text-muted);">Kelas</dt>
                <dd style="margin:0;">{{ $materi->kelas->nama ?? '-' }}</dd>
            </dl>
        </div>
    </div>

</div>

@push('scripts')
<script>
function toggleTipeInput(radio) {
    const tipe = radio.value;
    const fileDiv = document.getElementById('input-file');
    const linkDiv = document.getElementById('input-link');
    const linkLabel = document.getElementById('link-label');

    fileDiv.style.display = tipe === 'file' ? 'block' : 'none';
    linkDiv.style.display = tipe !== 'file' ? 'block' : 'none';
    linkLabel.textContent = tipe === 'video' ? 'URL Video (YouTube, dll)' : 'URL Tautan';

    document.querySelectorAll('.tipe-option').forEach(l => l.classList.remove('active'));
    radio.closest('.tipe-option').classList.add('active');
}

function showFileName(input) {
    const display = document.getElementById('file-name');
    display.textContent = input.files[0] ? '📎 ' + input.files[0].name : '';
}

document.addEventListener('DOMContentLoaded', function() {
    const checked = document.querySelector('input[name="tipe"]:checked');
    if (checked) toggleTipeInput(checked);
});
</script>
@endpush

@endsection