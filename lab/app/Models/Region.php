<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $fillable = [
        'name',
        'government_id',
    ];

    public function government()
    {
        return $this->belongsTo(Government::class , 'government_id' , 'id');
    }

}
