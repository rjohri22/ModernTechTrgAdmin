<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Bend;
use App\Models\Admin\Rounds;
use App\Models\Admin\Departments;
use App\Models\Admin\QuestionBank;
use App\Models\Admin\InterviewRounds;
use App\Models\Admin\InterviewRoundQuestions;
// use App\Models\Admin\Companies;
// use App\Models\Admin\Countries;
// use App\Models\Admin\Question;

class InterviewRoundsController extends AdminBaseController
{
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
        $this->data['rows'] = InterviewRounds::selectRaw('
                                    interview_rounds.id,
                                    interview_rounds.profile_id,
                                    bends.name as profile,
                                    interview_rounds.interview_time,
                                    (
                                        SELECT 
                                            COUNT(id) 
                                        FROM 
                                            interview_round_questions 
                                        WHERE 
                                            interview_round_questions.interview_round_id = interview_rounds.id
                                    ) as no_question,
                                    (
                                        SELECT 
                                            COUNT(DISTINCT round_id) 
                                        FROM 
                                            interview_round_questions 
                                        WHERE 
                                            interview_round_questions.interview_round_id = interview_rounds.id
                                    ) as no_rounds
                                ')
                            ->leftJoin('bends','bends.id','=','interview_rounds.profile_id')   
                            ->get();
        return view('admin/interview_rounds/index',$this->data);
    }
    public function add(){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        $this->data['rounds'] = Rounds::get();
        $this->data['bends'] = Bend::where('status','1')->get();
        return view('admin/interview_rounds/add',$this->data);
    }
    public function store(Request $request){
        $rounds = $request->round_id;
        $round_questions = $request->round_questions;
        $interview_round = new InterviewRounds;
        $interview_round->profile_id = $request->profile;
        $interview_round->interview_time = $request->time;
        $interview_round->save();
        foreach($rounds as $key => $round){
            $qs = json_decode($round_questions[$key]);
            foreach($qs as $q){
                $ques_data = QuestionBank::where('id',$q)->get();
                $InterviewRoundQuestions = new InterviewRoundQuestions;
                $InterviewRoundQuestions->interview_round_id = $interview_round->id;
                $InterviewRoundQuestions->round_id = $round;
                $InterviewRoundQuestions->department_id = $ques_data[0]->department_id;
                $InterviewRoundQuestions->question = $ques_data[0]->question;
                $InterviewRoundQuestions->question_type = $ques_data[0]->question_type;
                $InterviewRoundQuestions->option_a = $ques_data[0]->option_a;
                $InterviewRoundQuestions->option_b = $ques_data[0]->option_b;
                $InterviewRoundQuestions->option_c = $ques_data[0]->option_c;
                $InterviewRoundQuestions->option_d = $ques_data[0]->option_d;
                $InterviewRoundQuestions->correct_answer = $ques_data[0]->correct_answer;
                $InterviewRoundQuestions->marks = $ques_data[0]->marks;
                $InterviewRoundQuestions->save();
            }
        }
        return redirect()->route('admin.interview_rounds');
    }
    public function questions(){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['departments'] = Departments::where('active','1')->get();
        $this->data['questions'] = QuestionBank::get();

        return view('admin/interview_rounds/questions_modal',$this->data);
    }
    public function questions_update(Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['round_id']  = $request->round_id;
        $this->data['sno']  = $request->sno;
        $this->data['selectQuestion']  = json_decode($request->questions);
        $this->data['departments'] = Departments::where('active','1')->get();
        $this->data['questions'] = QuestionBank::get();

        

        return view('admin/interview_rounds/questions_update_modal',$this->data);
    }


}