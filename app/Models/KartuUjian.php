<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuUjian extends Model
{
    use HasFactory;

    protected $table = 'kartu_ujians';

    protected $fillable = [
        'exam_id',
        'room_id',
        'student_id',
        'seat_number',
        'status',
        'attended_at',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
