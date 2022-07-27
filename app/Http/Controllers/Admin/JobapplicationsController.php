<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\Job_applications;
use App\Models\Admin\Companies;
use Illuminate\Support\Facades\Auth;

class JobapplicationsController extends AdminBaseController
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

        $fetch = Job_applications::join('oppertunities', 'oppertunities.id', '=', 'job_applications.oppertunity_id')
                ->join('users','users.id','=','job_applications.jobseeker_id')
                ->get(['job_applications.*', 'users.name as user_name','oppertunities.title as oppertunity']);

        $data['job_applications'] = $fetch;
        return view('admin/job_applications/index',$data);
    }

    

    public function edit($id)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $data['companies'] = Companies::where('status','1')->get();
        $data['job_application'] = Job_applications::where('id', $id)->first();
        return view('admin/job_applications/edit',$data);
    }

    public function view($id)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $data['oppertunity'] = Job_applications::where('id', $id)->first();
        return view('admin/job_applications/view',$data);
    }

    public function store_application(Request $request)
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

    public function update_application($id, Request $request)
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

    public function delete_application($id){
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        Job_applications::where('id',$id)->delete(); 
        return redirect()->route('admin.job_applications')
        ->with('success','Oppertunity Deleted successfully.');
    }
}