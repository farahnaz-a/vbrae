<?php

namespace App\Http\Controllers;

use Mail;
use Auth; 
use Carbon\Carbon;
use App\Models\User;
use App\Models\Games;
use App\Models\GameKey;
use App\Models\Listing;
use App\Models\WishList;
use App\Mail\WishListMailer;
use App\Models\Notification;
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
        $this->middleware('checkrole')->except('store', 'update', 'delete');
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
            'region'       => $request->region,
            'platform_id'  => $platform->platform_id,
            'price'        => $request->price, 
            'deliver_type' => $request->deliver_type,
            'user_id'      => Auth::id(),
            'created_at'   => Carbon::now(),
            'digital'      => $request->digital,
        ]);

        if($request->game_key)
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

        $wishes = WishList::where('game_id', $request->game_id)->where('notification', 'yes')->get();

        foreach($wishes as $wish)
        {
            if($wish->price)
            {
              if($request->price <= $wish->price)
              {

                $url  = route('frontend.listingDetails', $listing->id);
                $game = Games::find($request->game_id)->name; 

                Notification::create([
                    'message'    => $game . ' has a new listing.', 
                    'url'        => $url,
                    'game_id'    => $request->game_id,
                    'listing_id' => $listing->id,
                    'user_id'    => $wish->user_id,
                    'type'       => 'wishlist',
                    'created_at' => Carbon::now(),
                ]);

                Mail::to(User::find($wish->user_id)->email)->send(new WishListMailer($url, $game));
              }
            }
            else 
            {


                $url = route('frontend.listingDetails', $listing->id);
                $game = Games::find($request->game_id)->name; 
                Notification::create([
                    'message'    => $game . ' has a new listing.', 
                    'url'        => $url,
                    'game_id'    => $request->game_id,
                    'listing_id' => $listing->id,
                    'user_id'    => $wish->user_id,
                    'type'       => 'wishlist',
                    'created_at' => Carbon::now(),
                ]);

                Mail::to(User::find($wish->user_id)->email)->send(new WishListMailer($url, $game));


            }

          

        }
        return redirect('/');
    }
    /**
     *  Listing update
     */
    public function update(Request $request)
    {
        $request->validate([
            'price'    => 'required', 
            'digital'  => 'required', 
        ]);

        $listing = Listing::find($request->id);

        $platform = Games::find($request->game_id);
        $listing->update([
            'game_id'      => $request->game_id, 
            'region'       => $request->region,
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

            foreach(Gamekey::where('game_list_id', $request->id)->get() as $existing)
            {
                $existing->delete(); 
            }
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

        $wishes = WishList::where('game_id', $request->game_id)->where('notification', 'yes')->get();

        foreach($wishes as $wish)
        {
            if($wish->price)
            {
              if($request->price <= $wish->price)
              {

                $url  = route('frontend.listingDetails', $listing->id);
                $game = Games::find($request->game_id)->name; 

                Notification::create([
                    'message'    => $game . ' listing is now updated.', 
                    'url'        => $url,
                    'game_id'    => $request->game_id,
                    'listing_id' => $listing->id,
                    'user_id'    => $wish->user_id,
                    'type'       => 'wishlist',
                    'created_at' => Carbon::now(),
                ]);

                Mail::to(User::find($wish->user_id)->email)->send(new WishListMailer($url, $game));
              }
            }
            else 
            {


                $url = route('frontend.listingDetails', $listing->id);
                $game = Games::find($request->game_id)->name; 
                Notification::create([
                    'message'    => $game . ' listing is now updated.', 
                    'url'        => $url,
                    'game_id'    => $request->game_id,
                    'listing_id' => $listing->id,
                    'user_id'    => $wish->user_id,
                    'type'       => 'wishlist',
                    'created_at' => Carbon::now(),
                ]);

                Mail::to(User::find($wish->user_id)->email)->send(new WishListMailer($url, $game));


            }

          

        }
        return redirect('/')->withSuccess('Listing updated');
    }

    /**
     *  Listing Delete
     */
    public function delete($id)
    {
        Listing::find($id)->delete(); 

        return redirect('/')->withSuccess('Listing deleted');
    }
}
