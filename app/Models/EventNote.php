<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventNote extends Model
{
    protected $fillable = ['exam_id', 'room_id', 'note'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
