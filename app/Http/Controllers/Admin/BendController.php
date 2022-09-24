<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Bend;
use App\Models\User;
use App\Models\Admin\BendAssign;
use Illuminate\Support\Facades\DB;

class BendController extends AdminBaseController
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

        // $fetch = Job_applications::join('oppertunities', 'oppertunities.id', '=', 'job_applications.oppertunity_id')
                // ->join('users','users.id','=','job_applications.jobseeker_id')->where('job_applications.status',3);
        // $fetch = Bend::leftJoin('bends as pb','bends.id','=','pb.parent_id')->get(['bends.*','pb.name as parent']);
        $user_id = Auth::user()->id;
        $this->data['login_details'] = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();

        $fetch = DB::table('bends')
            ->select(DB::raw("bends.*, GROUP_CONCAT(fl.name) as children"))
            ->leftJoin('bend_assigns as pb','bends.id','=','pb.child_id')
            ->leftJoin('bends as fl','fl.id','=','pb.parent_id')
            ->groupBy('bends.id')
            ->get();
        $this->data['bends'] = $fetch;

        return view('admin/bends/index',$this->data);
    }


    public function permission($id){
        $this->loadBaseData();
        $this->data['id'] = $id;
        $permissions = DB::table('modules')->join('options','options.module_id','=','modules.id')->where('modules.active',1)->get();
        foreach($permissions as $key => $p){
            $option = DB::table('option_permissions')->where('bend_id',$id)->where('option_slug',$p->option_slug)->first();
            if($option){
                $permissions[$key]->_index = $option->_index;
                $permissions[$key]->_view = $option->_view;
                $permissions[$key]->_add = $option->_add;
                $permissions[$key]->_edit = $option->_edit;
                $permissions[$key]->_delete = $option->_delete;
            }
        }
        $this->data['modules'] = DB::table('modules')->get();
        $this->data['permissions'] = $permissions;
        return view('admin/bends/permission',$this->data);
    }
    public function permission_update($id,Request $request){
        $this->loadBaseData();
        $options = DB::table('modules')
                    ->join('options','options.module_id','=','modules.id')
                    ->where('modules.active',1)->get();
        foreach($options as $o){
            $insertdata['_index'] = isset($request[$o->option_slug.'_index']) ? 1 : 0;
            $insertdata['_view'] = isset($request[$o->option_slug.'_view']) ? 1 : 0;
            $insertdata['_add'] = isset($request[$o->option_slug.'_add']) ? 1 : 0;
            $insertdata['_edit'] = isset($request[$o->option_slug.'_edit']) ? 1 : 0;
            $insertdata['_delete'] = isset($request[$o->option_slug.'_delete']) ? 1 : 0;
            $chek = DB::table('option_permissions')->where('bend_id',$id)->where('option_slug',$o->option_slug)->first();
            if($chek){
                DB::table('option_permissions')
                    ->where('bend_id',$id)
                    ->where('option_slug',$o->option_slug)
                    ->update($insertdata);
            }
            else{
                $insertdata['bend_id'] = $id;
                $insertdata['option_slug'] = $o->option_slug;
                $insertdata['option_type'] = 'form';
                DB::table('option_permissions')->insert($insertdata);
            }
        }
        return redirect()->route('admin.bend_permission',$id);
    }
    
    public function add(){
        $this->loadBaseData();

        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $user_id = Auth::user()->id;
        $this->data['login_details'] = $login_detail = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();
        $this->data['special_view'] = 0;
        if($login_detail){
            if($login_detail->band_type == '2' && ($login_detail->level == '3' || $login_detail->level == '4')){
                $this->data['special_view'] = 1;
                $this->data['bends'] = Bend::where('band_type','2')->get();
            }else{
                $this->data['bends'] = Bend::get();
            }
        }else{
            $this->data['bends'] = Bend::get();
        }
        // dd($login_detail);
        // dd($this->data['special_view']);
        return view('admin/bends/add',$this->data);
    }

    public function edit($id){
        $this->loadBaseData();

        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $user_id = Auth::user()->id;
        $this->data['login_details'] = $login_detail = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();
        $this->data['special_view'] = 0;
        if(!empty($login_details)){
            if($login_detail->band_type == '2' && ($login_detail->level == '3' || $login_detail->level == '4')){
                $this->data['special_view'] = 1;
                $this->data['all_bend'] = Bend::where('band_type','2')->get();
            }else{
                $this->data['all_bend'] = Bend::get();
            }
        }else{
            $this->data['all_bend'] = Bend::get();
        }
        $this->data['bend'] = Bend::where('id',$id)->first();
        $this->data['bend_assign'] = BendAssign::where('child_id',$id)->pluck('parent_id')->toArray();
        return view('admin/bends/edit',$this->data);
    }

    public function store(Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'title' => 'required|max:255',
            'bend_type' => 'required',
            'level' => 'required',
            'status' => 'required',
        ]);
        $bend_report = $request->input('bend_report');
        $insert_arr = array(
            'name'       => $request->input('title'),
            'band_type'       => $request->input('bend_type'),
            'level'    => $request->input('level'),
            'status'    => $request->input('status'),
            'special'    => $request->input('special'),
            'parent_id'    => null,
        );
        $query = Bend::insert($insert_arr);
        $id = DB::getPdo()->lastInsertId();
        if(count((array)$bend_report) > 0){
            for($i=0; $i< count($bend_report); $i++){
                $assign_arr[] = array(
                    'parent_id' => $bend_report[$i],
                    'child_id' => $id
                );
            }
            BendAssign::insert($assign_arr);
        }
        return redirect()->route('admin.bends')
        ->with('success','Profile created successfully.');
    }

    public function update($id, Request $request){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        $validated = $request->validate([
            'title' => 'required|max:255',
            'bend_type' => 'required',
            'level' => 'required',
            'status' => 'required',
        ]);
        $bend_report = $request->input('bend_report');
         $update_arr = array(
            'name'       => $request->input('title'),
            'band_type'       => $request->input('bend_type'),
            'level'    => $request->input('level'),
            'status'    => $request->input('status'),
            'special'    => $request->input('special'),
            'parent_id'    => null,
        );
        $query  = Bend::where('id', $id)->update($update_arr);
        BendAssign::where('child_id',$id)->delete();
        if(count((array)$bend_report) > 0){
            for($i=0; $i< count($bend_report); $i++){
                $assign_arr[] = array(
                    'parent_id' => $bend_report[$i],
                    'child_id' => $id
                );
            }
            BendAssign::insert($assign_arr);
        }
        return redirect()->route('admin.bends')
        ->with('success','Profile Updated successfully.');
    }

    public function delete($id){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        Bend::where('id',$id)->delete(); 
        return redirect()->route('admin.bends')
        ->with('success','Profile Deleted successfully.');
    }

}