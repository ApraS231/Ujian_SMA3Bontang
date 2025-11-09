<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $fillable = ['name', 'capacity'];

    public function sesiUjians()
    {
        return $this->hasMany(SesiUjian::class);
    }
}
