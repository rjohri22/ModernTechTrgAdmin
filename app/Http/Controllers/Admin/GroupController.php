<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Groups;

class GroupController extends AdminBaseController
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

        $fetch = Groups::get();
        $this->data['groups'] = $fetch;
        return view('admin/groups/index',$this->data);
    }

    public function add(){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        return view('admin/groups/add',$this->data);
    }

    public function edit($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['group'] = Groups::where('id',$id)->first();
        return view('admin/groups/edit',$this->data);
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
            'description'    => $request->input('description'),
            'active'    => $request->input('active')
        );

        $query = Groups::insert($insert_arr);
        return redirect()->route('admin.groups')
        ->with('success','Group created successfully.');
    }

    public function update($id, Request $request){
        $this->loadBaseData();
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
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        Groups::where('id',$id)->delete(); 
        return redirect()->route('admin.groups')
        ->with('success','Group Deleted successfully.');
    }

}