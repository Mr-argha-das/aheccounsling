<?php

namespace App\Library;

use Illuminate\Support\Facades\DB;

class Arraydb {

    public static $orderStatus= [1=>'Alloted',2=>'Feedback',3=>'Delivered',4=>'Study Matirials',5=>'Passed',6=>'Failed',7=>'Processing'];

    public static $clientOrderStatus= [4=>'Delivered',1=>'Order Created',2=>'Processing',3=>'Work Done',];

    public static $intlStatus = false;

    public static $statusAI= [1=>'Active',2=>'Inactive'];

    public static $ventures= [1=>'AHEC',2=>'Universities Hub'];

    public static $status= [''=>'Select Option',1=>'Yes',2=>'No'];

    public static $workingStatus= [1=>'Working',2=>'Not Working'];

    public static $gender=[0=>"Male",1=>"Female"];

    public static $merritalStatus=[1=>"Single",2=>"Married",3=>"Widow",4=>"Divorcee"];

    public static $employeeType=[1=>'REP',2=>'UEP'];

    public static $Fright = ['' => 'Select' , 1 => 'Paid' , 2 => 'To pay ' , 3 => 'To be billed' ];

    public static $StatusI= [1=>'Open',2=>'Close'];

    public static $paymentType  = [''=>'select',1=>'Cash',2=>'Bank'];

    public static $vehicleStatus = [''=>'Select',1=>'No',2=>'Yes'];

    public static $vehicleWorkStatus = [''=>'Select',1=>'Pending',2=>'Alloted'];

    public static $cashType = [''=>'Select Option',1=>'Received',2=>'Withdraw'];

    public static $loginType = [''=>'Select Type','Admin'=>'Admin','Allotment'=>'Vehicle Allotment','Container'=>'Container Allotment'];

    public static $logType = [1=>'Add',2=>'Update'];

    public static $loginUsers = [''=>'Select Type',1=>'Admin',2=>'Business Development Executive',3=>'Manager',4=>'Accountant',4=>'Accountant',5=>'Work Allocator'];

    public static $categorylist = [''=>'select Category',1=>'A','B','C','D'];

    public static $visitType = [''=>'Select Option',1=>'Company',2=>'Customer'];

    public static $transactionType = [''=>'Select Option',1=>'Online Payment','Cash','Cheque','other'];

    public static $TicketStatus  = [1=>'Open ','Close'];

    public static $hollydayStatus  = [1=>'Working',2=>'Sunday',3=>'Hollyday'];

    public static $AttendanceStatus  = [1=>'Present',2=>'Absent',3=>'Half Day'];

     public static $inputType = [1=>'Text',2=>'TextArea'];

    public $OptionOrder;

    private $str = NULL;

public $key = 'keytesting';

    public static function inti(){

        self::$intlStatus = true;

    }



    public static function numberrange(){

        $data =[];

       $data = [1=>'Monthly',2=>'Fortnightly',3=>'Weekly'];



        return $data;

    }



    public static function getYear()

    {

        $data =[];

        $data=[''=>'select Year'];

        $reg = range(2020,2030);

        foreach ($reg as $key => $value) {

            $data[$value] = $value;

        }



        return $data;

    }



    public static function getMonth()

    {

        $data = [];

        $data=[''=>'select Month'];

         $reg =['01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'Octomber','11'=>'Novembe','12'=>'December'];

           foreach ($reg as $key => $value) {

            $data[$key] = $value;

        }



        return $data;

    }



    public function __construct()

    {

        if(empty(self::$intlStatus))

        {

            self::inti();

        }

    }

    public function TableToArray($ID,$COL,$TABLE,$DEFAULT=NULL,$DEFAULTVALUE='')

    {

         $Options=array();

        if(!empty($DEFAULT)){

            $Options=array($DEFAULTVALUE=>$DEFAULT);

        }

    $RES = DB::table($TABLE)->orderBy($COL,'asc')->get();

    if(!empty($RES))

        {

            foreach($RES as $OB)

            {

                $Options[$OB->$ID]=$OB->$COL;

            }

        }

      return $Options;

    }

    public function invoiceNo($id =NULL)

    {

      $maxid="(select max(invoice_no)inv from entry_invoice)";

      $ROW = DB::SELECT($maxid);

      foreach($ROW as $row)

      {

         $str = $row->inv+1;

      }

        return $str;

     // $str = $ROW->inv+1;

     //return $str;

    }

    public function NumberPad($no,$str=NULL,$legnth=4){

      $no=empty($no)?die:$no;

      $str=empty($str)?'':$str.'/';

      return $str.sprintf('%0'.$legnth.'d',$no);

    // $this->TableToArray



  }

    public  function encrypt($plainText){

        $key = $this->hextobin(md5($this->key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($openMode);
        return $encryptedText;
 }



/*

* @param1 : Encrypted String

* @param2 : Working key provided by CCAvenue

* @return : Plain String

*/

 public  function decrypt($encryptedText)

{

    $key = $this->hextobin(md5($this->key));

    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);

    $encryptedText = $this->hextobin($encryptedText);

    $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);

    return $decryptedText;

}



 public  function hextobin($hexString) 

 { 

    $length = strlen($hexString); 

    $binString="";   

    $count=0; 

    while($count<$length) 

    {       

        $subString =substr($hexString,$count,2);           

        $packedString = pack("H*",$subString); 

        if ($count==0)

        {

            $binString=$packedString;

        } 

        

        else 

        {

            $binString.=$packedString;

        } 

        

        $count+=2; 

    } 

        return $binString; 

  } 



    

    public static function TableConvetArray($table,$col,$id,$DEFAULT=NULl,$where=NULL)

    {

        $postData = [];

        if(!empty($DEFAULT))

        {

            $postData[''] = $DEFAULT;

        }



        $DB = DB::table($table);

        if(!empty($where))

        {

            $DB->where($where);

        }

        $RES = $DB->get();

        if(!empty($RES))

        {

            foreach($RES as $key =>$ob)

            {

                $postData[$ob->$id] = $ob->$col;

            }

        }



        return $postData;

    }

    public function OrderArrayPages()

    {

        $this->OptionOrder[250] = 'Default';

        foreach (range(1,249) as $i)

        {

            $this->OptionOrder[$i] = $i;

        }

        return $this->OptionOrder;

    }

    

        public function ParentList($parent,$flag = NULL)

    {

      

        if ($flag == NULL) {

            $this->str = array();

        } 

     

        if ($parent != 0) {

              $OB =DB::table('entry_menu')->where('menu_id','=',$parent)->first();

           

            $this->str[] = $OB->menu_name;



          return $this->ParentList($OB->menu_parent,2);

          

        } else {

            //$this->str[]='Main';

            array_multisort($this->str, SORT_DESC, SORT_NUMERIC);

            $st = '';

            

            foreach ($this->str as $val) {

                $st .= $val . ' > ';

            }

            return $st;

        }

    }



    public function catList()

    {

        $Options = array(0 => ' :Root');

        if (!empty($Default)) {

            $Options = array('' => $Default);

        }

        $RES =  DB::table('entry_menu')->get();

        if (!empty($RES)) {

            foreach ($RES as $OB) {

                $Options[$OB->menu_id] = $this->ParentList($OB->menu_parent) . $OB->menu_name;



            }

        }



        return $Options;

    }

   



}