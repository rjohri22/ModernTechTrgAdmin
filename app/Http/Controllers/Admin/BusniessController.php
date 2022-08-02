<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Companies;
use App\Models\Admin\Countries;

class BusniessController extends AdminBaseController
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        $fetch = Companies::get();
        $data['busniess'] = $fetch;
        return view('admin/busniess/index',$data);
    }
    
    public function add(){
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        
        $data['countries'] = Countries::get();
        return view('admin/busniess/add',$data);
    }

    public function edit($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $data['busniess'] = Companies::where('id',$id)->first();
        return view('admin/busniess/edit',$data);
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

        $query = Companies::insert($insert_arr);
        return redirect()->route('admin.busniess')
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

        $query  = Companies::where('id', $id)->update($update_arr);
        return redirect()->route('admin.busniess')
        ->with('success','Designation Updated successfully.');
    }

    public function delete($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        Companies::where('id',$id)->delete(); 
        return redirect()->route('admin.busniess')
        ->with('success','Designation Deleted successfully.');
    }

}