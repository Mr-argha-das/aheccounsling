<?php
namespace App\Library;
use Illuminate\Support\Facades\DB;

class Customfunction {

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
  }

  public function invoice($val,$session_id)
{
    if(!empty($val))
    {
        echo $this->invoicePRINT($val,$session_id);
    }
 else {

     echo "No Invoice";
 }
}

public function invoicePRINT($val,$session_id)
{
    if(!empty($val))
    {
     $S_year =  DB::table('master_session')->where('session_id',$session_id)->first();
   
        return $this->NumberPad($val,'GRL').'/'.date('y',strtotime($S_year->session_start)).'/'.date('y',strtotime($S_year->session_end));
    }
 else {

    return false;
 }

}
public function Words($no)
  {
    $Value =$this->noToWords($no);
    return $Value .'& only' ;

  }

   

  public function noToWords($no)
  {
  $words = array('0'=>'','1'=>'One','2'=>'Two','3' =>'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fourteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred ','1000' => 'Thousand','100000' => 'Lacs','10000000' => 'Crore');
    if($no == 0){
      return '';
    }else{
      $novalue='';
      $highno=$no;
      $remainno=0;
      $value=100;
      $value1=1000;
      while($no>=100) {
        if(($value <= $no) &&($no < $value1)) {
          $novalue=$words["$value"];
          $highno = (int)($no/$value);
          $remainno = $no % $value;
          break;
        }
        $value= $value1;
        $value1 = $value * 100;
      }

      if(array_key_exists("$highno",$words)){
        return $valReturn= $words["$highno"]." ".$novalue." ".$this->noToWords($remainno);

      }else {
        $unit=$highno%10;
        $ten =(int)($highno/10)*10;
        return $valReturn= $words["$ten"]." ".$words["$unit"]." ".$novalue." ".$this->noToWords($remainno);

      }


    }

  }

}