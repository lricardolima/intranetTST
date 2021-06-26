<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    protected $table = 'advice';

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
    }}
