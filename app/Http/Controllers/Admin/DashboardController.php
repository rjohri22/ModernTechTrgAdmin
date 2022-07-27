<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;


class DashboardController extends AdminBaseController
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!$this->check_role()){
             return redirect()->route('home');
        };
        return view('admin.dashbaord');
    }

    public function loginverification(){
        echo "<pre/>".print_r(Auth::user(),1);die();
        $data = false;
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        if($user->group_id == 1){
           $data = true;
        }
        return $data;
    }

}
