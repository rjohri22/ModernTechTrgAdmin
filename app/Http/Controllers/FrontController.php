<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee_educations;
use App\Models\Employee_works;
use App\Models\Employee_languages;
use App\Models\Employee_cirtificates;
use App\Models\Employee_sociallinks;
use App\Models\Job_applications;
use App\Models\Admin\Jobs;
use App\Models\Admin\Oppertunities;
use Illuminate\Support\Facades\Auth;
use Session;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  
    public function index()
    {

    }

    public function career(){
        $data['Jobs'] = Jobs::join('bends','bends.id','=','jobs.band_id')->join('countries','countries.id','=','jobs.country_id')->select(['jobs.*','countries.name as country','bends.name as band_name'])->where('jobs.hr_head_approval','>','0')->get();
         return view('career',$data);   
    }
}
?>