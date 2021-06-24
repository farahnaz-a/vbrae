<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    /**
     *  Constructor 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *  Platform List 
     */
    public function index()
    {
        return view('platforms.index', ['platforms' => Platform::simplePaginate(20)]);
    }
}
