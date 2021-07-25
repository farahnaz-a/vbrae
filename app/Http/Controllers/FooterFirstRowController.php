<?php

namespace App\Http\Controllers;

use App\Models\FooterFirstRow;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FooterFirstRowController extends Controller
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
        return view('footer.footerFirstRows.index',[
            'footerFirstRow' => FooterFirstRow::latest()->get(),
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
        $request -> validate([
            'logo'          => 'required|image',
            'mobile_app_1'  => 'image',
            'mobile_app_2'  => 'image',
        ]);

        // Insert data in database
        $footerFirstRow = FooterFirstRow::create($request->except('_token') + [
            'created_at' => Carbon::now()
        ]);

        // Upload logo
        $logo     = $request->file('logo');
        $logoname  = $footerFirstRow->id. '.' .$logo->extension('logo');
        $logo_location  = public_path('uploads/footerfirstrows/');
        $logo->move($logo_location , $logoname);

        // Save Logo name in the database
        $footerFirstRow->logo = $logoname;

        // Upload Mobile App 1
        if($request->has('mobile_app_1')){

            // Upload logo
            $mobile_app_1            = $request->file('mobile_app_1');
            $mobile_app_1_name       = $footerFirstRow->id. '-1.' .$mobile_app_1->extension('mobile_app_1');
            $mobile_app_1_location   = public_path('uploads/footerfirstrows/');
            $mobile_app_1->move($mobile_app_1_location , $mobile_app_1_name);

            // Save Logo name in the database
            $footerFirstRow->mobile_app_1 = $mobile_app_1_name;
        }

        // Upload Mobile App 2
        if($request->has('mobile_app_2')){

            // Upload logo
            $mobile_app_2            = $request->file('mobile_app_2');
            $mobile_app_2_name       = $footerFirstRow->id. '-2.' .$mobile_app_2->extension('mobile_app_2');
            $mobile_app_2_location   = public_path('uploads/footerfirstrows/');
            $mobile_app_2->move($mobile_app_2_location , $mobile_app_2_name);

            // Save Logo name in the database
            $footerFirstRow->mobile_app_2 = $mobile_app_2_name;
        }

        // Save Everything in database 
        $footerFirstRow->save();

        return back()->withSuccess('Aded Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FooterFirstRow  $footerFirstRow
     * @return \Illuminate\Http\Response
     */
    public function show(FooterFirstRow $footerFirstRow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterFirstRow  $footerFirstRow
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterFirstRow $footerFirstRow)
    {
        return view('footer.footerFirstRows.edit', compact('footerFirstRow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FooterFirstRow  $footerFirstRow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FooterFirstRow $footerFirstRow)
    {
        $request -> validate([
            'logo'          => 'image',
            'mobile_app_1'  => 'image',
            'mobile_app_2'  => 'image',
        ]);

        // Update Logo
        if($request->logo){

            // Delete existing image
            $existing = public_path('uploads/footerfirstrows/' . $footerFirstRow->logo); 
            unlink($existing);

            // Upload logo
            $logo     = $request->file('logo');
            $logoname  = $footerFirstRow->id. '.' .$logo->extension('logo');
            $logo_location  = public_path('uploads/footerfirstrows/');
            $logo->move($logo_location , $logoname);

            // Save Logo name in the database
            $footerFirstRow->logo = $logoname;
        }

        // Update Mobile App 1
        if($request->mobile_app_1){

            // Delete existing image
            $existing = public_path('uploads/footerfirstrows/' . $footerFirstRow->mobile_app_1); 
            unlink($existing);

            // Upload logo
            $mobile_app_1            = $request->file('mobile_app_1');
            $mobile_app_1_name       = $footerFirstRow->id. '-1.' .$mobile_app_1->extension('mobile_app_1');
            $mobile_app_1_location   = public_path('uploads/footerfirstrows/');
            $mobile_app_1->move($mobile_app_1_location , $mobile_app_1_name);

            // Save Logo name in the database
            $footerFirstRow->mobile_app_1 = $mobile_app_1_name;
        }

        // Update Mobile App 2
        if($request->mobile_app_2){

            // Delete existing image
            $existing = public_path('uploads/footerfirstrows/' . $footerFirstRow->mobile_app_2); 
            unlink($existing);

             // Upload logo
             $mobile_app_2            = $request->file('mobile_app_2');
             $mobile_app_2_name       = $footerFirstRow->id. '-2.' .$mobile_app_2->extension('mobile_app_2');
             $mobile_app_2_location   = public_path('uploads/footerfirstrows/');
             $mobile_app_2->move($mobile_app_2_location , $mobile_app_2_name);
 
             // Save Logo name in the database
             $footerFirstRow->mobile_app_2 = $mobile_app_2_name;
        }

        // Save Everything in database 
        $footerFirstRow->save(); 

        // Return Back With Success Session Message
        return redirect()->route('footerFirstRows.index')->withSuccess('Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterFirstRow  $footerFirstRow
     * @return \Illuminate\Http\Response
     */
    public function destroy(FooterFirstRow $footerFirstRow)
    {
        // Delete from database
        $existing_image = public_path('uploads/footerFirstRows/'. $footerFirstRow->logo); 
        unlink($existing_image); 

        if ($footerFirstRow->mobile_app_1) {
            
            $existing_image_one = public_path('uploads/footerFirstRows/'. $footerFirstRow->mobile_app_1); 
            unlink($existing_image_one); 
        }

        if ($footerFirstRow->mobile_app_2) {

            $existing_image_two = public_path('uploads/footerFirstRows/'. $footerFirstRow->mobile_app_2); 
            unlink($existing_image_two); 
        }


        // Delete from database
        $footerFirstRow->delete();
        return back()->withSuccess('Deleted Successfully');
    }
}
