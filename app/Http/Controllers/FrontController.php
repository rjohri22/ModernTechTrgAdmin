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


    public function apply_for_job(Request $request){
        $user_id = Auth::user()->id;
        $update_arr = array(
            'oppertunity_id'           => $request->input('job_id'),
            'jobseeker_id'             => $user_id,
            'hod_id'                   => 0,
        );

        $query = Job_applications::insert($update_arr);
        return redirect()->route('attempt_interview')
        ->with('success','oppertunity created successfully.');
    }


    public function career(){
        $over_all = array();
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
        return view('career',$data);   
    }

    public function attempt_interview(){
        $data['questions'] = InterviewRoundQuestions::where('interview_round_id','2')->where('round_id','1')->get();
        return view('attempt_interview',$data); 
    }

    public function store_attempt_interview(Request $request){
        $question = InterviewRoundQuestions::where('interview_round_id','2')->where('round_id','1')->get(); 
        $data = array();
        $user_id = Auth::user()->id;
        foreach($question as $k => $q){
            $data[$k] = array(
                'user_id' => $user_id,
                'job_id' => '1',
                'round_id' => '1',
                'department_id' => '1',
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
                $data[$k]['user_answer'] = $request->input('correc_ans')[$k];
            }else{
                $data[$k]['user_answer'] = '';
            }

        }
        echo "<pre/>".print_r($data,1);
        // echo "<pre/>".print_r($_POST,1);
    }
}
?>