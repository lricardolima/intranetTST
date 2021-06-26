<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermanentEducation extends Model
{
    protected $table = 'permanent_education';

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
