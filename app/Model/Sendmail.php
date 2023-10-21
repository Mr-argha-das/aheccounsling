<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Sendmail extends Model
{
   
    public function __construct()
    {

    }
    
    public static function setupMail($subject,$message,$to)
    {
        $mail = new PHPMailer(true);

            
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
              //  $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'mail.ahecounselling.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'info@ahecounselling.com';                     // SMTP username
                $mail->Password   = 'ahecounselling@123';                               // SMTP password
               // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
                //Recipients
                $mail->setFrom('info@ahecounselling.com', 'AHECounselling');
                
                
                $mail->addAddress($to,'AHECounselling.com');   
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    =$message;
           
               return $res = $mail->send();
                
              
    }
 
}