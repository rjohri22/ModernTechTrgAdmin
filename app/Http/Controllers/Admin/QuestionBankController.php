<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Companies;
use App\Models\Admin\Departments;
use App\Models\Admin\QuestionBank;
use App\Models\Admin\Question;

class QuestionBankController extends AdminBaseController
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
        $this->data['questions'] = QuestionBank::join('departments','departments.id','=','question_banks.department_id')->get();
        return view('admin/question_banks/index',$this->data);

    }

    public function add(){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['department'] = Departments::get();
        return view('admin/question_banks/add',$this->data);
    }

    public function edit($id){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['question'] = QuestionBank::where('id',$id)->first();
        $this->data['department'] = Departments::get();
        return view('admin/question_banks/edit',$this->data);
    }

    public function store(Request $request){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'department' => 'required|max:255',
            'question_type' => 'required|max:255',
            'question' => 'required|max:255',
            'option_a' => 'required|max:255',
            'correct_ans' => 'required|max:255',
        ]);
        $insert = array(
            'department_id' => $request->input('department'),
            'question_type' => $request->input('question_type'),
            'question' => $request->input('question'),
            'option_a' => $request->input('option_a'),
            'option_b' => $request->input('option_b'),
            'option_c' => $request->input('option_c'),
            'option_d' => $request->input('option_d'),
            'correct_answer' => $request->input('correct_ans'),
        );

        $query = QuestionBank::insert($insert);
        return redirect()->route('admin.question_banks')
        ->with('success','Question created successfully.');
    }


    public function update($id ,Request $request){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $validated = $request->validate([
            'department' => 'required|max:255',
            'question_type' => 'required|max:255',
            'question' => 'required|max:255',
            'option_a' => 'required|max:255',
            'correct_ans' => 'required|max:255',
        ]);
        $insert = array(
            'department_id' => $request->input('department'),
            'question_type' => $request->input('question_type'),
            'question' => $request->input('question'),
            'option_a' => $request->input('option_a'),
            'option_b' => $request->input('option_b'),
            'option_c' => $request->input('option_c'),
            'option_d' => $request->input('option_d'),
            'correct_answer' => $request->input('correct_ans'),
        );

        $query = QuestionBank::where('id',$id)->update($insert);
        return redirect()->route('admin.question_banks')
        ->with('success','Question Updated successfully.');


    }

    public function delete($id){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        QuestionBank::where('id',$id)->delete(); 
        return redirect()->route('admin.question_banks')
        ->with('success','Question Deleted successfully.');
    }


}