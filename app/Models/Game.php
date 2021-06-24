<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getPlatform()
    {
        return $this->belongsTo('App\Models\Platform', 'platform_id', 'id');
    }

    public function getListing()
    {
        return $this->hasMany('App\Models\Listing');
    }
    

}
