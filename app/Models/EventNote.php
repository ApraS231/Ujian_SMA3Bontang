<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventNote extends Model
{
    protected $fillable = ['exam_session_id', 'note'];
    
    public function examSession()
    {
        return $this->belongsTo(ExamSession::class);
    }
}