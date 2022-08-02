<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends AdminBaseController
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function emailsmpt(){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        return view('admin/setting/emailsmpt');
    }
}