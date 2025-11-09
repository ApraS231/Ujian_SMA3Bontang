<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiUjian extends Model
{
    protected $fillable = ['ujian_id', 'ruang_id', 'supervisor_id', 'session_time'];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function kartuUjians()
    {
        return $this->hasMany(KartuUjian::class);
    }

    public function eventNotes()
    {
        return $this->hasMany(EventNote::class);
    }
}
