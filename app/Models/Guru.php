<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['user_id', 'nip', 'mata_pelajaran', 'status'];

    public function user() { return $this->belongsTo(User::class); }
    public function mataPelajaran() { return $this->hasMany(MataPelajaran::class); }
    public function materi() { return $this->hasMany(Materi::class); }
}