<?php

namespace App\Http\Controllers;

use App\Models\UserRating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserRatingController extends Controller
{
   /**
    *  Constructor 
    */
    public function __construct()
    {
      $this->middleware('auth'); 
    } 

    /** 
     *  Rate users 
     */
    public function store(Request $request)
    {
        UserRating::create($request->except('_token') + ['created_at' => Carbon::now()]); 
        return back()->withSuccess('Rating added');
    }
}
