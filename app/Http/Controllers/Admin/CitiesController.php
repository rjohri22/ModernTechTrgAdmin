<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Countries;
use App\Models\Admin\States;
use App\Models\Admin\Cities;

class CitiesController extends AdminBaseController
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

        $fetch = Cities::join('countries','countries.id','=','cities.country_id')
                            ->join('states','states.id','=','cities.state_id')
                            ->get(['cities.*','states.name as state_name','countries.name as country_name']);
        $this->data['cities'] = $fetch;
        return view('admin/cities/index',$this->data);
    }
    
    public function add(){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        
        $this->data['countries'] = Countries::get();
        $this->data['states'] = States::get();
        return view('admin/cities/add',$this->data);
    }

    public function edit($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['countries'] = Countries::get();
        $this->data['city'] = Cities::where('id',$id)->first();
        return view('admin/cities/edit',$this->data);
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
            'state_id'       => $request->input('state'),
            'status'    => $request->input('statue')
        );

        $query = Cities::insert($insert_arr);
        return redirect()->route('admin.cities')
        ->with('success','City created successfully.');
    }

    public function update($id, Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

         $update_arr = array(
            'name'       => $request->input('name'),
            'country_id'       => $request->input('country'),
            'state_id'       => $request->input('state'),
            'status'    => $request->input('statue')
        );

        $query  = Cities::where('id', $id)->update($update_arr);
        return redirect()->route('admin.cities')
        ->with('success','City Updated successfully.');
    }

    public function delete($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        Cities::where('id',$id)->delete(); 
        return redirect()->route('admin.cities')
        ->with('success','City Deleted successfully.');
    }
    public function states(Request $request){
        $this->loadBaseData();
        $this->data['codestatus'] = true;
        $this->data['html'] = '';
        $states = States::where('country_id',$request->id)->get();
        foreach($states as $state){
            $this->data['html'] .= "<option value='".$state->id."'>".$state->name."</option>";
        }
        return response()->json($this->data);

    }
    public function cities(Request $request){
        $this->loadBaseData();
        $this->data['codestatus'] = true;
        $this->data['html'] = '';
        $cities = Cities::where('state_id',$request->id)->get();
        foreach($cities as $city){
            $this->data['html'] .= "<option value='".$city->id."'>".$city->name."</option>";
        }
        return response()->json($this->data);

    }

}