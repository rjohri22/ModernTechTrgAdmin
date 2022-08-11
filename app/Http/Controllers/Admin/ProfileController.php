<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Controllers\Admin\AdminBaseController;

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
use Session;

class ProfileController extends Controller
{
    public function view( )
    {
         //$user = auth::user();
         $user = Auth::user()->id;
        //  echo "<pre>";
        //  print_r($check);
        //    return view('admin/profile/view',$user);
      

        $data['user'] = User::where('id', $user)->first();
        $data['education'] = Employee_educations::where('user_id', $user)->get();
        $data['works'] = Employee_works::where('user_id', $user)->get();
        $data['language'] = Employee_languages::where('user_id', $user)->get();
        $data['certificate'] = Employee_cirtificates::where('user_id', $user)->get();
        $data['links'] = Employee_sociallinks::where('user_id', $user)->get();
        $data['bends'] = Bend::get();
        $data['business'] = Companies::get();
        $data['countries'] = Countries::get();
        return view('admin/profile/view',$data);
    }

    public function update_profile_resume($id, Request $request){
        // if(!$this->check_role()){
        //     return redirect()->route('home');
        // };

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
        return redirect()->route('admin.view_profile')
        ->with('success','oppertunity Updated successfully.');
    }

    public function store_profile_education($user_id, Request $request){ 
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
     $data = array();
     if(count((array)$institude_name) > 0){
        for($i=0; $i< count($institude_name); $i++){
            if($request->input('insert_update')[$i] == 0){
                $data[] = array(
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
        $query = Employee_educations::insert($data);
        if($query){
            return redirect()->route('admin.view_profile')
            ->with('success','oppertunity Updated successfully.');
        }else{
            return redirect()->route('admin.view_profile')
            ->with('error','Opps Something Went Wrong.');
        }
    }else{
        return redirect()->route('admin.view_profile')
        ->with('error','No data Found To Insert.');
    }
}


public function store_profile_experience($user_id, Request $request){
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
 $data = array();
 if(count((array)$compnay) > 0){
    for($i=0; $i< count($compnay); $i++){
        if($request->input('insert_update')[$i] == 0){
            $data[] = array(
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
    $query = Employee_works::insert($data);
    if($query){
        return redirect()->route('admin.view_profile')
        ->with('success','oppertunity Updated successfully.');
    }else{
       return redirect()->route('admin.view_profile')
       ->with('error','Opps Something Went Wrong.');
   }
}else{
   return redirect()->route('admin.view_profile')
   ->with('error','No Data Found To Insert');
}
}


public function store_profile_certificate($user_id, Request $request){
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
 $data = array();
 if(count((array)$title) > 0){
    for($i=0; $i< count($title); $i++){
        if($request->input('insert_update')[$i] == 0){
            $data[] = array(
                'user_id' => $user_id,
                'title' => $title[$i],
                'institute_name' => $request->input('certificate_institude')[$i],
                'period_from' => $request->input('certificate_from')[$i],
                'period_to' => $request->input('certificate_to')[$i],
                'description' => $request->input('certificate_description')[$i],
            );
        }
    }
    $query = Employee_cirtificates::insert($data);
    if($query){
        return redirect()->route('admin.view_profile')
        ->with('success','oppertunity Updated successfully.');
    }else{
        return redirect()->route('admin.view_profile')
        ->with('error','Opps Something Went Wrong.');
    }
}else{
 return redirect()->route('admin.view_profile')
 ->with('error','No Data Found To Insert');
}
}





public function store_profile_language($user_id, Request $request){
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
 $data = array();
 if(count((array)$title) > 0){
    for($i=0; $i< count($title); $i++){
        if($request->input('insert_update')[$i] == 0){
            $data[] = array(
                'user_id' => $user_id,
                'title' => $title[$i],
                'proficiency' => $request->input('language_profiency')[$i],
            );
        }
    }
    $query = Employee_languages::insert($data);
    if($query){
     return redirect()->route('admin.view_profile')
     ->with('success','oppertunity Updated successfully.');
 }else{
    return redirect()->route('admin.view_profile')
    ->with('error','Opps Something Went Wrong.');
}
}else{
    return redirect()->route('admin.view_profile')
    ->with('error','No Data Found To Insert');
}
}

public function store_profile_link($user_id, Request $request){
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
 $data = array();
 if(count((array)$title) > 0){
    for($i=0; $i< count($title); $i++){
        if($request->input('insert_update')[$i] == 0){
            $data[] = array(
                'user_id' => $user_id,
                'title' => $title[$i],
                'link' => $request->input('link_link')[$i],
            );
        }
    }
    $query = Employee_sociallinks::insert($data);
    if($query){
        return redirect()->route('admin.view_profile')
        ->with('success','oppertunity Updated successfully.');
    }else{
        return redirect()->route('admin.view_profile')
        ->with('error','Opps Something Went Wrong.');
    }
}else{
    return redirect()->route('admin.view_profile')
    ->with('error','No Data Found To Insert');
}
}

}
