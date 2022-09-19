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

        // $fetch = Job_applications::join('oppertunities', 'oppertunities.id', '=', 'job_applications.oppertunity_id')
        //         ->join('users','users.id','=','job_applications.jobseeker_id')
        //         ->get(['job_applications.*', 'users.name as user_name','oppertunities.title as oppertunity']);


        $fetch = Job_applications::selectRaw('
                        job_applications.id,
                        bends.name as profile_name,
                        users.first_name,
                        job_applications.created_at
                    ')
                    ->join('jobs', 'jobs.id', '=', 'job_applications.oppertunity_id')
                    ->join('users','users.id','=','job_applications.jobseeker_id')
                    ->join('bends','bends.id','=','jobs.band_id')
                    ->get();

        $this->data['applicatoins'] = $fetch;
        return view('admin/job_applications/index',$this->data);

    }
    public function view($id){}
    public function edit(){}
    public function delete(){}

    

}