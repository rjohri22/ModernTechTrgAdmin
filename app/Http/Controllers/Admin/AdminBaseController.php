<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AdminBaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function __construct()
    {
        
        $this->middleware('auth');
        // echo Session::get('admin_login');
        // die();
        // $user_id = Auth::user()->id;

    }


    function check_role(){
         $user_id = Auth::user()->id;  
         $details = User::where('id', $user_id)->first();
         // dd($details->group_id);
         if($details->group_id != 1 || $details->group_id == null){
            return false;
         }else{
            return true;
         }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
}
