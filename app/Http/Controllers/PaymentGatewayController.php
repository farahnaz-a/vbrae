<?php

namespace App\Http\Controllers;

use App\Models\PaymentGateway;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
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
        return view('footer.paymentGateways.index',[

            'paymentGateway' => PaymentGateway::all(),
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
            'image' => 'required|image',
        ]);

        // Insert data in database
        $paymentGateway = PaymentGateway::create($request->except('_token') + [
            'created_at' => Carbon::now()
        ]);

         // Upload Image
        $image     = $request->file('image');
        $filename  = $paymentGateway->id. '.' .$image->extension('image');
        $location  = public_path('uploads/paymentGateways/');
        $image->move($location , $filename);

        // Save Image name in the database
        $paymentGateway->image = $filename;

        $paymentGateway->save();

         //Success message session
         return back()->withSuccess('Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentGateway $paymentGateway)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentGateway $paymentGateway)
    {
        return view('footer.paymentGateways.edit', compact('paymentGateway'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentGateway $paymentGateway)
    {

        // // Form validation
        $request->validate([
            'image' => 'image',
        ]);

        // Update Image
        if($request->image){

            // Delete existing image
            $existing = public_path('uploads/paymentGateways/' . $paymentGateway->image); 
            unlink($existing);

            // Upload Image
            $image     = $request->file('image');
            $filename  = $paymentGateway->id. '.' .$image->extension('image');
            $location  = public_path('uploads/paymentGateways/');
            $image->move($location , $filename);

            // Save Image name in the database
            $paymentGateway->image = $filename;

            $paymentGateway->save();
        }

        // Return Back With Success Session Message
        return redirect()->route('paymentGateways.index')->withSuccess('Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentGateway  $paymentGateway
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentGateway $paymentGateway)
    {
        if($paymentGateway->image){
            // Delete image
            $existing = public_path('uploads/paymentGateways/' . $paymentGateway->image); 
            unlink($existing);
        }

        $paymentGateway->delete();

        return back()->withSuccess('Deleted Successfully');
    }
}
