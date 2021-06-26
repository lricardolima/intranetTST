<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    protected $table = 'financials';

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
