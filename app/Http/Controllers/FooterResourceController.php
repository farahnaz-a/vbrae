<?php

namespace App\Http\Controllers;

use App\Models\FooterResource;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FooterResourceController extends Controller
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
        return view('footer.resources.index',[
            'footerResource' => FooterResource::latest()->get(),
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
            'resource_item'  => 'required',
            'link'           => 'required',
        ]);

        // Insert data in database
        FooterResource::create($request->except('_token') + ['created_at' => Carbon::now()] );


        //Success message session
        return back()->withSuccess('Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FooterResource  $footerResource
     * @return \Illuminate\Http\Response
     */
    public function show(FooterResource $footerResource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterResource  $footerResource
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterResource $footerResource)
    {
        return view('footer.resources.edit', compact('footerResource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FooterResource  $footerResource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FooterResource $footerResource)
    {
        //form validation
        $request -> validate([
            'resource_item'  => 'required',
            'link'           => 'required',
        ]);
        
        // Update Fields
        $footerResource->resource_item   = $request->resource_item;
        $footerResource->link            = $request->link;

        // Save Everything in database 
        $footerResource->save(); 

         // Return Back With Success Session Message
        return redirect()->route('footerResources.index')->withSuccess('Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterResource  $footerResource
     * @return \Illuminate\Http\Response
     */
    public function destroy(FooterResource $footerResource)
    {
        // Delete from database
        $footerResource->delete(); 
 
        // Return success message after deletion 
        return back()->withSuccess('Deleted successfully');
    }
}
