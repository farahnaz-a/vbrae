<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
   /**
    * Constructor 
    */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    /**
     *  Genre List 
     */
    public function index()
    {
        return view('genres.index', ['genres' => Genre::simplePaginate(20)]);
    }
}
