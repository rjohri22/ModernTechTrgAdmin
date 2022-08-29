<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\States;
use App\Models\Admin\Countries;
use App\Models\Admin\Country;

class CountryController extends AdminBaseController
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
        $fetch = Countries::get();
        $this->data['countries'] = $fetch;
        return view('admin/countries/index',$this->data);
    }

    public function add(){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        
        
        return view('admin/countries/add',$this->data);
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
            'active'    => $request->input('statue')
        );

        $query = Countries::insert($insert_arr);
        return redirect()->route('admin.countries')
        ->with('success','Country created successfully.');
    }

    public function edit($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
      
         $this->data['countries'] = Countries::where('id',$id)->first();
        return view('admin/countries/edit',$this->data);
    }

    public function update($id, Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

         $update_arr = array(
            'name'       => $request->input('name'),
            'active'    => $request->input('statue')
        );

        $query  = Countries::where('id', $id)->update($update_arr);
        return redirect()->route('admin.countries')
        ->with('success','Countries Updated successfully.');
    }

    public function delete($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        Countries::where('id',$id)->delete(); 
        return redirect()->route('admin.countries')
        ->with('success','Country Deleted successfully.');
    }




}
