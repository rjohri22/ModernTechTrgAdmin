<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Bend;
use App\Models\User;
use App\Models\Admin\BendAssign;
use Illuminate\Support\Facades\DB;

class BendController extends AdminBaseController
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        // $fetch = Job_applications::join('oppertunities', 'oppertunities.id', '=', 'job_applications.oppertunity_id')
                // ->join('users','users.id','=','job_applications.jobseeker_id')->where('job_applications.status',3);
        // $fetch = Bend::leftJoin('bends as pb','bends.id','=','pb.parent_id')->get(['bends.*','pb.name as parent']);
        $user_id = Auth::user()->id;
        $data['login_details'] = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();

        $fetch = DB::table('bends')
            ->select(DB::raw("bends.*, GROUP_CONCAT(fl.name) as children"))
            ->leftJoin('bend_assigns as pb','bends.id','=','pb.child_id')
            ->leftJoin('bends as fl','fl.id','=','pb.parent_id')
            ->groupBy('bends.id')
            ->get();
        $data['bends'] = $fetch;

        return view('admin/bends/index',$data);
    }
    
    public function add(){
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $user_id = Auth::user()->id;
        $data['login_details'] = $login_detail = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();
        $data['special_view'] = 0;
        if($login_detail){
            if($login_detail->band_type == '2' && ($login_detail->level == '3' || $login_detail->level == '4')){
                $data['special_view'] = 1;
                $data['bends'] = Bend::where('band_type','2')->get();
            }else{
                $data['bends'] = Bend::get();
            }
        }else{
            $data['bends'] = Bend::get();
        }
        // dd($login_detail);
        // dd($data['special_view']);
        return view('admin/bends/add',$data);
    }

    public function edit($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
         $user_id = Auth::user()->id;
        $data['login_details'] = $login_detail = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();
        $data['special_view'] = 0;
        if($login_detail->band_type == '2' && ($login_detail->level == '3' || $login_detail->level == '4')){
            $data['special_view'] = 1;
            $data['all_bend'] = Bend::where('band_type','2')->get();
        }else{
            $data['all_bend'] = Bend::get();
        }
        $data['bend'] = Bend::where('id',$id)->first();
        $data['bend_assign'] = BendAssign::where('child_id',$id)->pluck('parent_id')->toArray();
        return view('admin/bends/edit',$data);
    }

    public function store(Request $request){
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
        ->with('success','Bend created successfully.');
    }

    public function update($id, Request $request){
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
        ->with('success','Bend Updated successfully.');
    }

    public function delete($id){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };
        Bend::where('id',$id)->delete(); 
        return redirect()->route('admin.bends')
        ->with('success','Bend Deleted successfully.');
    }

}