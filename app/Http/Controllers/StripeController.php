<?php

namespace App\Http\Controllers;

use Auth;
use Stripe;
use Session;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\GameKey;
use App\Models\Listing;
use App\Models\Notification;
use Illuminate\Http\Request;

class StripeController extends Controller
{
   /**
    *  Constructor 
    */
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function stripePost(Request $request)
    {
        $listing = Listing::find($request->listing_id);
        Stripe\Stripe::setApiKey('sk_test_sY9or43olY55fF4klGiYjXd200EaVrrfk7');
        Stripe\Charge::create ([
                "amount" =>  $listing->price * 100,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Vbrae Payment"
        ]);

        $listing->status = 1; 
        $listing->save();
        $sale = Sale::create([
            'user_id'    => Auth::id(), 
            'listing_id' => $request->listing_id, 
            'price'      => $listing->price,
            'created_at' => Carbon::now(), 
 
        ]); 

        Notification::create([
            'user_id'     => Auth::id(), 
            'listing_id'  => $listing->id,
            'type'        => 'bought',  
            'message'     => 'Thank you for buying ' . $listing->getGame->name. '. Visit your dashboard for more details.', 
            'url'         => route('user.dashboard', Auth::user()->name),
        ]);

       if(GameKey::where('game_list_id', $listing->id)->exists())
       {
        Notification::create([
            'user_id'     => $listing->user_id,  
            'listing_id'  => $listing->id,
            'type'        => 'sold', 
            'message'     => 'Your listing for ' . $listing->getGame->name. ' has been sold.', 
            'url'         => route('user.dashboard', User::find($listing->user_id)->name),
        ]);
       }
       else 
       {
        Notification::create([
            'user_id'     => $listing->user_id,  
            'listing_id'  => $listing->id,
            'type'        => 'sold', 
            'message'     => 'Your listing for ' . $listing->getGame->name. ' has been sold. Please edit your listing and provide the game keys within 24hrs', 
            'url'         => route('user.dashboard', User::find($listing->user_id)->name),
        ]);
       }
   


        Session::flash('success', 'Payment successful!');
           
        return redirect()->route('frontend.orderDetails', $sale->id)->withSuccess('Your payment was successful.' );
    }
}
