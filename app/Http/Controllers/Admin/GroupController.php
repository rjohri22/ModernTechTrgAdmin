<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Groups;

class GroupController extends AdminBaseController
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        $fetch = Groups::get();
        $data['groups'] = $fetch;
        return view('admin/groups/index',$data);
    }

    public function add(){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        return view('admin/groups/add');
    }

    public function edit($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $data['group'] = Groups::where('id',$id)->first();
        return view('admin/groups/edit',$data);
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

        $query = Groups::insert($insert_arr);
        return redirect()->route('admin.groups')
        ->with('success','Group created successfully.');
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

        $query  = Groups::where('id', $id)->update($update_arr);
        return redirect()->route('admin.groups')
        ->with('success','Group Updated successfully.');
    }

    public function delete($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        Groups::where('id',$id)->delete(); 
        return redirect()->route('admin.groups')
        ->with('success','Group Deleted successfully.');
    }

}