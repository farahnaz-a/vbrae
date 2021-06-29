<?php

namespace App\Http\Controllers;
use App\Models\Games;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
            
    }

    public function index()
    {
        return view('games.index', [
            'games' => Games::simplePaginate(20),
        ]);
    }
}
