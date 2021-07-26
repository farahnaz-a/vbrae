<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     *  Constructor 
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    /**
     *  Sales List 
     */
    public function index()
    {
        return view('sales.index', ['sales' => Sale::latest()->get()]);
    }
}
