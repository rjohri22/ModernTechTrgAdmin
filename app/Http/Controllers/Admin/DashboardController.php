<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job_applications;
use App\Models\Admin\Oppertunities;
use App\Models\Admin\BusinessLocations;
use Illuminate\Support\Facades\Auth;
use Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Admin\Countries;
use App\Models\Admin\States;
use App\Models\Admin\Cities;


class DashboardController extends AdminBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function __construct(Request $request)
    {
        parent::__construct($request);
        
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
        $this->loadBaseData();
        if(!$this->check_role()){
             return redirect()->route('home');
        };
        // $user_id = Auth::user()->id;
        // $this->data['login_detail'] = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();
        $this->data['total_oppertunity'] = Oppertunities::count();
        $this->data['total_jobseeker'] = User::where('group_id', 2)->count();
        $this->data['total_applications'] = Job_applications::count();
        return view('admin.dashbaord',$this->data);
    }

    public function loginverification(){
        $this->loadBaseData();
        $this->data = false;
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();
        if($user->group_id == 1){
           $this->data = true;
        }
        return $this->data;
    }

    function send_email($to, $subject, $message){
        $this->loadBaseData();
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
        $this->loadBaseData();
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

    function load_business_country(Request $request ){
        $this->loadBaseData();
        $this->data['codestatus'] = true;
        $this->data['html'] = '';
        $countries = BusinessLocations::select('countries.*')->join('countries','countries.id','=','business_locations.country_id')->groupBY('business_locations.country_id')->where('business_locations.company_id',$request->id)->get();
        // $cities = Cities::where('state_id',$request->id)->get('countries.id','countries.name');    
        foreach($countries as $coun){
            $this->data['html'] .= "<option value='".$coun->id."'>".$coun->name."</option>";
        }
        return response()->json($this->data);
    }

    function load_business_state(Request $request ){
        $this->loadBaseData();
        $this->data['codestatus'] = true;
        $this->data['html'] = '';
        $states = States::where('country_id',$request->id)->get(); 
        foreach($states as $state){
            $this->data['html'] .= "<option value='".$state->id."'>".$state->name."</option>";
        }
        return response()->json($this->data);
    }
    function load_business_city(Request $request ){
        $this->loadBaseData();
        $this->data['codestatus'] = true;
        $this->data['html'] = '';
        $cities = Cities::where('state_id',$request->id)->get(); 
        foreach($cities as $city){
            $this->data['html'] .= "<option value='".$city->id."'>".$city->name."</option>";
        }
        return response()->json($this->data);
    }
    
    function load_round(Request $request ){
        $this->loadBaseData();
        $this->data['codestatus'] = true;
        $this->data['html'] = '';
        $questions = Question::where('interview_id',$request->id)->get(); 
        foreach($questions as $question){
            $this->data['html'] .= "<option value='".$question->id."'>".$question->round_no."</option>";
        }
        return response()->json($this->data);
    }
    


}
