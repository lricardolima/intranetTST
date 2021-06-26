<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Training extends Model
{
    protected $table = 'trainings';

    protected $fillable = [
        'name',
        'url',
        'photo',
    ];

    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }

    public function revenues()
    {
        return $this->hasOne(Revenues::class);
    }

    public function financial()
    {
        return $this->hasOne(Financial::class);
    }

    public function advice()
    {
        return $this->hasOne(Advice::class);
    }


    public function supplies()
    {
        return $this->hasOne(Supply::class);
    }

    public function support()
    {
        return $this->hasOne(Support::class);
    }

}
