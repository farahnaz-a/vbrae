<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;
    protected $table = 'platforms';
    protected $guarded = []; 

    public function getGames()
    {
        return $this->hasMany('App\Models\Games');
    }

    public function digitals()
    {
        return $this->belongsToMany('App\Models\Digital');
    }

}
