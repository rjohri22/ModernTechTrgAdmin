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
	public function __construct(Request $request)
    {
        parent::__construct($request);
    	$this->middleware('auth');
    }

    public function emailsmpt(){
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        $data['smtp']  = settings::where('id', 1)->first();
        return view('admin/setting/emailsmpt',$data);
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
            'smtp_username' => $request->input('username'),
            'smtp_mail_encryption' => $request->input('mail_encryption'),
            'smtp_port' => $request->input('smtp_port'),
            'smtp_password' => $request->input('password'),
            'smtp_mail_from_name' => $request->input('mail_from_name'),
            
        );

        $query  = settings::where('id', 1)->update($update_arr);
        return redirect()->route('admin.setting.emailsmtp')
        ->with('success','oppertunity created successfully.');
    }





}