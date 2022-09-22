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
        return view('career',$data);   
    }

    public function attempt_interview($job_id){
        $Job_application = Job_applications::where('id',$job_id)->first();
        $oppertunity = Jobs::where('id',$Job_application->oppertunity_id)->first();
        // $band_details = Bends::where('id',$oppertunity->band_id);
        // $interview_round = InterviewRounds::where('profile_id',$oppertunity->band_id)->first();
        $job_seeker_round = JobInterviews::where('job_id',$oppertunity->id)->get()->toArray();
        
        // $round_passing_mark = $job_seeker_round[$Job_application->round_attempted]['passing_marks'];
        


        $data['interview_round'] = $interview_round = InterviewRounds::where('profile_id',$oppertunity->band_id)->first();

        $rounds = InterviewRoundQuestions::where('interview_round_id',$interview_round->id)->groupBy('round_id')->get()->pluck('round_id')->toArray();

        $duration = InterviewRoundQuestions::where('interview_round_id',$interview_round->id)->groupBy('round_id')->get()->pluck('interview_time')->toArray();

        $disclaimer = InterviewRoundQuestions::where('interview_round_id',$interview_round->id)->groupBy('round_id')->get()->pluck('disclaimer')->toArray();

        // dd($duration);
        $total_round = count($rounds);
        // dd($total_round);
        // dd($Job_application->round_attempted); 
        
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
        $data['questions'] = InterviewRoundQuestions::where('interview_round_id',$interview_round->id)->where('round_id',$rounds[$Job_application->round_attempted])->limit($total_question)->get();

        $data['job_id'] = $job_id;
        $data['duration'] = $duration[$Job_application->round_attempted];
        $data['disclaimer'] = $disclaimer[$Job_application->round_attempted];
        return view('attempt_interview',$data); 
    }

    public function store_attempt_interview($id, Request $request){
        $Job_application = Job_applications::where('id',$id)->first();
        $oppertunity = Jobs::where('id',$Job_application->oppertunity_id)->first();
        $interview_round = InterviewRounds::where('profile_id',$oppertunity->band_id)->first();
        $rounds = InterviewRoundQuestions::where('interview_round_id',$interview_round->id)->groupBy('round_id')->get()->pluck('round_id')->toArray();
        $job_seeker_round = JobInterviews::where('job_id',$oppertunity->id)->get()->toArray();
        
        $question = InterviewRoundQuestions::where('interview_round_id',$interview_round->id)->where('round_id',$rounds[$Job_application->round_attempted])->get(); 

        $data = array();
        $user_id = Auth::user()->id;

        $round_passing_mark = $job_seeker_round[$Job_application->round_attempted]['passing_marks'];
        
        // dd($round_passing_mark);

        $obtained = 0;
        foreach($question as $k => $q){




            $data[$k] = array(
                'user_id' => $user_id,
                'job_id' => $id,
                'round_id' => $q->round_id,
                'duration' => $q->duration,
                'department_id' => $q->department_id,
                'question' => $q->question,
                'question_type' => $q->question_type,
                'option_a' => $q->option_a,
                'option_b' => $q->option_b,
                'option_c' => $q->option_c,
                'option_d' => $q->option_d,
                'correct_answer' => $q->correct_answer,
                'mark' => $q->marks
            );
            if($request->input('question_id')[$k] == $q->id){
                $data[$k]['user_answer'] = $request->input("correc_ans_".$q->id);
                if($q->question_type == '1'){
                    if($request->input('correc_ans')[$k] == $q->option_a){
                        $obtained = $obtained+ $q->marks;
                    }
                }else{
                    if($request->input("correc_ans_".$q->id) == $q->correct_answer){
                        $obtained = $obtained+ $q->marks;
                    }
                }
                // else{
                //     $obtained = $obtained - $q->marks;
                // }
            }else{
                $data[$k]['user_answer'] = '';
                // $obtained = $obtained - $q->marks;
            }

        }
        
        if($obtained >= $round_passing_mark){
            $round_attempted = $Job_application->round_attempted+1;
            $update = array(
                'round_attempted' =>$round_attempted
            );
            $update_q = Job_applications::where('id',$Job_application->id)->update($update);
        }
        $query = Question_attempts::insert($data);

         if($obtained >= $round_passing_mark){
            $html = "<strong>Congratulation!</strong><br>
                    <strong>You Have Passed The Round</strong><br>
                    <a href='".route('attempt_interview',$id)."' class='btn btn-primary text-white'>Start Next Round</a><br>
                    ";
            return redirect()->route('thankyou')
            ->with('message',$html);
            // return redirect()->route('attempt_interview',$id)
            // ->with('success','success');
         }else{
            $html = "<strong>Sorry!</strong><br>
                    <strong>You Didnot Passed The Round</strong><br>
                    <a href='".route('career')."' class='btn btn-danger text-white'>Return To Career Page</a><br>
                    ";
            return redirect()->route('thankyou')
            ->with('message',$html);
            // return redirect()->route('attempt_interview',$id)
            // ->with('error_','error_');

         }
        // echo "<pre/>".print_r($data,1);
        // echo "<pre/>".print_r($_POST,1);
    }



    // function thankyou(){
    //     return view('thankyou',$data);   
    // }
}
?>