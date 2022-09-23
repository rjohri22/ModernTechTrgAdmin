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
use App\Models\Admin\Bends;
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


    public function career(){
        $over_all = array();
        if(!Auth::check()) 
        {
            $user_id = null;

        }else{

            
            $user_id = Auth::user()->id;
        }
        $jobs = Jobs::join('bends','bends.id','=','jobs.band_id')->join('countries','countries.id','=','jobs.country_id')->select(['jobs.*','countries.name as country','bends.name as band_name'])->where('jobs.hr_head_approval','>','0')->get();
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
                    if($request->input('correc_ans')[$k] == $q->option_a){
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


    function jb_calender($interview_id){
        $data['interviewr_id'] = $interview_id;
        return view('calendar',$data);   
    }

    function load_dates(Request $request){
        $start = $request->get('start');
        $end = $request->get('end');
        $user_id = $request->get('id');
        // $tasks = Calenders::where('emp_id',$user_id)->where('date','>=',$start)->where('date','<',$end)->toSql();
        $date_arr = $this->createDateRangeArray(date('Y-m-d',strtotime($start)), date('Y-m-d',strtotime($end)));
        // echo "<pre/>".print_r($date_arr,1);
        // die();
        $final_arr = array();
        foreach($date_arr as $k => $d){
            $start_time = strtotime('08:30');
            for($i=0; $i < 17; $i++){
                $start_time_2 = date('H:i',strtotime('+30 minutes',$start_time)); 
                $start_time = strtotime($start_time_2);
                $tasks = Calenders::where('emp_id','=',$user_id)->where('date',$d)->where('time',$start_time_2)->count();
                // echo $tasks;
                if($tasks == 0){
                    $final_arr[$i]['date'] = $d;
                    $final_arr[$i]['time'] = $start_time_2;
                    $final_arr[$i]['title'] = 'free';
                }
            }
        }
        // echo "<pre/>".print_r($final_arr,1);
        // die();
        return response()->json($final_arr);
    }


    function createDateRangeArray($strDateFrom,$strDateTo)
    {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange = [];

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }
        return $aryRange;
    }



    // function thankyou(){
    //     return view('thankyou',$data);   
    // }
}
?>