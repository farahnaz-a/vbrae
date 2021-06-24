<?php

namespace App\Http\Controllers;
use App\Models\Game;

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
            'games' => Game::simplePaginate(20),
        ]);
    }
}
