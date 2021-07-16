<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;

class NotificationController extends Controller
{
   /**
    *  Constructor 
    */
   public function __construct()
   {
       $this->middleware('auth');
   }

   /**
    *  Notifications
    */
   public function index()
   {
       return view('frontend.notifications', [
           'notifications' => Notification::where('user_id', Auth::id())->orderBy('id', 'desc')->simplePaginate(20),
       ]);
   }

   /**
    *  Update 
    */
    public function seen($id)
    {
        $data = Notification::find($id); 

        $data->seen = 'yes'; 
        $data->save(); 

        return redirect($data->url);
    }
}
