<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipsAndOffer extends Model
{
    protected $table = 'tips_and_offers';

    protected $fillable = [
        'type',
        'title',
        'description',
        'image',
    ];
}
