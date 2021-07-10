<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash; 

class AdminController extends Controller
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
     *  Admin Statistics
     */
    public function index()
    {
        return view('admin.index', [
            'users' => User::latest()->get(),
        ]);
    }

    /**
     *  Create Admin 
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required', 
            'password' => 'required|confirmed|min:8'
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email, 
            'password'  => Hash::make($request->password),
        ]);

        return back()->withSuccess('An admin account has been created');
    }


// END    
}
