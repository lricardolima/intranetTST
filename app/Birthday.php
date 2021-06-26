<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Birthday extends Model
{
    public $table = 'birthday';

    protected $fillable = [

        'name',
        'date',
        'sector',
        'photo',
        'cpf',

    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($question) {
            $question->slug = Str::slug($question->name);
        });
    }
}
