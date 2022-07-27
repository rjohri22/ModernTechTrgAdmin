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
use Illuminate\Support\Facades\Auth;

class JobSeekerController extends AdminBaseController
{
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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $fetch = User::where('group_id','!=',1)->orwhere('group_id',null)->get();

        $data['job_seeker'] = $fetch;
        return view('admin/job_seekers/index',$data);
    }

    

    public function edit($id)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $data['companies'] = Companies::where('status','1')->get();
        $data['job_application'] = Job_applications::where('id', $id)->first();
        return view('admin/job_seekers/edit',$data);
    }

    public function view($id)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $data['user'] = User::where('id', $id)->first();
        $data['education'] = Employee_educations::where('user_id', $id)->get();
        $data['works'] = Employee_works::where('user_id', $id)->get();
        $data['language'] = Employee_languages::where('user_id', $id)->get();
        $data['certificate'] = Employee_cirtificates::where('user_id', $id)->get();
        $data['links'] = Employee_sociallinks::where('user_id', $id)->get();
        return view('admin/job_seekers/view',$data);
    }

    public function store_job_seeker(Request $request)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        $update_arr = array(
            'title'         => $request->input('title'),
            'company_id'       => $request->input('company'),
            'min_salary'    => $request->input('min_salary'),
            'max_salary'    => $request->input('max_salary'),
            'salary_type'   => $request->input('salary_type'),
            'job_type'   => $request->input('job_type'),
            'work_type'   => $request->input('work_type'),
            'expires_on'    => $request->input('expires_on'),
            'no_of_positions'    => $request->input('no_of_position'),
            'urgent_hiring'     => $request->input('urgent_hiring'),
            'status'            => $request->input('status'),
            'summery'           => $request->input('summery'),
            'description'       => $request->input('description'),
        );

        $query = Job_applications::insert($update_arr);
        return redirect()->route('admin.job_applications')
        ->with('success','oppertunity created successfully.');
    }

    public function update_job_seeker($id, Request $request)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $update_arr = array(
            'hod_id'         => $request->input('hod'),
            'company_interview_datetime'       => $request->input('interview_date'),
            'joining_date'    => $request->input('Joining_date'),
            'offer_salary'    => $request->input('offer_salary'),
            'offer_letter_status'   => $request->input('offer_letter'),
            'status'   => $request->input('status'),
        );

        $query  = Job_applications::where('id', $id)->update($update_arr);
        return redirect()->route('admin.job_applications')
        ->with('success','oppertunity Updated successfully.');
    }

    public function delete_job_seeker($id){
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        User::where('id',$id)->delete(); 
        return redirect()->route('admin.job_seeker')
        ->with('success','User Deleted Successfully.');
    }
}