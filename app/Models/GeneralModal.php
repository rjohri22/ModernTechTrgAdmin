<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\settings;
use App\Models\Admin\Calenders;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class GeneralModal extends Model
{
    use HasFactory;

  static function send_email($to, $subject, $message){
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
            // $mail->addAddress($to);
            $to_email='rjohri22@gmail.com';
            $mail->addAddress($to_email);
 
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
