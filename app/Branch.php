<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Branch extends Model
{
    protected $table = 'branch';

    protected $fillable = [

        'branch',
        'sector',
        'operation_initial',
        'operation_end',
        'collaborator',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($question) {
            $question->slug = Str::slug($question->sector);
        });
    }

}
