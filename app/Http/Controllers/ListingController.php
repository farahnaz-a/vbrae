<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

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
}
