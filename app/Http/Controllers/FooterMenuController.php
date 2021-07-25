<?php

namespace App\Http\Controllers;

use App\Models\FooterMenu;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FooterMenuController extends Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrole');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('footer.footerMenus.index',[

            'footerMenu' => FooterMenu::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Form validation
        $request->validate([

            'menu' => 'required',
            'link' => 'required',
        ]);

        // Insert data in database
        FooterMenu::create($request->except('_token') + [
            'created_at' => Carbon::now()
        ]);

         //Success message session
         return back()->withSuccess('Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FooterMenu  $footerMenu
     * @return \Illuminate\Http\Response
     */
    public function show(FooterMenu $footerMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterMenu  $footerMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterMenu $footerMenu)
    {
        return view('footer.footerMenus.edit',compact('footerMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FooterMenu  $footerMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FooterMenu $footerMenu)
    {
         // Form validation
         $request -> validate([
            'menu'    => 'required',
            'link'    => 'required',
        ]);

        // Update Fields
        $footerMenu->menu = $request->menu;
        $footerMenu->link = $request->link;

        // Save Everything in database 
        $footerMenu->save(); 

         // Return Back With Success Session Message
        return redirect()->route('footerMenus.index')->withSuccess('Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterMenu  $footerMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(FooterMenu $footerMenu)
    {
          // Delete from database
          $footerMenu->delete();

          // Return success message after deletion 
          return back()->withSuccess('Deleted successfully');
    }
}
