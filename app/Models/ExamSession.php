<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    use HasFactory;

    protected $table = 'exam_sessions';

    protected $fillable = [
        'subject_id',
        'exam_date',
        'start_time',
        'end_time',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function examCards()
    {
        return $this->hasMany(KartuUjian::class);
    }
    
    public function eventNotes()
    {
        return $this->hasMany(EventNote::class);
    }
}
