<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $table = 'technologies';

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
