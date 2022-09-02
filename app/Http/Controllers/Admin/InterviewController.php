<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\Job_applications;
use App\Models\Admin\Companies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InterviewController extends AdminBaseController
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
	public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };  

        $input = $request->all(); 

        $fetch = Job_applications::join('oppertunities', 'oppertunities.id', '=', 'job_applications.oppertunity_id')
                ->join('users','users.id','=','job_applications.jobseeker_id')->where('job_applications.status',3);

        if($input){
            $filter = $request->input('interview');
            if($filter == 'past'){
                $fetch = $fetch->where(DB::raw('DATE_FORMAT(company_interview_datetime, "%Y-%m-%d")'),'<',$filter);
            }
            if($filter == 'today'){
                $fetch = $fetch->where(DB::raw('DATE_FORMAT(company_interview_datetime, "%Y-%m-%d")'),'=',$filter);
            }
            if($filter == 'upcoming'){
                $fetch = $fetch->where(DB::raw('DATE_FORMAT(company_interview_datetime, "%Y-%m-%d")'),'>',$filter);
            }
        }

        $fetch = $fetch->get(['job_applications.*', 'users.name as user_name','oppertunities.title as oppertunity']);

        $this->data['job_applications'] = $fetch;
        return view('admin/interview/index',$this->data);
    }
    

    public function edit($id)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['companies'] = Companies::where('status','1')->get();
        $this->data['job_application'] = Job_applications::where('id', $id)->first();
        return view('admin/interview/edit',$this->data);
    }

    public function view($id)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['oppertunity'] = Job_applications::where('id', $id)->first();
        return view('admin/interview/view',$this->data);
    }

    public function store_interview(Request $request)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        $update_arr = array(
            'hod_id'         => $request->input('hod'),
            'company_interview_datetime'       => $request->input('interview_date'),
            'joining_date'    => $request->input('Joining_date'),
            'offer_salary'    => $request->input('offer_salary'),
            'offer_letter_status'   => $request->input('offer_letter'),
            'status'   => $request->input('status'),
        );

        $query = Job_applications::insert($update_arr);
        return redirect()->route('admin.interview')
        ->with('success','oppertunity created successfully.');
    }

    public function update_interview($id, Request $request)
    {
        $this->loadBaseData();
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
            'interview_feebacks'   => $request->input('interview_feedback'),
        );

        $query  = Job_applications::where('id', $id)->update($update_arr);
        return redirect()->route('admin.interview')
        ->with('success','oppertunity Updated successfully.');
    }

    public function delete_interview($id){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        Job_applications::where('id',$id)->delete(); 
        return redirect()->route('admin.interview')
        ->with('success','Oppertunity Deleted successfully.');
    }
}