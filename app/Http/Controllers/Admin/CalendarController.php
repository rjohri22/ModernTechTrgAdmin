<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Calenders;

class CalendarController extends AdminBaseController
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

        $fetch = Calenders::get();
        $this->data['busniess'] = $fetch;
        return view('admin/calendar/index',$this->data);
    }

    function load_task(Request $request){
        $start = $request->get('start');
        $end = $request->get('end');
        $user_id = Auth::user()->id;
        $tasks = Calenders::where('emp_id',$user_id)->where('date','>=',$start)->where('date','<',$end)->get();
        return response()->json($tasks);
    }

    function store_data(Request $request){
        $user_id = Auth::user()->id;
        $data = array(
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'emp_id' => $user_id,
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'title' => $request->input('title'),
            'description' => $request->input('message'),
        );

        $q = Calenders::insert($data);
        if($q){
         return redirect()->route('admin.calendar')->with('success','Task created successfully.');
        }else{
         return redirect()->route('admin.calendar')->with('error_','Opps Somthing Wents Wrong.');
        }
    }

    function update_data(Request $request){
        $user_id = Auth::user()->id;
        $task_id = $request->input('task_id');
        $data = array(
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'emp_id' => $user_id,
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'title' => $request->input('title'),
            'description' => $request->input('message'),
        );

        $q = Calenders::where('id',$task_id)->update($data);
        if($q){
         return redirect()->route('admin.calendar')->with('success','Task created successfully.');
        }else{
         return redirect()->route('admin.calendar')->with('error_','Opps Somthing Wents Wrong.');
        }
    }

    function delete_task(Request $request){
        $id = $request->get('id');
        $q = Calenders::where('id',$id)->delete();
        if($q){
         return redirect()->route('admin.calendar')->with('success','Task Deleted successfully.');
        }else{
         return redirect()->route('admin.calendar')->with('error_','Opps Somthing Wents Wrong.');
        }
    }
}