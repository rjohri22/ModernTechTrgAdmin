<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\BusinessLocations;
use App\Models\Admin\Companies;
use App\Models\Admin\Countries;

class BusinessLocationController extends AdminBaseController
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };


        $fetch = BusinessLocations::get();
        $fetch = BusinessLocations::join('companies','companies.id','=','business_locations.company_id')->join('countries','countries.id','=','business_locations.country_id')->join('states','states.id','=','business_locations.state_id')->join('cities','cities.id','=','business_locations.city')->get(['business_locations.*','companies.name as company_name','countries.name as country_name','states.name as state_name','cities.name as city_name']);
        $data['business_location'] = $fetch;
        return view('admin/business_locations/index',$data);
    }
    
    public function add(){
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $data['companies'] = Companies::get();
        $data['countries'] = Countries::get();
        // $data['countries'] = Countries::get();
        return view('admin/business_locations/add',$data);
    }

    public function edit($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        $data['companies'] = Companies::get();
        $data['countries'] = Countries::get();
        $data['business_location'] = BusinessLocations::where('id',$id)->first();
        // $data['countries'] = Countries::get();
        // $data['state'] = States::where('id',$id)->first();
        return view('admin/business_locations/edit',$data);
    }

    public function store(Request $request){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'company_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city' => 'required',
        ]);

        $insert_arr = array(
            'company_id'       => $request->input('company_id'),
            'country_id'       => $request->input('country_id'),
            'state_id'    => $request->input('state_id'),
            'city'    => $request->input('city'),
            'status'    => $request->input('status'),
        );

        $query = BusinessLocations::insert($insert_arr);
        return redirect()->route('admin.business_locations')
        ->with('success','Business Location created successfully.');
    }

    public function update($id, Request $request){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

         $update_arr = array(
            'company_id'       => $request->input('company_id'),
            'country_id'       => $request->input('country_id'),
            'state_id'    => $request->input('state_id'),
            'city'    => $request->input('city'),
            'status'    => $request->input('status'),
        );

        $query  = BusinessLocations::where('id', $id)->update($update_arr);
        return redirect()->route('admin.business_locations')
        ->with('success','Business Location Updated successfully.');
    }

    public function delete($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        BusinessLocations::where('id',$id)->delete(); 
        return redirect()->route('admin.business_locations')
        ->with('success','Business Location Deleted successfully.');
    }

}