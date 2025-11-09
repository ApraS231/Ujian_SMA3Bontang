<?php

// File: app/Models/Exam.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'exam_date'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'exam_date' => 'datetime', // <-- TAMBAHKAN BARIS INI UNTUK MEMPERBAIKI ERROR
    ];

    public function examSessions()
    {
        return $this->hasMany(ExamSession::class);
    }

    public function kartuUjians()
    {
        return $this->hasMany(KartuUjian::class);
    }
}
