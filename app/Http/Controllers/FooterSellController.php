<?php

namespace App\Http\Controllers;

use App\Models\FooterSell;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FooterSellController extends Controller
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
        return view('footer.sell.index',[
            'footerSell' => FooterSell::latest()->get(),
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
        //form validation
        $request -> validate([
            'sell_item'    => 'required',
            'link'         => 'required',
        ]);

        // Insert data in database
       FooterSell::create($request->except('_token') + ['created_at' => Carbon::now()] );


        //Success message session
        return back()->withSuccess('Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FooterSell  $footerSell
     * @return \Illuminate\Http\Response
     */
    public function show(FooterSell $footerSell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterSell  $footerSell
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterSell $footerSell)
    {
        return view('footer.sell.edit', compact('footerSell'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FooterSell  $footerSell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FooterSell $footerSell)
    {
         //form validation
         $request -> validate([
            'sell_item'    => 'required',
            'link'         => 'required',
        ]);
        
        // Update Fields
        $footerSell->sell_item  = $request->sell_item;
        $footerSell->link       = $request->link;

        // Save Everything in database 
        $footerSell->save(); 

         // Return Back With Success Session Message
        return redirect()->route('footerSells.index')->withSuccess('Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterSell  $footerSell
     * @return \Illuminate\Http\Response
     */
    public function destroy(FooterSell $footerSell)
    {
        // Delete from database
        $footerSell->delete(); 
 
        // Return success message after deletion 
        return back()->withSuccess('Deleted successfully');
    }
}
