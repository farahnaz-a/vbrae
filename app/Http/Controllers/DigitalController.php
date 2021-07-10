<?php

namespace App\Http\Controllers;

use App\Models\Digital;
use Illuminate\Http\Request;

class DigitalController extends Controller
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
    *  Digital List
    */
   public function index()
   {
       return view('digitals.index', ['digitals' => Digital::simplePaginate(20)]);
   }
}
