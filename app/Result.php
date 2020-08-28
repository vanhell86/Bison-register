<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'participant_id', 'stage_number', 'time', 'points', 'age_group'
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
