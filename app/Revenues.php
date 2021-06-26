<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenues extends Model
{
    protected $table = 'revenues';

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
