<?php
namespace App\Library;
use Illuminate\Support\Facades\DB;

class Mobilesms {

    public static $intlStatus = false;

  

    public static function inti(){
        self::$intlStatus = true;
    }

    public function __construct()
    {
        if(empty(self::$intlStatus))
        {
            self::inti();
        }
    }
    
     public function send($contacts,$sms_text)
    {
        $sms_text = preg_replace('!\s+!', ' ', $sms_text); // Remove Multipal Space
        $sms_text = str_replace([' <br> ',' <br>','<br> ','<br>',],"\n" ,$sms_text); // manage line break

        if(empty($sms_text))
        {
            return false;
        }

        if(strlen($contacts) < 10)
        {
            return false;
        }

        return $this->submitToServer($contacts,$sms_text);
    }

   public function submitToServer($contacts,$sms_text)
    {
        $api_key = '355FFF4ECDB4BB';
        $from = 'SYMINF';
        //$api_key ='25CD1831300070';
        //$contacts = '97656XXXXX,97612XXXXX,76012XXXXX,80012XXXXX,89456XXXXX,88010XXXXX,98442XXXXX';
        //$from = 'SYMINF';
        //$from = 'TITANS';
        $sms_text = urlencode($sms_text);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, "http://sms.symphonyinfotech.co.in/app/smsapi/index.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=5&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
  public function jobSms($phone,$customer)
{
      $msg='Dear '.$customer.'  your job is created . <br>Thanks For Using GRL';
      $this->send($phone,$msg);
   
}

  public function bilityGenerateSms($phone,$customer)
{
    
      $msg='Dear '.$customer.'  your job Bilty is created  <br>Thanks For Using GRL';
      $this->send($phone,$msg);
   
}

  public function VehicleAllotGenerateSms($phone,$customer,$containerNo,$sLineNo=NULL,$vehicle,$mobile,$res,$bookingNo)
{
 
    
      $msg='Dear '.$customer.' your job <br>Vehicle No :'.$vehicle.'<br>Container No. :'.$containerNo.'<br> S/Line No. :'.$sLineNo.'<br>Shipping Line : '.$res->cont_ship_line.'<br>Origin :'.$res->inl_origin.'<br>Destination : '.$res->inl_destination.'<br>Via :'.$res->inl_via.'<br>Booking No.:'.$bookingNo.'<br>Vehicle Mob No. :'.$mobile.' <br>Thanks For Using GRL';
     //  print_r($msg);die();
      $this->send($phone,$msg);
   
}

public function invoiceGenerateSms($phone,$customer,$amount)
{
     $msg = "Dear ".$customer." <br> Your Invoice is create and total amount : ".$amount."<br>Thanks For Using GRL";
     $this->send($phone,$msg);
}

}