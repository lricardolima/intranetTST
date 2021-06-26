<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sac extends Model
{
    protected $table = 'sacs';

    protected $fillable = [

        'title',
        'description',
        'photo',
        'type',
        'link',
        'responsible',
        'assistance_id',

    ];

    public function assistance()
    {
        return $this->belongsTo(Assistance::class);
    }
}
