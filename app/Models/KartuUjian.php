<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuUjian extends Model
{
    protected $fillable = ['sesi_ujian_id', 'siswa_id', 'table_number', 'status', 'attended_at'];

    public function sesiUjian()
    {
        return $this->belongsTo(SesiUjian::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
