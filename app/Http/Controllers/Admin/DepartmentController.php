<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Departments;

class DepartmentController extends AdminBaseController
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

        $fetch = Departments::get();
        $this->data['departments'] = $fetch;
        return view('admin/departments/index',$this->data);
    }

    public function add(){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        return view('admin/departments/add',$this->data);
    }

    public function edit($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['department'] = Departments::where('id',$id)->first();
        return view('admin/departments/edit',$this->data);
    }

    public function store(Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        $insert_arr = array(
            'title'       => $request->input('title'),
          //  'hod_id'       => $request->input('hod'),
            'description'    => $request->input('description'),
            'active'    => $request->input('active')
        );

        $query = Departments::insert($insert_arr);
        return redirect()->route('admin.departments')
        ->with('success','Department created successfully.');
    }

    public function update($id, Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

         $update_arr = array(
            'title'       => $request->input('title'),
           // 'hod_id'       => $request->input('hod'),
            'description'    => $request->input('description'),
            'active'    => $request->input('active')
        );

        $query  = Departments::where('id', $id)->update($update_arr);
        return redirect()->route('admin.departments')
        ->with('success','Department Updated successfully.');
    }

    public function delete($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        Departments::where('id',$id)->delete(); 
        return redirect()->route('admin.departments')
        ->with('success','Department Deleted successfully.');
    }

}