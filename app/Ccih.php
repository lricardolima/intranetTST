<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ccih extends Model
{
    protected $table = 'ccihs';

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
