<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Sesmt extends Model
{
    protected $table = 'sesmts';

    protected $fillable = [
        'title',
        'description',
        'photo',
        'type',
        'link',
        'responsible',
        'administrative_id',
    ];

    public function administrative()
    {
        return $this->belongsTo(Administrative::class);
    }
}
