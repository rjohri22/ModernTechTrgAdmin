<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee_educations;
use App\Models\Employee_works;
use App\Models\Employee_languages;
use App\Models\Employee_cirtificates;
use App\Models\Employee_sociallinks;
use App\Models\Admin\Bend;
use App\Models\Admin\Companies;
use App\Models\Admin\Countries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends AdminBaseController {
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

    public function index(){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $fetch = User::Leftjoin('bends','bends.id','=','users.bend_id')
            ->Leftjoin('countries','countries.id','=','users.country')
            ->where('users.group_id',1)
            ->get(['users.*','bends.name as bend_name','countries.name as country_name']);
        $this->data['employees'] = $fetch;
        return view('admin/employees/index',$this->data);
    }
    public function add(){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['bends'] = Bend::get();
        $this->data['business'] = Companies::get();
        $this->data['countries'] = Countries::get();
        return view('admin/employees/add',$this->data);
    }
    public function edit($id){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['user'] = User::where('id', $id)->first();
        $this->data['education'] = Employee_educations::where('user_id', $id)->get();
        $this->data['works'] = Employee_works::where('user_id', $id)->get();
        $this->data['language'] = Employee_languages::where('user_id', $id)->get();
        $this->data['certificate'] = Employee_cirtificates::where('user_id', $id)->get();
        $this->data['links'] = Employee_sociallinks::where('user_id', $id)->get();
        $this->data['bends'] = Bend::get();
        $this->data['business'] = Companies::get();
        $this->data['countries'] = Countries::get();
        return view('admin/employees/edit',$this->data);
    }

    public function view($id){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $this->data['user'] = User::where('id', $id)->first();
        $this->data['education'] = Employee_educations::where('user_id', $id)->get();
        $this->data['works'] = Employee_works::where('user_id', $id)->get();
        $this->data['language'] = Employee_languages::where('user_id', $id)->get();
        $this->data['certificate'] = Employee_cirtificates::where('user_id', $id)->get();
        $this->data['links'] = Employee_sociallinks::where('user_id', $id)->get();
        return view('admin/employees/view',$this->data);
    }
    public function store_employee(Request $request){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric'],
            'address_1' => ['required', 'string','max:255'],
            'bend' => ['required', 'string'],
        ]);
        $update_arr = array(
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'name' => $request->input('first_name'),
            'email' => $request->input('email'),
            'group_id' => 1,
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'password' => Hash::make($request->input('password')),
            'bend_id' => $request->input('bend'),
            'company_id' => $request->input('business'),
            'country' => $request->input('country'),
        );
        $query = User::insert($update_arr);
        return redirect()->route('admin.employees')
            ->with('success','Employee created successfully.');
    }
    public function update_employee($id, Request $request){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric'],
            'address_1' => ['required', 'string','max:255'],
            'bend' => ['required', 'string'],
        ]);
        $update_arr = array(
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'name' => $request->input('first_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address_primary' => $request->input('address_1'),
            'address_secondary' => $request->input('address_2'),
            'bend_id' => $request->input('bend'),
            'company_id' => $request->input('business'),
            'country' => $request->input('country'),
        );
        $query  = User::where('id', $id)->update($update_arr);
        return redirect()->route('admin.employees')
            ->with('success','Employee Updated successfully.');
    }
    public function update_user_resume($id, Request $request){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $resume_attachment_name = $request->input('pre_resume_attachment');
        if($_FILES['resume_attachment']['size'] > 0){
            $resume_attachment_name = time().'.'.$request->resume_attachment->extension();
            $request->resume_attachment->move(public_path('images/resume'), $resume_attachment_name);
        }
        $update_arr = array(
            'headline' => $request->input('headline'),
            'summery' => $request->input('summery'),
            'resume_type' => $request->input('resume_type'),
            'desired_job_title' => $request->input('desired_job_title'),
            'desired_salary' => $request->input('desired_salary'),
            'desired_period' => $request->input('desired_period'),
            'desired_jobtype' => $request->input('desired_jobtype'),
            'resume_attachment' => $resume_attachment_name
        );
        $query  = User::where('id', $id)->update($update_arr);
        return redirect()->route('admin.employees')
            ->with('success','Employee Resume Updated successfully.');
    }
    public function store_user_education($user_id, Request $request){ 
        $this->loadBaseData();
        $institude_name = $request->input('institude');
        $del_ids = $request->input('del_id');
        $del_id = [];
        if($del_ids){
            $del_id = explode(',', $del_ids);
        }
        if(is_array($del_id)){
            unset($del_id[0]);
        }
        if(count($del_id) > 0){
            foreach($del_id as $id){
                Employee_educations::where('id',$id)->delete(); 
            }
        }
        $this->data = array();
        if(count((array)$institude_name) > 0){
            for($i=0; $i< count($institude_name); $i++){
                if($request->input('insert_update')[$i] == 0){
                    $this->data[] = array(
                        'user_id' => $user_id,
                        'level' => $request->input('level')[$i],
                        'institute_name' => $institude_name[$i],
                        'field_name' => $request->input('field')[$i],
                        'country' => $request->input('country')[$i],
                        'state' => $request->input('state')[$i],
                        'city' => $request->input('city')[$i],
                        'period_from' => $request->input('from')[$i],
                        'period_to' => $request->input('to')[$i],
                    );
                }
            }
            $query = Employee_educations::insert($this->data);
            if($query){
                return redirect()->route('admin.employees')
                    ->with('success','Employee Eductaion Updated successfully.');
            }
            else{
                return redirect()->route('admin.employees')
                    ->with('error','Opps Something Went Wrong.');
            }
        }
        else{
            return redirect()->route('admin.employees')
                ->with('error','No data Found To Insert.');
        }
    }
    public function store_user_experience($user_id, Request $request){
        $this->loadBaseData();
        $compnay = $request->input('work_company');
        $del_ids = $request->input('work_del_id');
        $del_id = [];
        if($del_ids){
            $del_id = explode(',', $del_ids);
        }
        if(is_array($del_id)){
            unset($del_id[0]);
        }
        if(count($del_id) > 0){
            foreach($del_id as $id){
                Employee_works::where('id',$id)->delete(); 
            }
        }
        $this->data = array();
        if(count((array)$compnay) > 0){
            for($i=0; $i< count($compnay); $i++){
                if($request->input('insert_update')[$i] == 0){
                    $this->data[] = array(
                        'user_id' => $user_id,
                        'title' => $request->input('work_title')[$i],
                        'company' => $compnay[$i],
                        'country' => $request->input('work_country')[$i],
                        'state' => $request->input('work_state')[$i],
                        'city' => $request->input('work_city')[$i],
                        'period_from' => $request->input('work_from')[$i],
                        'period_to' => $request->input('work_to')[$i],
                        'description' => $request->input('work_description')[$i],
                    );
                }
            }
            $query = Employee_works::insert($this->data);
            if($query){
                return redirect()->route('admin.employees')
                    ->with('success','Employee Experience Updated successfully.');
            }
            else{
                return redirect()->route('admin.employees')
                    ->with('error','Opps Something Went Wrong.');
            }
        }
        else{
            return redirect()->route('admin.employees')
                ->with('error','No Data Found To Insert');
        }
    }
    public function store_user_certificate($user_id, Request $request){
        $this->loadBaseData();
        $title = $request->input('certificate_title');
        $del_ids = $request->input('certificate_del_id');
        $del_id = [];
        if($del_ids){
            $del_id = explode(',', $del_ids);
        }
        if(is_array($del_id)){
            unset($del_id[0]);
        }
        if(count($del_id) > 0){
            foreach($del_id as $id){
                Employee_cirtificates::where('id',$id)->delete(); 
            }
        }
        $this->data = array();
        if(count((array)$title) > 0){
            for($i=0; $i< count($title); $i++){
                if($request->input('insert_update')[$i] == 0){
                    $this->data[] = array(
                        'user_id' => $user_id,
                        'title' => $title[$i],
                        'institute_name' => $request->input('certificate_institude')[$i],
                        'period_from' => $request->input('certificate_from')[$i],
                        'period_to' => $request->input('certificate_to')[$i],
                        'description' => $request->input('certificate_description')[$i],
                    );
                }
            }
            $query = Employee_cirtificates::insert($this->data);
            if($query){
                return redirect()->route('admin.employees')
                    ->with('success','Employee Certificate Updated successfully.');
            }
            else{
                return redirect()->route('admin.employees')
                    ->with('error','Opps Something Went Wrong.');
            }
        }
        else{
            return redirect()->route('admin.employees')
                ->with('error','No Data Found To Insert');
        }
    }
    public function store_user_language($user_id, Request $request){
        $this->loadBaseData();
        $title = $request->input('language_title');
        $del_ids = $request->input('language_del_id');
        $del_id = [];
        if($del_ids){
            $del_id = explode(',', $del_ids);
        }
        if(is_array($del_id)){
            unset($del_id[0]);
        }
        if(count($del_id) > 0){
            foreach($del_id as $id){
                Employee_languages::where('id',$id)->delete(); 
            }
        }
        $this->data = array();
        if(count((array)$title) > 0){
            for($i=0; $i< count($title); $i++){
                if($request->input('insert_update')[$i] == 0){
                    $this->data[] = array(
                        'user_id' => $user_id,
                        'title' => $title[$i],
                        'proficiency' => $request->input('language_profiency')[$i],
                    );
                }
            }
            $query = Employee_languages::insert($this->data);
            if($query){
                return redirect()->route('admin.employees')
                    ->with('success','Employee Language Updated successfully.');
            }
            else{
                return redirect()->route('admin.employees')
                    ->with('error','Opps Something Went Wrong.');
            }
        }
        else{
            return redirect()->route('admin.employees')
                ->with('error','No Data Found To Insert');
        }
    }
    public function store_user_link($user_id, Request $request){
        $this->loadBaseData();
        $title = $request->input('link_title');
        $del_ids = $request->input('link_del_id');
        $del_id = [];
        if($del_ids){
            $del_id = explode(',', $del_ids);
        }
        if(is_array($del_id)){
            unset($del_id[0]);
        }
        if(count($del_id) > 0){
            foreach($del_id as $id){
                Employee_sociallinks::where('id',$id)->delete(); 
            }
        }
        $this->data = array();
        if(count((array)$title) > 0){
            for($i=0; $i< count($title); $i++){
                if($request->input('insert_update')[$i] == 0){
                    $this->data[] = array(
                        'user_id' => $user_id,
                        'title' => $title[$i],
                        'link' => $request->input('link_link')[$i],
                    );
                }
            }
            $query = Employee_sociallinks::insert($this->data);
            if($query){
                return redirect()->route('admin.employees')
                    ->with('success','Employee Links Updated successfully.');
            }
            else{
                return redirect()->route('admin.employees')
                    ->with('error','Opps Something Went Wrong.');
            }
        }
        else{
            return redirect()->route('admin.employees')
                ->with('error','No Data Found To Insert');
        }
    }
    function change_user_profile($user_id, Request $request){
        $this->loadBaseData();
        $profile_pic_name = $request->input('pre_profile_image');
        if($_FILES['profile_url']['size'] > 0){
            $profile_pic_name = time().'.'.$request->profile_url->extension();
            $request->profile_url->move(public_path('images/profile'), $profile_pic_name);
        }
        $update_arr = array(
            'profile_pic'           => $profile_pic_name
        );
        $query  = User::where('id', $user_id)->update($update_arr);
        if($query){
            return redirect()->route('admin.employees')
                ->with('success','Employee Profiles Changed.');
        }
        else{
            return redirect()->route('admin.employees')
                ->with('error','Opps Something Went Wrong.');
        }
    }
    function change_password($user_id, Request $request){
        $this->loadBaseData();
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        $update_arr = array(
            'password' => Hash::make($request->input('password')),
        );
        $query  = User::where('id', $user_id)->update($update_arr);
        return redirect()->route('admin.employees')
            ->with('success','Employee Password Changed successfully.');
    }
    public function delete_employee($id){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        User::where('id',$id)->delete(); 
        return redirect()->route('admin.employees')
            ->with('success','Employee Deleted Successfully.');
    }
}