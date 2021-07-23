<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;

class UserController extends Controller
{
   /**
    *  Constructor 
    */
   public function __construct()
   {
     $this->middleware('auth'); 
   } 

   /**
    *  Dash 
    */
   public function index()
   {
       return view('users.index', [
           'listings' => Listing::where('user_id', Auth::id())->get(),
       ]);
   }

   /**
    *  Settings 
    */
   public function settings($id)
   {
       $user = User::find($id);
       return view('users.settings', compact('user'));
   }

   /**
    *  Update user 
    */
    public function update(Request $request, $id)
    {
        $user = User::find($id); 

        if($request->file('profile_photo_path'))
        {
            $image = $request->file('profile_photo_path'); 
            $filename = $user->id. '.' .$image->extension('profile_photo_path');
            $location = public_path('uploads/users'); 
            $image->move($location, $filename); 
            $user->profile_photo_path = $filename;
        }

        $user->name  = $request->name; 
        $user->email = $request->email; 
        $user->save(); 

        return redirect()->route('user.dashboard', Auth::id());

    }

// END    
}
