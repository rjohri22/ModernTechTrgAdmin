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
use Illuminate\Support\Facades\Artisan;
use Session;

class ServerresetController extends Controller
{
    public function index(){
        echo 'Server Reset<br>';
        echo 'Run Migrate Command<br>';
        $migration = Artisan::call('migrate');
        echo 'Run Optimize Command<br>';
        $optimize = Artisan::call('optimize');
        
    }
}