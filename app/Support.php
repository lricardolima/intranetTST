<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'supports';

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
