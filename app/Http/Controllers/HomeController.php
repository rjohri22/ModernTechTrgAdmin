<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee_educations;
use App\Models\Employee_works;
use App\Models\Employee_languages;
use App\Models\Employee_cirtificates;
use App\Models\Employee_sociallinks;
use App\Models\Job_applications;
use App\Models\Admin\Jobs;
use App\Models\Admin\Oppertunities;
use App\Models\Admin\InterviewRounds;
use App\Models\Admin\InterviewRoundQuestions;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Crypt;

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

        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        
        if($user->group_id == 1){
            Session::put('admin_login', 1);
            return redirect()->route('dashboard');
        }

        $basic_information = User::where('id', $user_id)->count();
        $education = Employee_educations::where('user_id', $user_id)->count();
        $work = Employee_works::where('user_id', $user_id)->count();
        $language = Employee_languages::where('user_id', $user_id)->count();
        $certificate = Employee_cirtificates::where('user_id', $user_id)->count();
        $link = Employee_sociallinks::where('user_id', $user_id)->count();
        
        $filled_modules = 0;
        $total_modules = 6;
        if($basic_information > 0){
            $filled_modules++;
        }
        if($education > 0){
            $filled_modules++;
        }
        if($work > 0){
            $filled_modules++;
        }
        if($language > 0){
            $filled_modules++;
        }
        if($certificate > 0){
            $filled_modules++;
        }
        if($link > 0){
            $filled_modules++;
        }

        $data['profile_completion'] = ($filled_modules/$total_modules)*100;
        $data['Jobs'] = Jobs::where('hr_head_approval','>','0')->get();
        // dd($data['Jobs']);
        $data['products'] = Job_applications::where('jobseeker_id', $user_id)->pluck('oppertunity_id')->toArray();
        // echo "Basic Information -->".$basic_information;
        // echo "Basic education -->".$education;
        // echo "Basic work -->".$work;
        // echo "Basic language -->".$language;
        // echo "Basic certificate -->".$certificate;
        // echo "Basic link -->".$link;
        // die();
        return view('home',$data);
    }

    // public function profile(){
    //     $user_id = Auth::user()->id;
    //     $data['user'] = User::where('id', $user_id)->first();
    //     $data['education'] = Employee_educations::where('user_id', $user_id)->get();
    //     $data['works'] = Employee_works::where('user_id', $user_id)->get();
    //     $data['language'] = Employee_languages::where('user_id', $user_id)->get();
    //     $data['certificate'] = Employee_cirtificates::where('user_id', $user_id)->get();
    //     $data['links'] = Employee_sociallinks::where('user_id', $user_id)->get();

    //     $ip = $_SERVER['REMOTE_ADDR'];
    //     // $ip = '39.48.206.112';
    //     $data['location'] = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    //     return view('auth/profile',$data);
    // }

    public function profile(){
        $user_id = Auth::user()->id;
        $data['user'] = User::where('id', $user_id)->first();
        $data['education'] = Employee_educations::where('user_id', $user_id)->get();
        $data['works'] = Employee_works::where('user_id', $user_id)->get();
        $data['language'] = Employee_languages::where('user_id', $user_id)->get();
        $data['certificate'] = Employee_cirtificates::where('user_id', $user_id)->get();
        $data['links'] = Employee_sociallinks::where('user_id', $user_id)->get();

        $ip = $_SERVER['REMOTE_ADDR'];
        // $ip = '39.48.206.112';
        $data['location'] = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        return view('auth/profile_new',$data);
    }

    public function store_profile(Request $request){
        $resume_attachment_name = $request->input('pre_resume_attachment');
        $profile_pic_name = $request->input('pre_profile_image');
        
        if($_FILES['resume_attachment']['size'] > 0){
            $resume_attachment_name = time().'.'.$request->resume_attachment->extension();
            $request->resume_attachment->move(public_path('images/resume'), $resume_attachment_name);
        }

        if($_FILES['profile_url']['size'] > 0){
            $profile_pic_name = time().'.'.$request->profile_url->extension();
            $request->profile_url->move(public_path('images/profile'), $profile_pic_name);
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
            'resume_attachment'     => $resume_attachment_name,
            'profile_pic'           => $profile_pic_name
        );
        $user_id = Auth::user()->id;
        $query  = User::where('id', $user_id)->update($update_arr);
        if($query){
            $res = array('status' => '1', 'message'=>'success', 'data' => $update_arr);
        }else{
            $res = array('status' => '0', 'message'=>'failed', 'data' => []);
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
        if(count((array)$institude_name) > 0){
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
        }else{
            $res = array('status' => '0', 'message'=>'failed');
        }
        echo json_encode($res);
    }

    public function store_work(Request $request){ 
        $compnay = $request->input('work_company');
        $del_ids = $request->input('work_del_id');
        $del_id = [];
        if($del_ids){
            $del_id = explode(',', $del_ids);
        }
        if(is_array($del_id)){
            unset($del_id[0]);
        }

        if(count($del_id) > 0){
            foreach($del_id as $id){
               Employee_works::where('id',$id)->delete(); 
            }
        }

        $user_id = Auth::user()->id;
        $data = array();
        if(count((array)$compnay) > 0){
            for($i=0; $i< count($compnay); $i++){
                if($request->input('insert_update')[$i] == 0){
                    $data[] = array(
                        'user_id' => $user_id,
                        'title' => $request->input('work_title')[$i],
                        'company' => $compnay[$i],
                        'country' => $request->input('work_country')[$i],
                        'state' => $request->input('work_state')[$i],
                        'city' => $request->input('work_city')[$i],
                        'period_from' => $request->input('work_from')[$i],
                        'period_to' => $request->input('work_to')[$i],
                        'description' => $request->input('work_description')[$i],
                    );
                }
            }
            $query = Employee_works::insert($data);
            if($query){
                $res = array('status' => '1', 'message'=>'success');
            }else{
                $res = array('status' => '0', 'message'=>'failed');
            }
        }else{
            $res = array('status' => '0', 'message'=>'failed');
        }
        echo json_encode($res);
    }

    public function store_language(Request $request){ 
        $title = $request->input('language_title');
        $del_ids = $request->input('language_del_id');
        $del_id = [];
        if($del_ids){
            $del_id = explode(',', $del_ids);
        }
        if(is_array($del_id)){
            unset($del_id[0]);
        }

        if(count($del_id) > 0){
            foreach($del_id as $id){
               Employee_languages::where('id',$id)->delete(); 
            }
        }
        $user_id = Auth::user()->id;
        $data = array();
        if(count((array)$title) > 0){
            for($i=0; $i< count($title); $i++){
                if($request->input('insert_update')[$i] == 0){
                    $data[] = array(
                        'user_id' => $user_id,
                        'title' => $title[$i],
                        'proficiency' => $request->input('language_profiency')[$i],
                    );
                }
            }
            $query = Employee_languages::insert($data);
            if($query){
                $res = array('status' => '1', 'message'=>'success');
            }else{
                $res = array('status' => '0', 'message'=>'failed');
            }
        }else{
            $res = array('status' => '0', 'message'=>'failed');
        }
        echo json_encode($res);
    }

    public function store_certificate(Request $request){ 
        $title = $request->input('certificate_title');
        $del_ids = $request->input('certificate_del_id');
        $del_id = [];
        if($del_ids){
            $del_id = explode(',', $del_ids);
        }
        if(is_array($del_id)){
            unset($del_id[0]);
        }

        if(count($del_id) > 0){
            foreach($del_id as $id){
               Employee_cirtificates::where('id',$id)->delete(); 
            }
        }
        $user_id = Auth::user()->id;
        $data = array();
        if(count((array)$title) > 0){
            for($i=0; $i< count($title); $i++){
                if($request->input('insert_update')[$i] == 0){
                    $data[] = array(
                        'user_id' => $user_id,
                        'title' => $title[$i],
                        'institute_name' => $request->input('certificate_institude')[$i],
                        'period_from' => $request->input('certificate_from')[$i],
                        'period_to' => $request->input('certificate_to')[$i],
                        'description' => $request->input('certificate_description')[$i],
                    );
                }
            }
            $query = Employee_cirtificates::insert($data);
            if($query){
                $res = array('status' => '1', 'message'=>'success');
            }else{
                $res = array('status' => '0', 'message'=>'failed');
            }
        }else{
            $res = array('status' => '0', 'message'=>'failed');
        }
        echo json_encode($res);
    }

    public function store_links(Request $request){ 
        $title = $request->input('link_title');
        $del_ids = $request->input('link_del_id');
        $del_id = [];
        if($del_ids){
            $del_id = explode(',', $del_ids);
        }
        if(is_array($del_id)){
            unset($del_id[0]);
        }

        if(count($del_id) > 0){
            foreach($del_id as $id){
               Employee_sociallinks::where('id',$id)->delete(); 
            }
        }
        $user_id = Auth::user()->id;
        $data = array();
        if(count((array)$title) > 0){
            for($i=0; $i< count($title); $i++){
                if($request->input('insert_update')[$i] == 0){
                    $data[] = array(
                        'user_id' => $user_id,
                        'title' => $title[$i],
                        'link' => $request->input('link_link')[$i],
                    );
                }
            }
            $query = Employee_sociallinks::insert($data);
            if($query){
                $res = array('status' => '1', 'message'=>'success');
            }else{
                $res = array('status' => '0', 'message'=>'failed');
            }
        }else{
            $res = array('status' => '0', 'message'=>'failed');
        }
        echo json_encode($res);
    }

    public function apply_job($id){
        $user_id = Auth::user()->id;
        $data['products'] = Job_applications::where('jobseeker_id', $user_id)->pluck('oppertunity_id')->toArray();
        $data['oppertunity'] = Jobs::where('id', $id)->first();
        return view('apply_job',$data);
    }

    public function thankyou(Request $request){
        // echo "asdsad";
        // die();
        $id = ($request->get('id')) ? $request->get('id') : null;
        if($id != null){
            $data['id'] = Crypt::decrypt($id);
        }
        else{
            $data['id'] = null;
        }
        return view('thankyou',$data);
    }

    public function store_apply_job($id, Request $request){
        $dates = $request->input('dates');
        $imp_date = implode(",",$dates);
        $user_id = Auth::user()->id;
        $update_arr = array(
            'oppertunity_id'           => $id,
            'jobseeker_id'             => $user_id,
            'hod_id'                   => 0,
            'js_interview_datetime'    => $imp_date,
            'status'                   => 0,
        );

        $query = Job_applications::insert($update_arr);
        return redirect()->route('thankyou')
        ->with('success','oppertunity created successfully.');
    }

    public function loginverification(){
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        if($user->group_id == 1){
            Session::put('admin_login', 1);
            return redirect()->route('dashboard');
            // return redirect('/admin/dashboard');
        }
        else{
            Session::put('admin_login', 2);
            return redirect('/career');
        }
    }

    public function myjobs(){
        $user_id = Auth::user()->id;
        $jobs = Job_applications::join('jobs','jobs.id','=','job_applications.oppertunity_id')->join('bends','bends.id','=','jobs.band_id')->join('countries','countries.id','=','jobs.country_id')->select(['jobs.*','countries.name as country','bends.name as band_name'])->where('job_applications.jobseeker_id','=',$user_id)->get();

        $over_all = array();
        foreach($jobs as $j){
            $interview_round = InterviewRounds::where('profile_id',$j->band_id)->first();
            
            $interview_round_question = InterviewRoundQuestions::join('rounds','rounds.id','=','interview_round_questions.round_id')->where('interview_round_questions.interview_round_id',$interview_round->id)->groupBy('interview_round_questions.round_id')->pluck('rounds.name')->toArray();
            // dd($interview_round_question);
            $j->rounds = $interview_round_question;
            $over_all[] = $j;
        }
        $data['jobs'] = $over_all;
        return view('jobs/myjob',$data);
    }

    public function apply_for_job(Request $request){
        $user_id = Auth::user()->id;
        $update_arr = array(
            'oppertunity_id'           => $request->input('job_id'),
            'relocate'                 => $request->input('reloaction'),
            'jobseeker_id'             => $user_id,
            'hod_id'                   => 0,
        );

        $query = Job_applications::create($update_arr);
        $id = $query->id;

        // return redirect()->route('attempt_interview',$id);
        return redirect()->route('thankyou',['id' => Crypt::encrypt($id)]);
    }
}
