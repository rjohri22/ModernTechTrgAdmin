<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job_applications;
use App\Models\Admin\Oppertunities;
use Illuminate\Support\Facades\Auth;
use Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class DashboardController extends AdminBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function __construct()
    {
        
        $this->middleware('auth');
        // echo Session::get('admin_login');
        // die();
        // $user_id = Auth::user()->id;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!$this->check_role()){
             return redirect()->route('home');
        };
        // $user_id = Auth::user()->id;
        // $data['login_detail'] = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();
        $data['total_oppertunity'] = Oppertunities::count();
        $data['total_jobseeker'] = User::where('group_id', 2)->count();
        $data['total_applications'] = Job_applications::count();
        return view('admin.dashbaord',$data);
    }

    public function loginverification(){
        echo "<pre/>".print_r(Auth::user(),1);die();
        $data = false;
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        if($user->group_id == 1){
           $data = true;
        }
        return $data;
    }

    function send_email($to, $subject, $message){
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);
        try {
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'developertest389@gmail.com';   //  sender username
            $mail->Password = 'sptljvffxzvtfzkn';       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465
 
            $mail->setFrom('developertest389@gmail.com', 'Modern Developement');
            $mail->addAddress($to);
            // $mail->addCC($request->emailCc);
            // $mail->addBCC($request->emailBcc);
 
            // $mail->addReplyTo('sender@example.com', 'SenderReplyName');
 
            // if(isset($_FILES['emailAttachments'])) {
            //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
            //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
            //     }
            // }
 
 
            $mail->isHTML(true);                // Set email content format to HTML
 
            $mail->Subject = $subject;
            $mail->Body    = $message;
 
            // $mail->AltBody = plain text version of email body;
 
            if( !$mail->send() ) {
                // return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                return true;
            }
            
            else {
                // return back()->with("success", "Email has been sent.");
                return false;
            }
 
        } catch (Exception $e) {
             // return back()->with('error','Message could not be sent.');
             return false;
        }

    }

    public function change_status(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        
        if($status == 4){
           $this->send_email('salmanzain786@outlook.com','TEST EMAIL','THIS IS TEST EMAIL');
        }
        $update_arr = array(
            'status' => $status
        );
        $query  = Job_applications::where('id', $id)->update($update_arr);
        // echo $query;
        // die();
        if($query){
            $res = array('status' => '1', 'message'=>'success');
        }else{
            $res = array('status' => '0', 'message'=>'failed');
        }
        echo json_encode($res);
    }

}
