<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralModal;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\Job_applications;
use App\Models\Admin\Companies;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Bend;
use App\Models\Admin\Jobs;
use App\Models\User;
use App\Models\Question_attempts;
use App\Models\Admin\InterviewRounds;
use App\Models\Admin\InterviewRoundQuestions;

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
        $this->data['userbend'] = Bend::where('id',$this->data['userdata']->bend_id)->first();
        $fetch = Job_applications::selectRaw('
            job_applications.id,
            bends.name as profile_name,
            CONCAT(users.first_name,users.last_name) as job_seeker,
            job_applications.created_at,
            CONCAT(inter.first_name,inter.last_name) interviewer,
            IF(job_applications.status = 0, "Pending", IF(job_applications.status = 1,"Job Taking",IF(job_applications.status = 2,"Interview",IF(job_applications.status = 3,"Hired","Rejected")))) as status
        ');
        $fetch = $fetch->join('jobs', 'jobs.id', '=', 'job_applications.oppertunity_id');
        $fetch = $fetch->join('users','users.id','=','job_applications.jobseeker_id');
        $fetch = $fetch->LeftJoin('users as inter','inter.id','=','job_applications.interviewer_id');
        if($this->data['userbend']->level < 10){
            $fetch = $fetch->join('job_status_updates', 'job_status_updates.jb_id', '=', 'job_applications.jobseeker_id');
        }
        $fetch = $fetch->join('bends','bends.id','=','jobs.band_id');
        if($this->data['userbend']->level < 10){
            $fetch = $fetch->where('job_status_updates.emp_id',$this->data['userdata']->id);
        }
        $fetch = $fetch->get();
        $this->data['applicatoins'] = $fetch;
        $this->data['employeess'] = User::where('group_id',1)->get();
        return view('admin/job_applications/index',$this->data);

    }
    public function view($id){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['jobapplication'] = Job_applications::where('id',$id)->first();
        $this->data['job'] = Jobs::selectRaw('
            jobs.*,
            countries.name as country,
            states.name as state,
            cities.name as city,
            bends.name as profile,
            companies.name as company
        ')
        ->LeftJoin('companies','companies.id','=','jobs.company_id')
        ->LeftJoin('countries','countries.id','=','jobs.country_id')
        ->LeftJoin('states','states.id','=','jobs.state_id')
        ->LeftJoin('cities','cities.id','=','jobs.city_id')
        ->LeftJoin('bends','bends.id','=','jobs.band_id')
        ->where('jobs.id',$this->data['jobapplication']->oppertunity_id)
        ->first();

        $this->data['jobseeker'] = User::where('id',$this->data['jobapplication']->jobseeker_id)->first();
        $this->data['rounds'] = Question_attempts::selectRaw('
                                        question_attempts.round_id,
                                        rounds.name,
                                        COUNT(question_attempts.question) as no_o_questions,
                                        SUM(CASE WHEN question_attempts.status != 0 THEN 1 ELSE 0 END) as attem_questions,
                                        SUM(question_attempts.mark) as total_marks,
                                        IFNULL((
                                            SELECT ji.passing_marks 
                                            FROM job_interviews AS ji 
                                            WHERE 
                                                ji.job_id =  '.$this->data['jobapplication']->oppertunity_id.' AND
                                                ji.round_id =  question_attempts.round_id
                                        ),0) as passing_marks,
                                        SUM(CASE WHEN question_attempts.status = 1 THEN question_attempts.mark ELSE 0 END) as obtain_marks
                                    ')
                                    ->LeftJoin('rounds','rounds.id','=','question_attempts.round_id')
                                    ->where('job_id',$this->data['jobapplication']->id)
                                    ->groupBy('question_attempts.round_id')
                                    ->get();
        $this->data['interviewer'] = User::where('id',$this->data['jobapplication']->interviewer_id)->first();
        // print_r($this->data['jobapplication']);
        // exit();
        return view('admin/job_applications/view',$this->data);
    }
    public function attemquestion(Request $request){
        $this->data['questions'] = Question_attempts::where('job_id',$request->jaid)
                                        ->where('round_id',$request->rid)
                                        ->where('user_id',$request->uid)
                                        ->get();
        return view('admin/job_applications/attem_questions',$this->data);
    }
    public function assign(Request $request){
        $jas = $request->ja;
        $emp_id = $request->emp_id;
        $interviewer = User::where('id',$emp_id)->first();
        $jobseekers = array();
        foreach($jas as $ja){
            $jobapplication = Job_applications::find($ja);
            $jobapplication->interviewer_id = $emp_id;
            $jobapplication->save();
            $jobseeker = User::where('id',$jobapplication->jobseeker_id)->first();
            $jobseekers[] = $jobseeker;
            $subject = "Interview Assigned";
            $message = "Dear Jobseeker! This Email is To Notify You That The Interviewer named ".$interviewer->name." Which Is Assigned. Please confirm your interview <a href='".url('calender/'.$emp_id)."'>Click Herer</>";
            GeneralModal::send_email($jobseeker->email,$subject,$message);
        }
        if(count($jobseekers) > 0){
            $subject = "Job Seeker Assigned";
            $message = "Dear Interviewer! This Email is To Notify You That The Job Seeker Is Assigned.<ol>";
            foreach($jobseekers as $jk){
                $message .= "<li>".$jk->name."</li>";
            }
            $message .= "</ol>";
            GeneralModal::send_email($interviewer->email,$subject,$message);
        }
        if(count($jas) == 0){
            return redirect()->route('admin.jobapplications')->with('error_','Please Select Job Applications');
        }else{
            return redirect()->route('admin.jobapplications')->with('success','Assigned Successfully.');
        }



    }

    

}