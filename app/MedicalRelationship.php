<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRelationship extends Model
{
    protected $table = 'medical_relationships';

    protected $fillable = [

        'title',
        'description',
        'photo',
        'type',
        'link',
        'responsible',
        'assistance_id',

    ];

    public function assistance()
    {
        return $this->belongsTo(Assistance::class);
    }
}
