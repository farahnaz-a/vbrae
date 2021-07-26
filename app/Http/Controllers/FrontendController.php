<?php

namespace App\Http\Controllers;

use Image;
use Carbon\Carbon;
use App\Models\Sale;
// use App\Models\Platform;
use App\Models\User;
use App\Models\Games;
use App\Models\Genre;
use App\Models\Listing;
use App\Models\Platform;
use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\GameVideo;
use MarcReichel\IGDBLaravel\Models\Screenshot;
use MarcReichel\IGDBLaravel\Models\Platform as Plat;
use Str;

class FrontendController extends Controller
{
    /**
     *  Constructor 
     */
    public function __construct()
    {
        $this->middleware('auth')->only('buy');
    }
    /**
     *  Home Page 
     */
    public function index()
    {

       
        return view('frontend.index', [
            'games'      => Games::latest()->get(),
            'gams'       => Games::all(),  
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


        $game = Games::where('name', 'LIKE', '%'.$name.'%')->get();
        
        if($game->count() == 0)
        {
            $games = Game::search($name)->get();

            if($games->count() > 0)
            {
                foreach($games as $g)
            {
                $d =  Cover::where('game', $g->id)->first();
                $dbplatform = Platform::all();

               
                if($g->platforms)
                {
                    foreach($g->platforms as $platform)
                    {
                        $platforms = Plat::where('id', $platform)->first();
    
                        foreach($dbplatform as $dbplat)
                        {
                           
                            if($dbplat->name == $platforms->name)
                            {
                                
                                $d =  Cover::where('game', $g->id)->first();
                                
                                $t_cover_image = 'https:'.$d->url;
                                $image =  str_replace('t_thumb', 't_cover_big', $t_cover_image);
                                $filename = Carbon::now()->timestamp. '.jpg'; 
                                $location = public_path('games/' . $filename);
                                Image::make($image)->save($location);
                   
                                Games::create([
                                    'name'           => $g->name, 
                                    'cover'          => $filename, 
                                    'description'    => $g->summary,
                                    'game_url_slug'  => $g->slug,
                                    'release_date'   => $g->first_release_date,
                                    'platform_id'    => $dbplat->id,
                                    'created_at'     => Carbon::now(),
                                    'igdb_game_id'   => $g->id,
                                ]);
                            }
                        }
                }

                    // $d =  Cover::where('game', $g->id)->first();

                            
                    // $image = 'https:'.$d->url; 
                    // $filename = Carbon::now()->timestamp. '.jpg'; 
                    // $location = public_path('games/' . $filename);
                    // Image::make($image)->save($location);
       
                    // Games::create([
                    //     'name'           => $g->name, 
                    //     'cover'          => $filename, 
                    //     'description'    => $g->summary,
                    //     'game_url_slug'  => $g->slug,
                    //     'release_date'   => $g->first_release_date,
                    //     'platform_id'    => 1,
                    //     'created_at'     => Carbon::now(),
                    // ]);
                }
               
            }
            }
        }


        $game = Games::where('name', 'LIKE', '%'.$name.'%')->get();

        

             if($game)
            {
                return view('frontend.addListing', compact('game'));
            }
            else 
            {
                return redirect()->route('frontend.addListing');
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
    /**
     *  Listing form Edit
     */
    public function listingEditForm($id)
    {
        $data = Listing::find($id); 

        return view('frontend.listingEditForm', compact('data'));
    }

    /**
     *  Listing Details 
     */
    public function listing()
    {
        return view('frontend.listings', ['listings' => Listing::where('status', 0)->paginate(30)]);
    }
    /**
     *  Listing Details 
     */
    public function filterlisting($id)
    {
        
        return view('frontend.listings', ['listings' => Listing::where('platform_id', $id)->where('status', 0)->paginate(30)]);
    }
    /**
     *  Listing Details 
     */
    public function regionlisting($region)
    {
        
        return view('frontend.listings', ['listings' => Listing::where('region', $region)->where('status', 0)->paginate(30)]);
    }
    /**
     *  Listing Details 
     */
    public function pricelisting($price)
    {
   
        return view('frontend.listings', ['listings' => Listing::where('price', $price)->where('status', 0)->paginate(30)]);
    }

    /**
     *  Listing Details 
     */
    public function listingDetails($id)
    {
        $data = Listing::find($id); 
        return view('frontend.listingDetails', compact('data'));
    }

    /**
     *  Game overview 
     */
    public function overview($id)
    {
        $data = Games::find($id); 
        return view('frontend.overview', compact('data'));
    }
    /**
     *  Game overview 
     */
    public function game()
    {
        $listings = Games::paginate(30); 
        return view('frontend.listings', compact('listings'));
    }

    /**
     *  User Profile 
     */
    public function userprofile($id, $name)
    {
        $user  = User::find($id); 

        return view('frontend.profile', compact('user'));
    }

    /**
     *  Buy page 
     */
    public function buy($id)
    {
        $data = Listing::find($id); 
        return view('frontend.buy', compact('data'));
    }

    public function checkout(Request $request)
    {

        $data = Listing::find($request->id); 
        
        return view('frontend.checkout', compact('data'));


    }

    /**
     *  Order Details 
     */
    public function orderDetails($id)
    {
        $data = Sale::find($id); 
        $listing = Listing::where('id', $data->listing_id)->first();
        $game    = Games::where('id', $listing->game_id)->first();
        return view('frontend.orderdetails', compact('data', 'listing', 'game'));
    }

    /**
     *  Add Game 
     */
    public function addGame()
    {
        return view('frontend.addGame', ['platforms' => Platform::all(), 'genres' => Genre::all()]);
    }

    /**
     *  Game create 
     */
    public function addGameSave(Request $request)
    {
        $request->validate([
            'name'        => 'required', 
            'image'       => 'required|image', 
            'description' => 'required', 
            'release_date'=> 'required', 
            'platform_id' => 'required'
        ]);

        $slug = Str::slug($request->name);
        $game = Games::create([
            'name'           => $request->name, 
            'cover'          => 'foo', 
            'description'    => $request->description,
            'game_url_slug'  => $slug,
            'release_date'   => $request->release_date,
            'platform_id'    => $request->platform_id,
            'created_at'     => Carbon::now(),
            // 'igdb_game_id'   => $g->id,
        ]);

        $image =  $request->file('image');
        $filename = Carbon::now()->timestamp. $image->extension('image'); 
        $location = public_path('games/' . $filename);
        Image::make($image)->save($location);

        $game->cover = $filename; 
        $game->save(); 

        return redirect('/search?name='.$request->name)->withSuccess('Game Added');

    }

    /**
     *  Cancel 
     */
    public function cancel($id)
    {
        $sale = Sale::find($id); 
        $sale->status = 'cancelled';
        $sale->save();

        return redirect('/')->withSuccess('order cancelled');
    }



// END    
}
