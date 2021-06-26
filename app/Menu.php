<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    public $table = 'Menus';

    protected $fillable = [

        'meal',
        'description',
        'date',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($question) {
            $question->slug = Str::slug($question->meal);
        });
    }
}
