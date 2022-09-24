<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee_educations;
use App\Models\Employee_works;
use App\Models\Employee_languages;
use App\Models\Employee_cirtificates;
use App\Models\Employee_sociallinks;
use App\Models\Admin\Bend;
use App\Models\Admin\Companies;
use App\Models\Admin\Countries;
use App\Models\Admin\JobStatusUpdates;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JobSeekerController extends AdminBaseController {
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
    }
    public function index(){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $fetch = User::Leftjoin('bends','bends.id','=','users.bend_id')
            ->Leftjoin('countries','countries.id','=','users.country')
            ->Leftjoin('job_status_updates','job_status_updates.jb_id','=','users.id')
            ->Leftjoin('users as u','u.id','=','job_status_updates.emp_id')
            ->where('users.group_id',2)
            ->get(['users.*','bends.name as bend_name','countries.name as country_name','u.name as jbu_name']);
        $this->data['job_seeks'] = $fetch;

        $this->data['employeess'] = User::where('group_id',1)->get();
        return view('admin/job_seeker/index',$this->data);
    }
    public function view($id){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['user'] = User::where('id', $id)->first();
        $this->data['education'] = Employee_educations::where('user_id', $id)->get();
        $this->data['works'] = Employee_works::where('user_id', $id)->get();
        $this->data['language'] = Employee_languages::where('user_id', $id)->get();
        $this->data['certificate'] = Employee_cirtificates::where('user_id', $id)->get();
        $this->data['links'] = Employee_sociallinks::where('user_id', $id)->get();
        return view('admin/job_seeker/view',$this->data);
    }
    public function delete_job_seeker($id){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        User::where('id',$id)->delete(); 
        return redirect()->route('admin.job_seeker')
            ->with('success','Job Seeker Deleted Successfully.');
    }

    public function assign_job_status_update(Request $request){
        $jb_id = $request->input('jb_id');
        $emp_id = $request->input('emp_id');
        if(count((array)$jb_id) > 0){
            $insert_data = array();
            $update_data = array();
            for($i=0; $i < count($jb_id) ; $i++){
                $pre = JobStatusUpdates::where('jb_id',$jb_id[$i])->first();
                if($pre){
                    $updata_data = array(
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'emp_id' => $emp_id,
                        'jb_id' => $jb_id[$i]
                    );
                    $up = JobStatusUpdates::where('id',$pre->id)->update($updata_data);
                }else{
                    $insert_data[] = array(
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'emp_id' => $emp_id,
                        'jb_id' => $jb_id[$i]
                    );
                }
            }

            $q = JobStatusUpdates::insert($insert_data);
            if($q){
                return redirect()->route('admin.job_seeker')->with('success','Assigned Successfully.');
            }else{
                return redirect()->route('admin.job_seeker')->with('error_','Something Went Wrong.');
            }

        }else{
            return redirect()->route('admin.job_seeker')
            ->with('error_','No Job Seeker Selected');
        }
    }
}