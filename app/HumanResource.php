<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HumanResource extends Model
{
    protected $table = 'human_resources';

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
