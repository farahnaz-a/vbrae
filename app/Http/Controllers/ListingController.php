<?php

namespace App\Http\Controllers;

use App\Models\GameKey;
use Auth; 
use Carbon\Carbon;
use App\Models\Games;
use App\Models\Listing;
use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Game;

class ListingController extends Controller
{
    /**
     * Constructor 
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole')->except('store');
    }
    

    // Status 2 = completed, 1 = sold, 0 = active (default), 
    /**
     *  All Listings 
     */
    public function index()
    {
        return view('listings.index', ['listings' => Listing::latest()->simplePaginate(20)]);
    }

    /**
     *  Listing store
     */
    public function store(Request $request)
    {
        $request->validate([
            'price'    => 'required', 
            'digital'  => 'required', 
        ]);

        $platform = Games::find($request->game_id);
        $listing = Listing::create([
            'game_id'      => $request->game_id, 
            'platform_id'  => $platform->platform_id,
            'price'        => $request->price, 
            'deliver_type' => $request->deliver_type,
            'user_id'      => Auth::id(),
            'created_at'   => Carbon::now(),
            'digital'      => $request->digital,
        ]);

        if($request->has('game_key'))
        {
            $keys = explode(',' , $request->game_key); 
            foreach($keys as $item)
            {
                GameKey::create([
                    'game_id'         => $request->game_id, 
                    'game_list_id'    => $listing->id,
                    'game_key'        => $item, 
                    'created_at'      => Carbon::now(),
                ]);
            }
        }

        return redirect('/');
    }
}
