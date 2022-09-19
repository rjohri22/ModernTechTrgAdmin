<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\Admin\Oppertunities;
use App\Models\Admin\Jobs;
use App\Models\User;
use App\Models\Admin\BendAssign;
use App\Models\Admin\Bend;
use App\Models\Admin\Companies;
use App\Models\Admin\Countries;
use App\Models\Admin\BusinessLocations;
use App\Models\Admin\InterviewObjectives;
use App\Models\Admin\InterviewRoundQuestions;
use App\Models\Admin\InterviewRounds;
use App\Models\Admin\JobInterviews;
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
	public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $user_id = Auth::user()->id;
        $fetch = Jobs::join('companies', 'companies.id', '=', 'jobs.company_id')
        ->join('countries','countries.id','=','jobs.country_id')
        ->join('states','states.id','=','jobs.state_id')
        ->join('cities','cities.id','=','jobs.city_id')
        ->join('users','users.id','=','jobs.modified_by');

        
        $this->data['master_bend'] = true;

        $this->data['login_details'] = $login_details = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();

        // dd($login_details);
        $mas_ben = BendAssign::where('child_id',$this->data['login_details']->id)->count();

        if(!empty($login_details)){
            $childres = BendAssign::where('parent_id',$this->data['login_details']->id)->get()->pluck('child_id');
            $childres[] = $this->data['login_details']->id;
            // dd($childres);

            if($this->data['login_details']->name != 'HR Manager' && $this->data['login_details']->name != 'Country Head' && $this->data['login_details']->name != 'HR Manager Head' ){
                // dd($childres);
                $fetch = $fetch->wherein('users.bend_id',$childres);
            }else{

                // if($mas_ben > 0){
                   $fetch = $fetch->where('jobs.approved_manager','!=',null); 
                   $fetch = $fetch->orWhere('jobs.modified_by','=',$login_details->user_id); 
                    $fetch = $fetch->orWherein('users.bend_id',$childres);
                   // $fetch = $fetch->where('jobs.modified_by','=',$login_details->user_id); 
                // }
            }
        }
        
        $fetch = $fetch->where('jobs.is_deleted','=',0);

        $fetch = $fetch->get(['jobs.*', 'companies.name as company_name', 'countries.name as country_name','states.name as state_name','cities.name as city_name','users.first_name']);
        $this->data['jobs'] = $fetch;

        // dd($mas_ben);
        // die();
        if($mas_ben > 0){
            $this->data['master_bend'] = false;
        }
        // $this->data['childrens'] = $childres;

        return view('admin/jobs/index',$this->data);
    }



    public function assign_objective($job_id)
    {

        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['objectives'] = InterviewObjectives::get();
        $this->data['job_id'] = $job_id;
        return view('admin/jobs/assign_test',$this->data);
    }

    public function approve_hr($job_id)
    {

        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };   
        // $this->data['objectives'] = InterviewObjectives::get();
        $this->data['job_id'] = $job_id;
        return view('admin/jobs/approve_hr',$this->data);
    }

    public function store_approv_hr($job_id , Request $request){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $validated = $request->validate([
            'work_type' => 'required|max:255',
            'work_shift' => 'required|max:255',
            'work_style' => 'required|max:255',
            'hr_remark' => 'required|max:255',
        ]);

        $user_id = Auth::user()->id;
        $update_arr = array(
            'work_type'         => $request->input('work_type'),
            'work_shift'       => $request->input('work_shift'),
            'work_style'       => $request->input('work_style'),
            'hr_remarks'       => $request->input('hr_remark'),
            'approved_hr'     => $user_id,
        );

        $query  = jobs::where('id', $job_id)->update($update_arr);
        return redirect()->route('admin.jobs')
        ->with('success','Job Updated successfully.');
    }


    public function store_approv_country($job_id , Request $request){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $validated = $request->validate([
            'min_salary' => 'required|max:255',
            'max_salary' => 'required|max:255',
            'wages' => 'required|max:255',
            'compensation_mode' => 'required|max:255',
        ]);

        $user_id = Auth::user()->id;
        $update_arr = array(
            'min_salary'         => $request->input('min_salary'),
            'max_salary'       => $request->input('max_salary'),
            'salary_type'       => $request->input('wages'),
            'compensation_mode'       => $request->input('compensation_mode'),
            'country_head_approval'     => $user_id,
        );

        $query  = jobs::where('id', $job_id)->update($update_arr);
        return redirect()->route('admin.jobs')
        ->with('success','Job Updated successfully.');
    }

    public function store_approv_hr_head($job_id , Request $request){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'round_id' => 'required|max:255',
            'round_1_question' => 'required|max:255',
            'round_1_pass_mark' => 'required|max:255',
        ]);

        $oppertunity_id = 'A-O-';
        $query  = jobs::where('id', $job_id)->first();
        if($query->compensation_mode == 'base_commission'){
            $oppertunity_id .= 'B-';
        }
        if($query->compensation_mode == 'solely_salary'){
            $oppertunity_id .= 'S-';

        }
        if($query->compensation_mode == 'commission'){
            $oppertunity_id .= 'C-';
        }

        $create_date = date('Y-m-d',strtotime($query->created_at));
        $month = date('m',strtotime($create_date));
        $year = date('Y',strtotime($create_date));
        if($month == '04'){ // APRIL
            $oppertunity_id .= 'Q1-A1-';   
        }
        else if($month == '05'){ // MAY
            $oppertunity_id .= 'Q1-A2-';   
        }
        else if($month == '06'){ // JUNE
            $oppertunity_id .= 'Q1-A3-';   
        }
        else if($month == '07'){ //JULY
            $oppertunity_id .= 'Q2-B1-';   
        }
        else if($month == '08'){ //AUGEST
            $oppertunity_id .= 'Q2-B2-';   
        }
        else if($month == '09'){ //SEPTEMBER
            $oppertunity_id .= 'Q2-B3-';   
        }

        else if($month == '10'){ //OCToBER
            $oppertunity_id .= 'Q3-C1-';   
        }

        else if($month == '11'){ //NOVEMBER
            $oppertunity_id .= 'Q3-C2-';   
        }
        else if($month == '12'){ //DECEMBER
            $oppertunity_id .= 'Q3-C3-';   
        }
        else if($month == '01'){ //NOVEMBER
            $oppertunity_id .= 'Q4-D1-';   
        }
        else if($month == '02'){ //NOVEMBER
            $oppertunity_id .= 'Q4-D2-';   
        }
        else if($month == '03'){ //NOVEMBER
            $oppertunity_id .= 'Q4-D3-';   
        }
        $oppertunity_id .= $year;
        $user_id = Auth::user()->id;
        $int_rou = array();
        for($i = 0; $i < count($request->input('round_id')) ; $i++){
            $int_rou[] = array(
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'job_id' => $job_id,
                'round_id' => $request->input('round_id')[$i],
                'passing_marks' => $request->input('round_1_pass_mark')[$i],
                'total_questions' => $request->input('round_1_pass_mark')[$i],
            );
        }

        $store = JobInterviews::insert($int_rou);
        $update_arr = array(
            // 'round_1_question'         => $request->input('round_1_question'),
            // 'round_2_question'       => $request->input('round_2_question'),
            // 'round_3_question'       => $request->input('round_3_question'),
            // 'round_1_pass_mark'       => $request->input('round_1_pass_mark'),
            // 'round_2_pass_mark'     => $request->input('round_2_pass_mark'),
            // 'round_3_pass_mark'     => $request->input('round_3_pass_mark'),
            'hr_head_approval'     => $user_id,
            'oppertunity_id'     => $oppertunity_id,
        );

        $query  = jobs::where('id', $job_id)->update($update_arr);
        return redirect()->route('admin.jobs')
        ->with('success','Job Updated successfully.');
    }

    public function add()
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        
        $user_id = Auth::user()->id;
        $user_details = User::where('id',$user_id)->first();
        $my_bend = Bend::where('id',$user_details->bend_id)->first();
        $bend_details = Bend::get();
        $this->data['job_descrtiption'] = Oppertunities::get();
        $this->data['objectives'] = InterviewObjectives::get();
        $this->data['companies'] = Companies::where('status','1')->get();
        $this->data['countries'] = Countries::get();

        // $this->data['countries'] = Countries::get();
        $this->data['bend_details'] = $bend_details;
        $this->data['my_bend'] = $my_bend;
        return view('admin/jobs/add',$this->data);
    }


    public function getcountry()
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        

        $this->data['job_descrtiption'] = Oppertunities::get();
        $this->data['companies'] = Companies::where('status','1')->get();
        $this->data['countries'] = Countries::join('business_locations', 'business_locations.country_id', '=', 'countries.id')->groupby('business_locations.country_id')->get();
        // $this->data['countries'] = Countries::get();
        return view('admin/jobs/add',$this->data);
    }






    public function edit($id)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['countries'] = Countries::get();
        $this->data['job'] = jobs::where('id',$id)->first();
        if($this->data['job']->approved_hr == null){
            $user_id = Auth::user()->id;
            $user_details = User::where('id',$user_id)->first();
            $bend_details = Bend::where('id',$user_details->bend_id)->first();
            $this->data['companies'] = Companies::where('status','1')->get();
            $this->data['oppertunity'] = Oppertunities::where('id', $id)->first();
            $this->data['countries'] = Countries::get();
            $this->data['bend_details'] = $bend_details;
            return view('admin/jobs/edit',$this->data);
        }
        else{
            return redirect()->route('admin.jobs');
        }
    }

    public function view($id)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $fetch = Jobs::join('companies', 'companies.id', '=', 'jobs.company_id')->join('countries','countries.id','=','jobs.country_id')->join('states','states.id','=','jobs.state_id')->join('cities','cities.id','=','jobs.city_id')
                ->select(['jobs.*', 'companies.name as company_name', 'countries.name as country_name','states.name as state_name','cities.name as city_name'])->where('jobs.id',$id)->first();
        // $fetch = Oppertunities::Leftjoin('companies', 'companies.id', '=', 'oppertunities.company_id')
                // ->get(['oppertunities.*', 'companies.name as company_name'])->where('id',$id)->first();
        $this->data['job'] = $fetch;
        return view('admin/jobs/view',$this->data);
    }

    public function store(Request $request)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
           // 'jd' => 'required',
            'company_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
           // 'no_of_positions' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $user_details = User::where('id',$user_id)->first();
        $bend_details = Bend::where('id',$user_details->bend_id)->first();
        $level = $bend_details->level;
        $job_descrtiption_id = $request->input('jd');


        // $oppertunity = Oppertunities::where('id',$job_descrtiption_id)->first();
        $oppertunity = Oppertunities::where('bend_id',$request->input('bend_id'))->first();
        $oppertunity_count = Oppertunities::where('bend_id',$request->input('bend_id'))->count();
        if($oppertunity_count == 0){
            return redirect()->route('admin.jobs')
        ->with('error_','Job Application For This Profile is not Created');
        }
        $update_arr = array(
           // 'title'         => $oppertunity->title,
            'job_unique_id'       => "TRG-".$request->input('job_unique_id').'-'.date('HisY'),
            'band_id'       => $request->input('bend_id'),
            'company_id'    => $request->input('company_id'),
            'country_id'    => $request->input('country_id'),
            'state_id'      => $request->input('state_id'),
            'city_id'       => $request->input('city_id'),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            // 'no_of_positions' => $request->input('no_of_positions'),
            // 'min_salary'    => $oppertunity->min_salary,
            // 'max_salary'    => $oppertunity->max_salary,
            // 'salary_type'   => $oppertunity->salary_type,
           // 'job_type'      => $oppertunity->job_type,
            // 'work_type'     => $oppertunity->work_type,
            // 'expires_on'    => $oppertunity->expires_on,
      // 'no_of_positions'  => $oppertunity->no_of_positions,
            // 'urgent_hiring' => $oppertunity->urgent_hiring,
            // 'status'        => 0,
            'summery'       => ($oppertunity->summery) ? $oppertunity->summery : "",
            'description'   => ($oppertunity->description) ? $oppertunity->description : "",
            'daily_job'   => ($oppertunity->daily_job) ? $oppertunity->daily_job : "",
            'responsibilities'   => ($oppertunity->Responsibilities) ? $oppertunity->Responsibilities : "",
            'modified_by'   => $user_id,
        );
        
        if($level > 4){
            $update_arr['approved_manager'] =  $user_id;
            $update_arr['approved_hr'] =  $user_id;
            $update_arr['work_shift'] =  $request->input('work_shift');
            $update_arr['work_style'] =  $request->input('work_style');
            $update_arr['work_type'] =  $request->input('work_type');
            $update_arr['hr_remarks'] =  $request->input('hr_remark');
            // $update_arr['objective_id'] =  $request->input('objective');
            // $update_arr['round_1_question'] =  $request->input('round_1');
            // $update_arr['round_2_question'] =  $request->input('round_2');
            // $update_arr['round_3_question'] =  $request->input('round_3');
        }
        if(isset($request->savedraft)){
            $update_arr['is_draft'] = 1;
        }
        $query = Jobs::insert($update_arr);
        return redirect()->route('admin.jobs')
        ->with('success','Job created successfully.');
    }

    public function publish($id)
    {
        $this->loadBaseData();
        $update_arr['is_draft'] = 0;
        $query  = Jobs::where('id', $id)->update($update_arr);
        return redirect()->route('admin.jobs')
        ->with('success','Jobs Updated successfully.');

    }


    public function update($id, Request $request)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
           // 'jd' => 'required',
            'company_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
           // 'no_of_positions' => 'required',
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
            // 'status'            => $request->input('status'),
            'summery'           => $request->input('summery'),
            'description'       => $request->input('description'),
            'updated_at'    => date('Y-m-d H:i:s'),
        );

        $query  = jobs::where('id', $id)->update($update_arr);
        return redirect()->route('admin.jobs')
        ->with('success','Job Updated successfully.');
    }

    public function delete($id){
        $this->loadBaseData();
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
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        
        $user_id = Auth::user()->id;
        $this->data = array(
            'approved_manager' => $user_id
        );
        $query = Jobs::where('id',$id)->update($this->data); 

        return redirect()->route('admin.jobs')
        ->with('success','Job Approved By Manager.');
    }

    public function job_approved_hr($id, Request $request){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        
        $user_id = Auth::user()->id;
        $interview_id = $request->input('interview_id');
        $round_1 = $request->input('round_1');
        $round_2 = $request->input('round_2');
        $round_3 = $request->input('round_3');
        $this->data = array(
            'approved_hr' => $user_id,
            'objective_id' => $interview_id,
            'round_1_question' => $round_1,
            'round_2_question' => $round_2,
            'round_3_question' => $round_3
        );
        $query = Jobs::where('id',$id)->update($this->data); 

        return redirect()->route('admin.jobs')
        ->with('success','Job Approved By Hr.');
    }

    public function load_country(Request $request){
        $this->loadBaseData();
        $this->data['codestatus'] = true;
        $this->data['html'] = '';
        // $states = States::where('country_id',$request->id)->get();
        $states = BusinessLocations::join('countries','countries.id','=','business_locations.country_id')->where('business_locations.company_id',$request->id)->toSql();
        // print_r($request);
        echo $states;
        die();
        foreach($states as $state){
            $this->data['html'] .= "<option value='".$state->id."'>".$state->name."</option>";
        }
        return response()->json($this->data);
    }

    public function load_states(Request $request){
        $this->loadBaseData();
        $this->data['codestatus'] = true;
        $this->data['html'] = '';
        $country_id = $request->id;
        $compnay_id = $request->company_id;
        // $states = States::where('country_id',$request->id)->get();
        $states = BusinessLocations::join('states','states.id','=','business_locations.state_id')->where('company_id',$compnay_id)->where('business_locations.country_id',$country_id)->get();
        foreach($states as $state){
            $this->data['html'] .= "<option value='".$state->id."'>".$state->name."</option>";
        }
        return response()->json($this->data);

    }


    public function load_interview_round_for_hr(Request $request){
        $this->loadBaseData();
        $this->data['codestatus'] = true;
        $bend_id = $request->bend_id;
        $interview_round = InterviewRounds::where('profile_id',$bend_id)->first();
        $interview_round_question = InterviewRoundQuestions::join('rounds','rounds.id','=','interview_round_questions.round_id')->where('interview_round_questions.interview_round_id',$interview_round->id)->groupBy('interview_round_questions.round_id')->get();
        $this->data['data'] = $interview_round_question;
        return response()->json($this->data);

    }

//approved jobs
public function approved()
{   
    $this->loadBaseData();
    if(!$this->check_role()){
        return redirect()->route('home');
    };

    $user_id = Auth::user()->id;
    $fetch = Jobs::join('companies', 'companies.id', '=', 'jobs.company_id')
    ->join('countries','countries.id','=','jobs.country_id')
    ->join('states','states.id','=','jobs.state_id')
    ->join('cities','cities.id','=','jobs.city_id')
    ->join('users','users.id','=','jobs.modified_by');


    $this->data['master_bend'] = true;

    $this->data['login_details'] = $login_details = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();

    
    if(!empty($login_details)){
        $childres = BendAssign::where('parent_id',$this->data['login_details']->id)->get()->pluck('child_id');
        $childres[] = $this->data['login_details']->id;

        if($this->data['login_details']->name != 'HR Manager'){
            // dd($childres);
            $fetch = $fetch->wherein('users.bend_id',$childres);
        }else{
           $fetch = $fetch->where('jobs.approved_manager','!=',null); 
        }
    }
    
    $fetch = $fetch->where('jobs.is_deleted','=',0);
    $fetch = $fetch->where('jobs.approved_manager','!=',null);
    $fetch = $fetch->where('jobs.approved_hr','!=',null);
    $fetch = $fetch->get(['jobs.*', 'companies.name as company_name', 'countries.name as country_name','states.name as state_name','cities.name as city_name','users.first_name']);
    $this->data['jobs'] = $fetch;

    $mas_ben = BendAssign::where('child_id',$this->data['login_details']->id)->count();

    if($mas_ben > 0){
        $this->data['master_bend'] = false;
    }
    // $this->data['childrens'] = $childres;
    $this->data['approved'] = 1;
    return view('admin/jobs/index',$this->data);
}



}