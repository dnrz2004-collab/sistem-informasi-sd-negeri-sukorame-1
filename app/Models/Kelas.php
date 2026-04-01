<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['nama_kelas', 'tingkat', 'rombel', 'wali_kelas_id', 'kapasitas'];

    public function waliKelas() { return $this->belongsTo(User::class, 'wali_kelas_id'); }
    public function siswa() { return $this->hasMany(Siswa::class); }
    public function absensi() { return $this->hasMany(Absensi::class); }
}