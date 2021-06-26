<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quality extends Model
{
    protected $table = 'qualities';

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
