<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\Job_applications;
use App\Models\Admin\Companies;
use Illuminate\Support\Facades\Auth;

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
                ->join('users','users.id','=','job_applications.jobseeker_id')->where('job_applications.status',3)
                ->get(['job_applications.*', 'users.name as user_name','oppertunities.title as oppertunity']);
        // $filter = Input::get('interview');
        // dd($filter)
        // if(!$filters) {
        //         $query = $query->where('self', '<>', true);
        //     } else {
        //         $query = $query->orWhere('self', true);
        //     }
        $data['job_applications'] = $fetch;
        return view('admin/interview/index',$data);
    }

    

    public function edit($id)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $data['companies'] = Companies::where('status','1')->get();
        $data['job_application'] = Job_applications::where('id', $id)->first();
        return view('admin/interview/edit',$data);
    }

    public function view($id)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $data['oppertunity'] = Job_applications::where('id', $id)->first();
        return view('admin/interview/view',$data);
    }

    public function store_interview(Request $request)
    {
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
        return redirect()->route('admin.interview')
        ->with('success','oppertunity Updated successfully.');
    }

    public function delete_interview($id){
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        Job_applications::where('id',$id)->delete(); 
        return redirect()->route('admin.interview')
        ->with('success','Oppertunity Deleted successfully.');
    }
}