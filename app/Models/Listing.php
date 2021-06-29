<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getGame()
    {
        return $this->belongsTo('App\Models\Games', 'game_id', 'id');
    }
}
