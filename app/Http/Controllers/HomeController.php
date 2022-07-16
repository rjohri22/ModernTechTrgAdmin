<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee_educations;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile(){
        $user_id = Auth::user()->id;
        $data['user'] = User::where('id', $user_id)->first();
        $data['education'] = Employee_educations::where('user_id', $user_id)->get();
        return view('auth/profile',$data);
    }

    public function store_profile(Request $request){
        $resume_attachment_name = $request->input('pre_resume_attachment');
        
        if($_FILES['resume_attachment']['size'] > 0){
            $resume_attachment_name = time().'.'.$request->resume_attachment->extension();
            $request->resume_attachment->move(public_path('images/resume'), $resume_attachment_name);
        }

        $update_arr = array(
            'first_name'            => $request->input('first_name'),
            'last_name'             => $request->input('last_name'),
            'email'                 => $request->input('email'),
            'phone'                 => $request->input('phone'),
            'country'               => $request->input('country'),
            'state'                 => $request->input('state'),
            'city'                  => $request->input('city'),
            'postal_code'           => $request->input('postal_code'),
            'address_primary'       => $request->input('address_1'),
            'address_secondary'     => $request->input('address_2'),
            'headline'              => $request->input('headline'),
            'summery'               => $request->input('summery'),
            'addition_information'  => $request->input('addition_information'),
            'skills'                => $request->input('skills'),
            'resume_type'           => $request->input('resume_type'),
            'desired_job_title'     => $request->input('desired_job_title'),
            'desired_salary'        => $request->input('desired_salary'),
            'desired_period'        => $request->input('desired_period'),
            'desired_jobtype'       => $request->input('desired_jobtype'),
            'resume_attachment'     => $resume_attachment_name
        );
        $user_id = Auth::user()->id;
        $query  = User::where('id', $user_id)->update($update_arr);
        if($query){
            $res = array('status' => '1', 'message'=>'success');
        }else{
            $res = array('status' => '0', 'message'=>'failed');
        }
        echo json_encode($res);
    }

    public function store_education(Request $request){ 
        $institude_name = $request->input('institude');
        $del_ids = $request->input('del_id');
        $del_id = [];
        if($del_ids){
            $del_id = explode(',', $del_ids);
        }
        if(is_array($del_id)){
            unset($del_id[0]);
        }
        if(count($del_id) > 0){
            foreach($del_id as $id){
               Employee_educations::where('id',$id)->delete(); 
            }
        }
        $user_id = Auth::user()->id;
        $data = array();
        for($i=0; $i< count($institude_name); $i++){
            if($request->input('insert_update')[$i] == 0){
                $data[] = array(
                    'user_id' => $user_id,
                    'level' => $request->input('level')[$i],
                    'institute_name' => $institude_name[$i],
                    'field_name' => $request->input('field')[$i],
                    'country' => $request->input('country')[$i],
                    'state' => $request->input('state')[$i],
                    'city' => $request->input('city')[$i],
                    'period_from' => $request->input('from')[$i],
                    'period_to' => $request->input('to')[$i],
                );
            }
        }
        $query = Employee_educations::insert($data);
        if($query){
            $res = array('status' => '1', 'message'=>'success');
        }else{
            $res = array('status' => '0', 'message'=>'failed');
        }
        echo json_encode($res);
    }
}
