<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Controllership extends Model
{
    protected $table = 'controllerships';

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
