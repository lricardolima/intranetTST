<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalDepartment extends Model
{
    protected $table = 'personal_departments';

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
