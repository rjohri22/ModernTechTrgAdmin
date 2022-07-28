<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job_applications;
use App\Models\Admin\Oppertunities;
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
        $data['total_oppertunity'] = Oppertunities::count();
        $data['total_jobseeker'] = User::where('group_id', 2)->count();
        $data['total_applications'] = Job_applications::count();
        return view('admin.dashbaord',$data);
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

    public function change_status(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        $update_arr = array(
            'status' => $status
        );
        $query  = Job_applications::where('id', $id)->update($update_arr);
        // echo $query;
        // die();
        if($query){
            $res = array('status' => '1', 'message'=>'success');
        }else{
            $res = array('status' => '0', 'message'=>'failed');
        }
        echo json_encode($res);
    }

}
