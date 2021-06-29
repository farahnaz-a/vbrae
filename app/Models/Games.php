<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'games';

    public function getPlatform()
    {
        return $this->belongsTo('App\Models\Platform', 'platform_id', 'id');
    }

    public function getListing()
    {
        return $this->hasMany('App\Models\Listing', 'id', 'game_id');
    }
    

}
