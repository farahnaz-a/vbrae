<?php

namespace App\Http\Controllers;

use App\Models\CommunityIcon;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommunityIconController extends Controller
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
        return view('footer.communityicons.index',[

            'communityIcon' => CommunityIcon::latest()->get(),
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
            'icon' => 'required',
            'link' => 'required',
        ]);

        // Insert data in database
        CommunityIcon::create($request->except('_token') + [
            'created_at' => Carbon::now(), 
        ]);

         //Success message session
         return back()->withSuccess('Added Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityIcon  $communityIcon
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityIcon $communityIcon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityIcon  $communityIcon
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityIcon $communityIcon)
    {
        return view('footer.communityIcons.edit',compact('communityIcon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunityIcon  $communityIcon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityIcon $communityIcon)
    {
        // Form validation
        $request -> validate([
            'icon'    => 'required',
            'link'    => 'required',
        ]);

        // Update Fields
        $communityIcon->icon = $request->icon;
        $communityIcon->link = $request->link;

        // Save Everything in database 
        $communityIcon->save(); 

         // Return Back With Success Session Message
        return redirect()->route('communityIcons.index')->withSuccess('Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityIcon  $communityIcon
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityIcon $communityIcon)
    {
        // Delete from database
        $communityIcon->delete();

        
        // Return success message after deletion 
        return back()->withSuccess('Deleted successfully');
    }
}
