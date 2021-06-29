<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Listing;
use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Game;

class FrontendController extends Controller
{
    /**
     *  Home Page 
     */
    public function index()
    {
        return view('frontend.index', [
            'games'      => Games::all(),
            'listings'   => Listing::where('status', 0)->orderBy('id', 'desc')->get(),
        ]);
    }

    /**
     *  Add Listing 
     */
    public function addListing()
    {
        return view('frontend.addListing');
    }

    /**
     *  Game Search 
     */
    public function search()
    {
        $name = request()->name; 

        // $game = Games::where('name', 'LIKE', '%'.$name.'%')->get();

        // if($game)
        // {
        //     return view('frontend.addListing', compact('game'));
        // }
        // else 
        // {
        //     return redirect()->route('frontend.addListing');
        // }


        $game = Game::search($name)->get();

        foreach($game as $item)
        {
            dd($item);
        }
    }

    /**
     *  Listing form
     */
    public function listingForm($id)
    {
        $data = Games::find($id); 

        return view('frontend.listingForm', compact('data'));
    }



// END    
}
