<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\Admin\Oppertunities;
use App\Models\Admin\Companies;
use App\Models\Admin\Bend;
use App\Models\Admin\BendAssign;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OppertunitiesController extends AdminBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $user_id = Auth::user()->id;
       
        $this->data['login_details'] = $login_details = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();
        
        $fetch = DB::table('oppertunities')
            ->select(DB::raw("oppertunities.*, pb.name as company_name"))
            ->leftJoin('companies as pb','pb.id','=','oppertunities.company_id');
            
            // ->leftJoin('bends as fl','fl.id','=','oppertunities.modified_by');
            // ->where('fl.id',$login_bend_id)
        $this->data['children'] = [];
        if(!empty($login_details)){
            $login_bend_id = $login_details->id;
            $this->data['childern'] = BendAssign::where('parent_id',$login_bend_id)->get()->pluck('child_id');
            $this->data['childern'][] = $login_bend_id;
            if($this->data['login_details']->level < 7){
                $fetch = $fetch->wherein('oppertunities.bend_id',$this->data['childern']);
            }
        }
        
        // $this->data['children']  = BendAssign::join('bends','bends.id','=','bend_assigns.child_id')->where('bend_assigns.parent_id',$login_bend_id)->get()->pluck('child_id');


        $fetch = $fetch->get();

        // dd($fetch);
        // dd($this->data['childern']);
        // echo $fetch;
        // die();
        // dd($fetch);
        // dd()

        $this->data['oppertunities'] = $fetch;

        return view('admin/oppertunities/index',$this->data);
    }

    public function add()
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
         $this->data['companies'] = Companies::where('status','1')->get();
         $user_id = Auth::user()->id;
        $this->data['login_details'] = $login_details = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();
        $this->data['bends'] = [];
        if(!empty($login_details)){
            $this->data['bends'] = Bend::where('level','<=',$login_details->level)->get();
        }

         // $this->data['bends'] = Bend::get();
        return view('admin/oppertunities/add',$this->data);
    }

    public function edit($id)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['companies'] = Companies::where('status','1')->get();
        $this->data['oppertunity'] = Oppertunities::where('id', $id)->first();
        $user_id = Auth::user()->id;
        $this->data['login_details'] = $login_details = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();
        $this->data['bends'] = [];
        if(!empty($login_details)){
            $this->data['bends'] = Bend::where('level','<=',$login_details->level)->get();
        }
        return view('admin/oppertunities/edit',$this->data);
    }

    public function view($id)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $fetch = Oppertunities::Leftjoin('companies', 'companies.id', '=', 'oppertunities.company_id')
                ->get(['oppertunities.*', 'companies.name as company_name'])->where('id',$id)->first();
        $this->data['oppertunity'] = $fetch;
        return view('admin/oppertunities/view',$this->data);
    }
    public function publish($id)
    {
        $this->loadBaseData();
        $update_arr['is_draft'] = 0;
        $query  = Oppertunities::where('id', $id)->update($update_arr);
        return redirect()->route('admin.oppertunities')
        ->with('success','oppertunity Updated successfully.');

    }

    public function store_oppertunity(Request $request)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
          //  'title' => 'required|max:255',
          'bend_id' => 'required',

        ]);
        $user_id = Auth::user()->id;
        $update_arr = array(
            // 'title'         => $request->input('title'),
            'daily_job'         => $request->input('daily_job'),
            // 'team_engagement'       => $request->input('team_engagement'),
            // 'reporting'             => $request->input('reporting'),
           // 'profile'                => $request->input('profile'),
            'Responsibilities'         => $request->input('Responsibilities'),
          //  'company_id'    => 0,
            'bend_id'       => $request->input('bend_id'),
            //'min_salary'    => $request->input('min_salary'),
            //'max_salary'    => $request->input('max_salary'),
           // 'salary_type'   => $request->input('salary_type'),
          //  'job_type'      => $request->input('job_type'),
            //'work_type'     => $request->input('work_type'),
            //'expires_on'    =>  $request->input('expires_on'),
    // 'no_of_positions'    => $request->input('no_of_position'),
           // 'urgent_hiring'     => $request->input('urgent_hiring'),
           // 'status'            => $request->input('status'),
            'summery'           => $request->input('summery'),
            'description'       => $request->input('description'),
            'modified_by'       => $user_id,
            'is_draft'       => 0,
        );

        if(isset($request->savedraft)){
            $update_arr['is_draft'] = 1;
        }
        $query = Oppertunities::insert($update_arr);
        return redirect()->route('admin.oppertunities')
        ->with('success','oppertunity created successfully.');
    }

    public function update_oppertunity($id, Request $request)
    {
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
           // 'title' => 'required|max:255',
           'bend_id' => 'required',
        ]);

        $update_arr = array(
            // 'title'         => $request->input('title'),
            // 'company_id'       => 0,
            'bend_id'       => $request->input('bend_id'),
            // 'min_salary'    => $request->input('min_salary'),
            // 'max_salary'    => $request->input('max_salary'),
            // 'salary_type'   => $request->input('salary_type'),
            // 'job_type'   => $request->input('job_type'),
            // 'work_type'   => $request->input('work_type'),
            //'expires_on'    => $request->input('expires_on'),
            // 'no_of_positions'    => $request->input('no_of_position'),
            // 'urgent_hiring'     => $request->input('urgent_hiring'),
           // 'status'            => $request->input('status'),
            'summery'                 => $request->input('summery'),
            'description'             => $request->input('description'),
             'daily_job'               => $request->input('daily_job'),
            // 'team_engagement'         => $request->input('team_engagement'),
            // 'reporting'         => $request->input('reporting'),
            // 'profile'         => $request->input('profile'),
            'Responsibilities'         => $request->input('Responsibilities'),
        );

        $query  = Oppertunities::where('id', $id)->update($update_arr);
        return redirect()->route('admin.oppertunities')
        ->with('success','oppertunity Updated successfully.');
    }

    public function delete_oppertunity($id){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        Oppertunities::where('id',$id)->delete(); 
        return redirect()->route('admin.oppertunities')
        ->with('success','Oppertunity Deleted successfully.');
    }
}