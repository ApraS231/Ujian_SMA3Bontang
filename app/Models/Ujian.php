<?php

// File: app/Models/Ujian.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'exam_date'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'exam_date' => 'datetime',
    ];

    public function sesiUjians()
    {
        return $this->hasMany(SesiUjian::class);
    }
}
