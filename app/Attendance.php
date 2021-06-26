<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = [
        'title',
        'description',
        'photo',
        'type',
        'link',
        'responsible',
        'training_id',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

}
