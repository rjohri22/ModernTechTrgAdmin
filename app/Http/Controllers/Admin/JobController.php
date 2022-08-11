<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\Admin\Oppertunities;
use App\Models\Admin\Jobs;
use App\Models\User;
use App\Models\Admin\BendAssign;
use App\Models\Admin\Companies;
use App\Models\Admin\Countries;
use App\Models\Admin\BusinessLocations;
use Illuminate\Support\Facades\Auth;

class JobController extends AdminBaseController
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

        $user_id = Auth::user()->id;
        $fetch = Jobs::join('companies', 'companies.id', '=', 'jobs.company_id')
        ->join('countries','countries.id','=','jobs.country_id')
        ->join('states','states.id','=','jobs.state_id')
        ->join('cities','cities.id','=','jobs.city_id')
        ->join('users','users.id','=','jobs.modified_by');

        $data['login_details'] = $login_details = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();

        if(!empty($login_details)){
            $childres = BendAssign::where('parent_id',$data['login_details']->id)->get()->pluck('child_id');
            $childres[] = $data['login_details']->id;

            if($data['login_details']->name == 'HR Management'){
                $fetch = $fetch->wherein('users.bend_id',$childres);
            }else{
               $fetch = $fetch->where('jobs.approved_manager','!=',null); 
            }
        }
        $fetch = $fetch->where('jobs.is_deleted','=',0);
        $fetch = $fetch->get(['jobs.*', 'companies.name as company_name', 'countries.name as country_name','states.name as state_name','cities.name as city_name','users.first_name']);
        $data['jobs'] = $fetch;
        return view('admin/jobs/index',$data);
    }

    public function add()
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $data['job_descrtiption'] = Oppertunities::get();
        $data['companies'] = Companies::where('status','1')->get();
        $data['countries'] = Countries::get();
        // $data['countries'] = Countries::get();
        
        return view('admin/jobs/add',$data);
    }

    public function edit($id)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $data['countries'] = Countries::get();
        $data['job'] = jobs::where('id',$id)->first();
        if($data['job']->approved_hr == null){
            $data['companies'] = Companies::where('status','1')->get();
            $data['oppertunity'] = Oppertunities::where('id', $id)->first();
            return view('admin/jobs/edit',$data);
        }
        else{
            return redirect()->route('admin.jobs');
        }
    }

    public function view($id)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $fetch = Jobs::join('companies', 'companies.id', '=', 'jobs.company_id')->join('countries','countries.id','=','jobs.country_id')->join('states','states.id','=','jobs.state_id')->join('cities','cities.id','=','jobs.city_id')
                ->select(['jobs.*', 'companies.name as company_name', 'countries.name as country_name','states.name as state_name','cities.name as city_name'])->where('jobs.id',$id)->first();
        // $fetch = Oppertunities::Leftjoin('companies', 'companies.id', '=', 'oppertunities.company_id')
                // ->get(['oppertunities.*', 'companies.name as company_name'])->where('id',$id)->first();
        $data['job'] = $fetch;
        return view('admin/jobs/view',$data);
    }

    public function store(Request $request)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'jd' => 'required',
            'company_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $job_descrtiption_id = $request->input('jd');
        $oppertunity = Oppertunities::where('id',$job_descrtiption_id)->first();
        $update_arr = array(
            'title'         => $oppertunity->title,
            'company_id'       => $request->input('company_id'),
            'country_id'       => $request->input('country_id'),
            'state_id'       => $request->input('state_id'),
            'city_id'       => $request->input('city_id'),
            'min_salary'    => $oppertunity->min_salary,
            'max_salary'    => $oppertunity->max_salary,
            'salary_type'   => $oppertunity->salary_type,
            'job_type'   => $oppertunity->job_type,
            'work_type'   => $oppertunity->work_type,
            'expires_on'    => $oppertunity->expires_on,
            'no_of_positions'    => $oppertunity->no_of_positions,
            'urgent_hiring'     => $oppertunity->urgent_hiring,
            'status'            => 0,
            'summery'           => $oppertunity->summery,
            'description'       => $oppertunity->description,
            'modified_by'       => $user_id,
        );

        $query = Jobs::insert($update_arr);
        return redirect()->route('admin.jobs')
        ->with('success','Job created successfully.');
    }

    public function update($id, Request $request)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        $update_arr = array(
            'title'         => $request->input('title'),
            'company_id'       => $request->input('company_id'),
            'country_id'       => $request->input('country_id'),
            'state_id'       => $request->input('state_id'),
            'city_id'       => $request->input('city_id'),
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

        $query  = jobs::where('id', $id)->update($update_arr);
        return redirect()->route('admin.jobs')
        ->with('success','Job Updated successfully.');
    }

    public function delete($id){
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $update_arr = array(
            'is_deleted'       => 1
        );
        $query  = jobs::where('id', $id)->update($update_arr);
        // Jobs::where('id',$id)->delete(); 
        return redirect()->route('admin.jobs')
        ->with('success','Job Deleted successfully.');
    }

    public function job_approved_manager($id){
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        
        $user_id = Auth::user()->id;
        $data = array(
            'approved_manager' => $user_id
        );
        $query = Jobs::where('id',$id)->update($data); 

        return redirect()->route('admin.jobs')
        ->with('success','Job Approved By Manager.');
    }

    public function job_approved_hr($id){
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        
        $user_id = Auth::user()->id;
        $data = array(
            'approved_hr' => $user_id
        );
        $query = Jobs::where('id',$id)->update($data); 

        return redirect()->route('admin.jobs')
        ->with('success','Job Approved By Hr.');
    }

    public function load_country(Request $request){
        $data['codestatus'] = true;
        $data['html'] = '';
        // $states = States::where('country_id',$request->id)->get();
        $states = BusinessLocations::join('countries','countries.id','=','business_locations.country_id')->where('business_locations.company_id',$request->id)->toSql();
        // print_r($request);
        echo $states;
        die();
        foreach($states as $state){
            $data['html'] .= "<option value='".$state->id."'>".$state->name."</option>";
        }
        return response()->json($data);
    }

    public function load_states(Request $request){
        $data['codestatus'] = true;
        $data['html'] = '';
        $country_id = $request->id;
        $compnay_id = $request->company_id;
        // $states = States::where('country_id',$request->id)->get();
        $states = BusinessLocations::join('states','states.id','=','business_locations.state_id')->where('company_id',$compnay_id)->where('business_locations.country_id',$country_id)->get();
        foreach($states as $state){
            $data['html'] .= "<option value='".$state->id."'>".$state->name."</option>";
        }
        return response()->json($data);

    }
}