<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\settings;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SettingController extends AdminBaseController
{
	public function __construct(Request $request)
    {
        parent::__construct($request);
    	$this->middleware('auth');
    }

    public function emailsmpt(){
        $this->loadBaseData();
    	if(!$this->check_role()){
            return redirect()->route('home');
        };

        $this->data['smtp']  = settings::where('id', 1)->first();
        return view('admin/setting/emailsmpt',$this->data);
    }

    public function store_setting(Request $request)
    {
        $this->loadBaseData();
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

    public function test_email(Request $request){
        $this->loadBaseData();
        if(!$this->check_role()){
            return redirect()->route('home');
        };
        $validated = $request->validate([
            'send_email' => ['required', 'string', 'max:255'],
        ]);

        $res = $this->send_email($request->input('send_email'),'TEST EMAIL','HEY CLIENT, THIS EMAIL WAS SENT TO YOU FOR PURPOSE FROM MODERNTECH TEAM ! PLEASE IGNORE THIS EMAIL');

        if($res){
            return redirect()->route('admin.setting.emailsmtp')
        ->with('success','Mail Send Successfully.');
        }else{
            return redirect()->route('admin.setting.emailsmtp')
        ->with('error','Mail Could not be Send.');
        }



    }

    function send_email($to, $subject, $message){
        $this->loadBaseData();
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);
        $settings = settings::where('id', 1)->first();

        try {
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            // $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->Host = $settings->smtp_host;             //  smtp host
            $mail->SMTPAuth = true;
            // $mail->Username = 'developertest389@gmail.com';   //  sender username
            // $mail->Password = 'sptljvffxzvtfzkn';       // sender password
            $mail->Username = $settings->smtp_username;   //  sender username
            $mail->Password = $settings->smtp_password;       // sender password
            // $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->SMTPSecure = $settings->smtp_mail_encryption;                  // encryption - ssl/tls
            // $mail->Port = 587;                          // port - 587/465
            $mail->Port = $settings->smtp_port;                          // port - 587/465
 
            $mail->setFrom($settings->smtp_username, $settings->smtp_mail_from_name);
            // $mail->setFrom('developertest389@gmail.com', 'Modern Developement');
            $mail->addAddress($to);
 
            $mail->isHTML(true);                // Set email content format to HTML
 
            $mail->Subject = $subject;
            $mail->Body    = $message;
 
            // $mail->AltBody = plain text version of email body;
 
            if( !$mail->send() ) {
                // return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                return false;
            }
            
            else {
                // return back()->with("success", "Email has been sent.");
                return true;
            }
 
        } catch (Exception $e) {
             // return back()->with('error','Message could not be sent.');
             return false;
        }

    }
}