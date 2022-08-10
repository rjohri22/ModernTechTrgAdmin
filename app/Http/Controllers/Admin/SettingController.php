<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\settings;

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

    public function store_setting(Request $request)
    {
        if(!$this->check_role()){
            return redirect()->route('home');
        };

        $validated = $request->validate([
            'smtp_host' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'mail_encryption' => ['required'],
            'password' => ['required', 'string', 'min:8'],
            'smtp_port' => ['required', 'numeric'],
            'mail_from_name' => ['required', 'string'],
        ]);

        $update_arr = array(
            'smtp_host' => $request->input('smtp_host'),
            'username' => $request->input('username'),
            'mail_encryption' => $request->input('mail_encryption'),
            'smtp_port' => $request->input('smtp_port'),
            'password' => Hash::make($request->input('password')),
            'mail_from_name' => $request->input('mail_from_name'),
            
        );

        $query  = settings::where('id', $id)->update($update_arr);
        return redirect()->route('admin.setting.emailsmtp')
        ->with('success','oppertunity created successfully.');
    }





}