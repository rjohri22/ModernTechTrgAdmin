<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\States;
use App\Models\Admin\Countries;


class StatesController extends AdminBaseController
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

        // $fetch = States::with('country')->get();
        $fetch = States::join('countries','countries.id','=','states.country_id')->get(['states.*','countries.name as country_name']);
        $this->data['states'] = $fetch;
        return view('admin/states/index',$this->data);
    }
    
    public function add(){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        
        $this->data['countries'] = Countries::get();
        return view('admin/states/add',$this->data);
    }

    public function edit($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['countries'] = Countries::get();
        $this->data['state'] = States::where('id',$id)->first();
        return view('admin/states/edit',$this->data);
    }

    public function store(Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $insert_arr = array(
            'name'       => $request->input('name'),
            'country_id'       => $request->input('country'),
            'status'    => $request->input('statue')
        );

        $query = States::insert($insert_arr);
        return redirect()->route('admin.states')
        ->with('success','State created successfully.');
    }

    public function update($id, Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

         $update_arr = array(
            'name'       => $request->input('name'),
            'country_id'       => $request->input('country'),
            'status'    => $request->input('statue')
        );

        $query  = States::where('id', $id)->update($update_arr);
        return redirect()->route('admin.states')
        ->with('success','State Updated successfully.');
    }

    public function delete($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        States::where('id',$id)->delete(); 
        return redirect()->route('admin.states')
        ->with('success','State Deleted successfully.');
    }

}