<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'kode',
        'nama',
        'jenis',
        'tingkat',
        'kkm',
        'guru_id',
        'status',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}