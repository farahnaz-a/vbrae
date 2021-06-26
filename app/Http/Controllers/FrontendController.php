<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Listing;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     *  Home Page 
     */
    public function index()
    {
        return view('frontend.index', [
            'games'      => Game::all(),
            'listings'   => Listing::where('status', 0)->orderBy('id', 'desc')->get(),
        ]);
    }

// END    
}
