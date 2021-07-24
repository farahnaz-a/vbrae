<?php

namespace App\Http\Controllers;

use App\Models\gamingConsole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GamingConsoleController extends Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('footer.gamingconsoles.index',[
            'gamingConsole' => gamingConsole::latest()->get(),
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
            'image' => 'required|image',
        ]);

        // Insert data in database
        $gamingConsole = gamingConsole::create($request->except('_token') + [
            'created_at' => Carbon::now()
        ]);

        // Upload Image
        $image     = $request->file('image');
        $filename  = $gamingConsole->id. '.' .$image->extension('image');
        $location  = public_path('uploads/gamingconsoles/');
        $image->move($location , $filename);

        // Save Image name in the database
        $gamingConsole->image = $filename;

        // Save Everything in database 
        $gamingConsole->save();

        return back()->withSuccess('Aded Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gamingConsole  $gamingConsole
     * @return \Illuminate\Http\Response
     */
    public function show(gamingConsole $gamingConsole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gamingConsole  $gamingConsole
     * @return \Illuminate\Http\Response
     */
    public function edit(gamingConsole $gamingConsole,$id)
    {
        $gamingconsole = GamingConsole::find($id);

        return view('footer.gamingconsoles.edit', compact('gamingconsole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gamingConsole  $gamingConsole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gamingConsole $gamingConsole,$id)
    {

        $gamingconsole = GamingConsole::find($request->id);

        $request -> validate([
            'image' => 'image',
        ]);

        if($request->image){

            // Delete existing image
            $existing = public_path('uploads/gamingconsoles/' . $gamingconsole->image); 
            unlink($existing);

            // Upload Image
            $image     = $request->file('image');
            $filename  = $gamingconsole->id. '.' .$image->extension('image');
            $location  = public_path('uploads/gamingconsoles/');
            $image->move($location , $filename);

            // Save Image name in the database
            $gamingconsole->image = $filename;
        }

        // Save Everything in database 
        $gamingconsole->save(); 

        // Return Back With Success Session Message
        return redirect()->route('gamingconsoles.index')->withSuccess('Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gamingConsole  $gamingConsole
     * @return \Illuminate\Http\Response
     */
    public function destroy(gamingConsole $gamingConsole,$id)
    {
        $gamingconsole = gamingConsole::find($id);
        
        // Delete from database
        $existing_image = public_path('uploads/gamingconsoles/'. $gamingconsole->image); 
        unlink($existing_image); 

        // Delete from database
        $gamingconsole->delete();
        return back()->withSuccess('Deleted Successfully');
    }
}
