<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Games;
use App\Models\Listing;
// use App\Models\Platform;
use App\Models\Platform;
use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\Platform as Plat;
use Image;

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
                foreach($g->platforms as $platform)
                {
                    $platforms = Plat::where('id', $platform)->first();

                    foreach($dbplatform as $dbplat)
                    {
                       
                        if($dbplat->name == $platforms->name)
                        {
                            
                            $d =  Cover::where('game', $g->id)->first();

                            
                            $image = 'https:'.$d->url; 
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
                            ]);
                        }
                    }

                    $d =  Cover::where('game', $g->id)->first();

                            
                    $image = 'https:'.$d->url; 
                    $filename = Carbon::now()->timestamp. '.jpg'; 
                    $location = public_path('games/' . $filename);
                    Image::make($image)->save($location);
       
                    Games::create([
                        'name'           => $g->name, 
                        'cover'          => $filename, 
                        'description'    => $g->summary,
                        'game_url_slug'  => $g->slug,
                        'release_date'   => $g->first_release_date,
                        'platform_id'    => 1,
                        'created_at'     => Carbon::now(),
                    ]);
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



// END    
}
