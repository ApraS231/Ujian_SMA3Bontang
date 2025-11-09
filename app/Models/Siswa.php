<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'nis', 'class'];

    /**
     * Relasi: Seorang siswa bisa memiliki banyak data kehadiran (mengikuti banyak ujian).
     */
    public function kartuUjians()
    {
        return $this->hasMany(KartuUjian::class);
    }
}
