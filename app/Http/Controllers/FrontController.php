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
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\InterviewRounds;
use App\Models\Admin\InterviewRoundQuestions;
use App\Models\Admin\Bend;
use App\Models\Admin\Countries;
use App\Models\Admin\Companies;
use App\Models\Question_attempts;
use App\Models\Admin\JobInterviews;
use App\Models\GeneralModal;
use App\Models\Admin\JobStatusUpdates;
use App\Models\Admin\Calenders;
use Session;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  
    public function index()
    {

    }


    public function career(Request $request){
        $over_all = array();
        if(!Auth::check()) 
        {
            $user_id = null;

        }else{

            
            $user_id = Auth::user()->id;
        }
        $data['sprofile']= $request->profile;
        $data['skeyword']= $request->keyword;
        $data['sbusiness']= $request->business;
        $data['scountry']= $request->country;
        $jobs = Jobs::join('bends','bends.id','=','jobs.band_id');
        $jobs = $jobs->join('countries','countries.id','=','jobs.country_id');
        $jobs = $jobs->select(['jobs.*','countries.name as country','bends.name as band_name']);
        $jobs = $jobs->where('jobs.hr_head_approval','>','0');
        if(isset($request->keyword)){
            $jobs = $jobs->where('jobs.summery','like','%'.$request->keyword.'%');
        }
        if(isset($request->profile)){
            $jobs = $jobs->where('jobs.band_id','=',$request->profile);
        }
        if(isset($request->business)){
            $jobs = $jobs->where('jobs.company_id','=',$request->business);
        }
        if(isset($request->country)){
            $jobs = $jobs->where('jobs.country_id','=',$request->country);
        }
        $jobs = $jobs->where('jobs.is_deleted','=','0')->get();
        $data['profiles'] = Bend::where('status','=','1')->get();
        $data['countries'] = Countries::where('active','=','1')->get();
        $data['companies'] = Companies::where('status','=','1')->get();
        foreach($jobs as $j){
            $interview_round = InterviewRounds::where('profile_id',$j->band_id)->first();
            
            $interview_round_question = InterviewRoundQuestions::join('rounds','rounds.id','=','interview_round_questions.round_id')->where('interview_round_questions.interview_round_id',$interview_round->id)->groupBy('interview_round_questions.round_id')->pluck('rounds.name')->toArray();
            // dd($interview_round_question);
            $j->rounds = $interview_round_question;
            $over_all[] = $j;
        }

        // dd($over_all);
        $data['Jobs'] = $over_all;
        $data['products'] = Job_applications::where('jobseeker_id', $user_id)->pluck('oppertunity_id')->toArray();
        $data['interviewer'] = Job_applications::where('jobseeker_id', $user_id)->pluck('interviewer_id')->toArray();
        return view('career',$data);   
    }

    public function attempt_interview($job_id){
        $Job_application = Job_applications::where('id',$job_id)->first();
        $oppertunity = Jobs::where('id',$Job_application->oppertunity_id)->first();
        $job_seeker_round = JobInterviews::where('job_id',$oppertunity->id)->get()->toArray();
        $data['interview_round'] = $interview_round = Question_attempts::where('job_id',$job_id)->first();
        $rounds = Question_attempts::where('job_id',$job_id)->groupBy('round_id')->get()->pluck('round_id')->toArray();
        $duration = Question_attempts::where('job_id',$job_id)->groupBy('round_id')->get()->pluck('duration')->toArray();
        $disclaimer = Question_attempts::where('job_id',$job_id)->groupBy('round_id')->get()->pluck('disclaimer')->toArray();
        $total_round = count($rounds);
        if($Job_application->round_attempted > $total_round-1){
            $user_id = Auth::user()->id;
            $jsu = JobStatusUpdates::Leftjoin('users as u','u.id','=','job_status_updates.emp_id')->where('job_status_updates.jb_id',$user_id)->get(['job_status_updates.*','u.email as emp_email']);
            $user_details = User::where('id',$user_id)->first();
            $subject = "A Job Seeker Named ".$user_details->name." Has Cleared All The Round";
            $message = "Dear Consultant! This Email is To Notify You That The Job seeker named ".$user_details->name." Which Is Assigned to You has Cleared All The Round Now You Can Assign interview To it";
            foreach($jsu as $p){
                GeneralModal::send_email($p->emp_email,$subject,$message);
            }
            $html = "<strong>Congratulation!</strong><br>
                    <strong>You Have Passed All the Round</strong><br>
                    <p>We Will Contact you Shortly</p><br>
                    <a href='".route('career')."' class='btn btn-success text-white'>Return To Career Page</a><br>
                    ";
            return redirect()->route('thankyou')
            ->with('message',$html);
        }
        $total_question = $job_seeker_round[$Job_application->round_attempted]['total_questions'];
        $data['questions'] = Question_attempts::where('job_id',$job_id)->where('round_id',$rounds[$Job_application->round_attempted])->limit($total_question)->get();
        $data['job_id'] = $job_id;
        $data['duration'] = $duration[$Job_application->round_attempted];
        $data['disclaimer'] = $disclaimer[$Job_application->round_attempted];
        return view('attempt_interview',$data); 
    }

    public function store_attempt_interview($id, Request $request){
        $Job_application = Job_applications::where('id',$id)->first();
        $oppertunity = Jobs::where('id',$Job_application->oppertunity_id)->first();
        $rounds = Question_attempts::where('job_id',$id)->groupBy('round_id')->get()->pluck('round_id')->toArray();
        $job_seeker_round = JobInterviews::where('job_id',$oppertunity->id)->get()->toArray();
        $question = Question_attempts::where('job_id',$id)->where('round_id',$rounds[$Job_application->round_attempted])->get(); 
        $data = array();
        $user_id = Auth::user()->id;
        $round_passing_mark = $job_seeker_round[$Job_application->round_attempted]['passing_marks'];
        $obtained = 0;
        foreach($question as $k => $q){
            if($request->input('question_id')[$k] == $q->id){
                $data['user_answer'] = $request->input("correc_ans_".$q->id);
                if($q->question_type == '1'){
                    if($request->input("correc_ans_".$q->id) == $q->option_a){
                        $data['status'] = '1';
                        $obtained = $obtained+ $q->mark;
                    }else{
                        $data['status'] = '2';
                    }
                }else{
                    if($request->input("correc_ans_".$q->id) == $q->correct_answer){
                        $obtained = $obtained+ $q->mark;
                        $data['status'] = '1';
                    }else{

                        $data['status'] = '2';
                    }
                }
            }else{
                $data['user_answer'] = '';
                $data['status'] = '0';
            }
            $query = Question_attempts::where('id',$q->id)->update($data);
        }
        if($obtained >= $round_passing_mark){
            $round_attempted = $Job_application->round_attempted+1;
            $update = array(
                'round_attempted' =>$round_attempted,
                'status' => '1'
            );
            $update_q = Job_applications::where('id',$Job_application->id)->update($update);
        }
        if($obtained >= $round_passing_mark){
            $html = "<strong>Congratulation!</strong><br>
                    <strong>You Have Passed The Round</strong><br>
                    <a href='".route('attempt_interview',$id)."' class='btn btn-primary text-white'>Start Next Round</a><br>
                    ";
            return redirect()->route('thankyou')
            ->with('message',$html);
         }else{
            $html = "<strong>Sorry!</strong><br>
                    <strong>You Didnot Passed The Round</strong><br>
                    <a href='".route('career')."' class='btn btn-danger text-white'>Return To Career Page</a><br>
                    ";
            return redirect()->route('thankyou')
            ->with('message',$html);
         }
    }


    function jb_calender($interview_id,$job_id){
        $data['job_id'] = $job_id;
        $data['interviewr_id'] = $interview_id;
        return view('calendar',$data);   
    }

    function load_dates(Request $request){
        $start = date("Y-m-d", strtotime($request->get('start')));
        $end = date("Y-m-d", strtotime($request->get('end')));
        $user_id = $request->get('id');
        $final_arr = array();
        $stop = 0;
        while($start!=$end){
            $stop++;
            $start = date('Y-m-d', strtotime($start . ' +1 day'));
            $starttime = "08:30";
            for($i=1;$i<=17;$i++){
                $starttime = date('H:i', strtotime($starttime . ' +30 minutes'));
                $checktime = Calenders::where('date',$start)->where('time',$starttime)->first();
                if(!isset($checktime->id)){
                    $tempdata['date'] = $start;
                    $tempdata['time'] = $starttime;
                    $tempdata['title'] = 'Free';
                    $final_arr[] = $tempdata;
                }
            }

        }
        return response()->json($final_arr);
    }
    public function submit_calender(Request $request){
        $id = $request->id;
        $user_id = Auth::user()->id;
        $interviwe_id = $request->interviwe_id;
        $sdate = $request->sdate == "" ? array() : $request->sdate;
        $stime = $request->stime;
        $inteviewer_date = "";
        $inteviewer_date_email = "<ol>";
        
        foreach($sdate as $key => $val){
            if($key > 0){
                $inteviewer_date .= ",";
            }
            $inteviewer_date .= $sdate[$key]." ".$stime[$key];
            $inteviewer_date_email .= "<li>".$sdate[$key]." ".$stime[$key]."</li>";
        }
        $inteviewer_date_email .= "</ol>";
        if($inteviewer_date != ""){
            Job_applications::where('jobseeker_id', $user_id)
                ->where('oppertunity_id', $id)
                ->update(['js_interview_datetime' => $inteviewer_date,'status' => 2]);
            $interviewer = User::where('id',$interviwe_id)->first();
            $subject = "Job Seeker Date Selected for Interview";
            $message = "Dear Interviewer! Job Seeker Selected Date is:<br>".$inteviewer_date_email;
            GeneralModal::send_email($interviewer->email,$subject,$message);
            return redirect()->route('career')->with('success','Submit Successfully');
        }
        else{
            return redirect()->route('jb_calender',['id' => $interviwe_id,'jid'=>$id])->with('error_','Please Select Interviwe Date');
        }

    }
}
?>