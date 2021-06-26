<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    protected $table = 'assistances';

    protected $fillable = [

        'name',
        'url',
        'image',

    ];

    public function quality()
    {
        return $this->hasOne(Quality::class);
    }

    public function medicalRelationship()
    {
        return $this->hasOne(MedicalRelationship::class);
    }

    public function permanentEducation()
    {
        return $this->hasOne(PermanentEducation::class);
    }

    public function sac()
    {
        return $this->hasOne(Sac::class);
    }

    public function ccih()
    {
        return $this->hasOne(Ccih::class);
    }

}
