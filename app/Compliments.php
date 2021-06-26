<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Compliments extends Model
{
    protected $table = 'compliments';

    protected $fillable = [
        'title',
        'compliments',
        'responsible',
        'photo',
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
