<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Departments;

class DepartmentController extends AdminBaseController
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        $fetch = Departments::get();
        $data['departments'] = $fetch;
        return view('admin/departments/index',$data);
    }

    public function add(){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        return view('admin/departments/add');
    }

    public function edit($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $data['department'] = Departments::where('id',$id)->first();
        return view('admin/departments/edit',$data);
    }

    public function store(Request $request){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        $insert_arr = array(
            'title'       => $request->input('title'),
            'hod_id'       => $request->input('hod'),
            'description'    => $request->input('description'),
            'active'    => $request->input('active')
        );

        $query = Departments::insert($insert_arr);
        return redirect()->route('admin.departments')
        ->with('success','Designation created successfully.');
    }

    public function update($id, Request $request){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

         $update_arr = array(
            'title'       => $request->input('title'),
            'hod_id'       => $request->input('hod'),
            'description'    => $request->input('description'),
            'active'    => $request->input('active')
        );

        $query  = Departments::where('id', $id)->update($update_arr);
        return redirect()->route('admin.departments')
        ->with('success','Designation Updated successfully.');
    }

    public function delete($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        Departments::where('id',$id)->delete(); 
        return redirect()->route('admin.departments')
        ->with('success','Designation Deleted successfully.');
    }

}