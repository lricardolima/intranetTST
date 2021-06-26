<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Administrative extends Model
{
    protected $table = 'administratives';

    protected $fillable = [
        'name',
        'url',
        'image',
    ];

    public function technology()
    {
        return $this->hasOne(Technology::class);
    }

    public function humanResource()
    {
        return $this->hasOne(HumanResource::class);
    }

    public function sesmt()
    {
        return $this->hasOne(Sesmt::class);
    }

    public function personalDepartment()
    {
        return $this->hasOne(personalDepartment::class);
    }

    public function marketing()
    {
        return $this->hasOne(Marketing::class);
    }

    public function controllership()
    {
        return $this->hasOne(Controllership::class);
    }
}
