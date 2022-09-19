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
            ->where('users.group_id',2)
            ->get(['users.*','bends.name as bend_name','countries.name as country_name']);
        $this->data['job_seeks'] = $fetch;
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
            ->with('success','User Deleted Successfully.');
    }
}