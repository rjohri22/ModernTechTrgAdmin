<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Companies;
use App\Models\Admin\Countries;
use App\Models\Admin\InterviewObjectives;
use App\Models\Admin\Question;

class InterviewObjectivesController extends AdminBaseController
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

        $fetch = InterviewObjectives::get();
         $this->data['interviewobj'] = $fetch;
        return view('admin/interview_objectives/index',$this->data);
    }
    
    public function add(){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        
        $this->data['countries'] = Countries::get();
        return view('admin/interview_objectives/add',$this->data);
    }

    public function edit($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['countries'] = Countries::get();
        $this->data['interviewobj'] = InterviewObjectives::where('id',$id)->first();
        return view('admin/interview_objectives/edit',$this->data);
    }

    public function store(Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'title' => 'required|max:255',
            'round_1_mark' => 'required|max:255',
        ]);

        $insert_arr = array(
            'name'       => $request->input('title'),
            'round_1_passing_marks'    => $request->input('round_1_mark'),
            'round_2_passing_marks'    => $request->input('round_2_mark'),
            'round_3_passing_marks'    => $request->input('round_3_mark')
        );

        $query = InterviewObjectives::insert($insert_arr);
        return redirect()->route('admin.interview_objectives')
        ->with('success','Interview Objectives created successfully.');
    }

    public function update($id, Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

         $update_arr = array(
            'name'                     => $request->input('title'),
            'round_1_passing_marks'    => $request->input('round_1_mark'),
            'round_2_passing_marks'    => $request->input('round_2_mark'),
            'round_3_passing_marks'    => $request->input('round_3_mark')
        );

        $query  = InterviewObjectives::where('id', $id)->update($update_arr);
        return redirect()->route('admin.interview_objectives')
        ->with('success','Interview objectives Updated successfully.');
    }
    public function view($id)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $fetch = InterviewObjectives::where('id',$id)->first();
        $this->data['interviewobj'] = $fetch;
        return view('admin/interview_objectives/view',$this->data);
    }

    public function delete($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        InterviewObjectives::where('id',$id)->delete(); 
        return redirect()->route('admin.interview_objectives')
        ->with('success','Interview Objectives Deleted successfully.');
    }



    public function list_question($id, $round = null){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        if($round != null){
            $round_  = $round;
        }
        else{
            $round_ = 1;
        } 
        // dd($round);
        $fetch = Question::where('round_no',$round_)->where('interview_id',$id)->get();
         $this->data['questions'] = $fetch;
        // die();
         $this->data['interview_id'] = $id;
        return view('admin/interview_objectives/list_question',$this->data);
        
       
    }



    public function question($interview_id){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['interview_id'] = $interview_id;
        $this->data['interviewobj'] = InterviewObjectives::get();
        return view('admin/interview_objectives/questions',$this->data);
    }

    public function store_question(Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'question' => 'required|max:255',
            // 'round_1_mark' => 'required|max:255',
        ]);
       
        $this->data['interviewobj'] = InterviewObjectives::get();
      
        $insert_arr = array(
            'round_no'    => $request->input('round_no'),
            'question'    => $request->input('question'),
            'option_a'    => $request->input('option_a'),
            'option_b'    => $request->input('option_b'),
            'option_c'    => $request->input('option_c'),
            'option_d'    => $request->input('option_d'),
            'correct_answer'      => $request->input('correct_answer'),
            'marks'               => $request->input('marks'),
            'interview_id'        => $request->input('interview_id'),

        );
        
        $query = Question::insert($insert_arr);
        //return redirect()->route('admin.question_interview_objectives','interviewobj->id')
        return redirect()->route('admin.list_question',['id'=>$request->input('interview_id'),'round'=>'1'])
        ->with('success','Questions created successfully.');
    }

    public function edit_question($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['countries'] = Countries::get();
        $this->data['questions'] = Question::where('id',$id)->first();
        return view('admin/interview_objectives/edit_question',$this->data);
    }


    public function update_question($id, Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

         $update_arr = array(
            'round_no'    => $request->input('round_no'),
            'question'    => $request->input('question'),
            'option_a'    => $request->input('option_a'),
            'option_b'    => $request->input('option_b'),
            'option_c'    => $request->input('option_c'),
            'option_d'    => $request->input('option_d'),
            'correct_answer'      => $request->input('correct_answer'),
            'marks'               => $request->input('marks'),
        );

        $query  = Question::where('id', $id)->update($update_arr);
        return redirect()->back()->with('success', 'Questions Updated successfully'); 
        // return redirect()->route('admin.list_question',1)
        // ->with('success','Questions Updated successfully.');
    }

    public function delete_question($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        Question::where('id',$id)->delete(); 
        return redirect()->back()->with('success', 'Question Deleted successfully'); 
        // return back()->with('message','question Deleted successfully');
        // return redirect::back()->with('message','question Deleted successfully');
        // return redirect()->route('admin.list_question',1)
        // ->with('success','question Deleted successfully.');
    }


}