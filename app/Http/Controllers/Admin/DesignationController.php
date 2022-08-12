<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Designations;

class DesignationController extends AdminBaseController
{
	public function __construct(Request $request)
    {
        parent::__construct($request);
    	$this->middleware('auth');
    }

    public function index(){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        $fetch = Designations::get();
        $data['designations'] = $fetch;
        return view('admin/designations/index',$data);
    }

    public function add(){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        return view('admin/designations/add');
    }

    public function edit($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $data['designation'] = Designations::where('id',$id)->first();
        return view('admin/designations/edit',$data);
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
            'description'    => $request->input('description'),
            'active'    => $request->input('active')
        );

        $query = Designations::insert($insert_arr);
        return redirect()->route('admin.designations')
        ->with('success','Designation created successfully.');
    }

    public function update($id, Request $request){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

         $update_arr = array(
            'title'       => $request->input('title'),
            'description'    => $request->input('description'),
            'active'    => $request->input('active')
        );

        $query  = Designations::where('id', $id)->update($update_arr);
        return redirect()->route('admin.designations')
        ->with('success','Designation Updated successfully.');
    }

    public function delete($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        Designations::where('id',$id)->delete(); 
        return redirect()->route('admin.designations')
        ->with('success','Designation Deleted successfully.');
    }

}