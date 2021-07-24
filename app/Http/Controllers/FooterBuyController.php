<?php

namespace App\Http\Controllers;

use App\Models\FooterBuy;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FooterBuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('footer.buy.index',[
            'footerBuy' => FooterBuy::latest()->get(),
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
            'buy_item'    => 'required',
            'link'        => 'required',
        ]);

        // Insert data in database
        FooterBuy::create($request->except('_token') + ['created_at' => Carbon::now()] );


        //Success message session
        return back()->withSuccess('Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FooterBuy  $footerBuy
     * @return \Illuminate\Http\Response
     */
    public function show(FooterBuy $footerBuy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterBuy  $footerBuy
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterBuy $footerBuy)
    {
        return view('footer.buy.edit', compact('footerBuy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FooterBuy  $footerBuy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FooterBuy $footerBuy)
    {
        // Update Fields
        $footerBuy->buy_item   = $request->buy_item;
        $footerBuy->link       = $request->link;

        // Save Everything in database 
        $footerBuy->save(); 

         // Return Back to Banner List With Success Session Message
        return redirect()->route('footerBuys.index')->withSuccess('Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterBuy  $footerBuy
     * @return \Illuminate\Http\Response
     */
    public function destroy(FooterBuy $footerBuy)
    {
        // Delete from database
        $footerBuy->delete(); 
 
        // Return success message after deletion 
        return back()->withSuccess('Deleted successfully');
    }
}
