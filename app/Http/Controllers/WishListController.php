<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class WishListController extends Controller
{
   /**
    *  Constructor
    */
   public function __construct()
   {
       $this->middleware('auth');
   } 

   /**
    *  WishLists 
    */
   public function index()
   {
       $wishlists = WishList::where('user_id', Auth::id())->get();
       return view('wishlists.index', compact('wishlists'));
   }
   /**
    *  Wishlist delete
    */
   public function delete($id)
   {
       WishList::find($id)->delete(); 
       return back()->withSuccess('Wishlist Removed');
   }

   /**
    *  Store Wishlist 
    */
   public function store(Request $request)
   {
        if(WishList::where('game_id', $request->game_id)->where('listing_id', $request->listing_id)->where('user_id', Auth::id())->doesntExist()) 
        {
            WishList::create($request->except('_token') + ['created_at' => Carbon::now()]);

            return back()->withSuccess('Added on your wishlist');
        }
        return back()->withSuccess('Added on your wishlist');
   }

// END    
}
