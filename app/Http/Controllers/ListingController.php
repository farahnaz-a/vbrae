<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Listing;
use Illuminate\Http\Request;
use Auth; 

class ListingController extends Controller
{
    /**
     * Constructor 
     */
    public function __construct()
    {
        $this->middleware('auth');
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

        Listing::create([
            'game_id'      => $request->game_id, 
            'price'        => $request->price, 
            'deliver_type' => $request->deliver_type,
            'user_id'      => Auth::id(),
            'created_at'   => Carbon::now(),
            'digital'      => $request->digital,
        ]);

        return redirect('/');
    }
}
