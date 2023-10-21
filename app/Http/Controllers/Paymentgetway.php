<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PaymentDetails_model;
use App\Model\Entry\Service_model;
use \App\Model\UserModel as UserModel;
use App\Http\Requests;
use \App\Model\Entry\Payment_key_model;
use Mail;

class Paymentgetway extends Controller
{
    public $viewData= [];
    public $ViewFile="home"; /*Php File*/
    public $PageFile="page";
    public $title = 'Home';
    public $payu_key ='';
    public $payu_salt='';
    public $payu_type='';
    public $payment_key_type='';
    public function __construct(){
    
        parent::__construct();
        $keyData = Payment_key_model::where('defalut','1')->first();
        $this->payu_key =$keyData->getway_key;
        $this->payu_salt =$keyData->getway_salt;
        $this->payu_type =$keyData->type;
        $this->payment_key_type =$keyData->id;
         
     }
    public function index(){
          
          
         $this->viewData['type'] = $this->payu_type;
         $this->viewData['seoTitle'] = "order now page";
         $this->viewData['seoKeyword'] = "order now page";
         $this->viewData['seoDesc'] = "order now page";
         view()->share($this->viewData);
         return view('paymentgetway/paymentpage');
    }

  public function pdf(){
          
          
         $this->viewData['type'] = $this->payu_type;
         $this->viewData['seoTitle'] = "order now page";
         $this->viewData['seoKeyword'] = "order now page";
         $this->viewData['seoDesc'] = "order now page";
         view()->share($this->viewData);
         return view('paymentgetway/pdf');
    }

   public function quickCheckout($id){
          
         $data = PaymentDetails_model::find(base64_decode($id));
         $data->clcik_count =$data->clcik_count+1;
         $data->updated_at = date('Y-m-d h:i:s');
         $data->save();
         if($data->payment_status!="pending"){
              session()->flash('errorFlash','your request cannot be processed');
            return redirect()->route('paynow');
         }
         
         $this->viewData['payment_data'] = PaymentDetails_model::select('payment_details.*','entry_service.services_name','payment_key.symbol','register_member.rmid','payment_key.merchant_name')->leftJoin('entry_service','entry_service.services_id','=','payment_details.productinfo')->leftJoin('payment_key','payment_key.id','=','payment_details.payment_key_type')->leftJoin('register_member','register_member.id','=','payment_details.rm_id')->where('payment_details.id',$data->id)->first(); 




         $this->viewData['seoTitle'] = "quickCheckout";
         $this->viewData['seoKeyword'] = "quickCheckout";
         $this->viewData['seoDesc'] = "quickCheckout";
         view()->share($this->viewData);
         return view('paymentgetway/direct_payment');
    }
    
     public function success($id=null){
             
      
     $data = PaymentDetails_model::select('payment_details.*','entry_service.services_name','payment_key.symbol','register_member.rmid','payment_key.merchant_name')->leftJoin('entry_service','entry_service.services_id','=','payment_details.productinfo')->leftJoin('payment_key','payment_key.id','=','payment_details.payment_key_type')->leftJoin('register_member','register_member.id','=','payment_details.rm_id')->where('payment_details.id',base64_decode($id))->first();


        if($data->email_status==0){
         $jsone = json_decode($data->jsone);
         $mail_data = array();
         $mail_data['username'] ='Dear '.$data->firstname.' '.$data->Lastname;
         $mail_data['toemail'] =$data->email;
         $mail_data['id'] =$id;
         $mail_data['amount'] =$data->symbol.' '.$data->amount;
         $mail_data['txnid'] =$data->txnid;
         $mail_data['productinfo'] =$jsone->productinfo;
         $mail_data['bank_ref_num'] =$jsone->bank_ref_num;
         $mail_data['subject'] ="your order confirmation transaction id is {".$data->txnid.'}';
          
         Mail::send('emails/payment',$mail_data, function($message)  use ($mail_data) {
         $message->to($mail_data['toemail'], $mail_data['username'])->subject
              ($mail_data['subject']);
          $message->attach(asset('assets/pdf/AHEC_Terms_and_Conditions.pdf'));
          $message->attach(asset('assets/pdf/AHEC_Privacy_Policy.pdf'));
          $message->attach(asset('assets/pdf/AHEC_Refund_and_Return.pdf'));
          $message->from("info@ahecounselling.com","Ahecounselling");
         });
         $data->email_status =1;
         $data->updated_at = date('Y-m-d h:i:s');
         $data->save();
         session()->flash('successFlash','Please Check your mail for more Details');
       }
        
        if(empty($data)){
          session()->flash('errorFlash','your request cannot be processed');
          return redirect()->route('paynow');
         }

         if($data->payment_status!="success"){
          session()->flash('errorFlash','your request cannot be processed');
          return redirect()->route('paynow');
         }
         
         $this->viewData['seoTitle'] = "Payment success";
         $this->viewData['paymentdata'] = $data;
         $this->viewData['jsone'] = json_decode($data->jsone);
         view()->share($this->viewData);
          return view('paymentgetway/success');
     }
    
   public function failed($id=null){
       
       $data = PaymentDetails_model::where('payment_details.id','=',base64_decode($id))->select('payment_details.*','entry_service.services_name','payment_key.symbol','register_member.rmid','payment_key.merchant_name')->leftJoin('entry_service','entry_service.services_id','=','payment_details.productinfo')->leftJoin('payment_key','payment_key.id','=','payment_details.payment_key_type')->leftJoin('register_member','register_member.id','=','payment_details.rm_id')->first();

      

       if($data->email_status==0){
         $jsone = json_decode($data->jsone);
         $mail_data = array();
         $mail_data['username'] ='Dear '.$data->firstname.' '.$data->Lastname;
         $mail_data['toemail'] =$data->email;
         $mail_data['id'] =$id;
         $mail_data['amount'] =$data->symbol.' '.$data->amount;
         $mail_data['txnid'] =$data->txnid;
         $mail_data['productinfo'] =$jsone->productinfo;
         $mail_data['error_Message'] =$jsone->error_Message;
         $mail_data['subject'] ="We Couldn't Process Your Payment | transaction id is {".$data->txnid.'}';
          
         Mail::send('emails/failded',$mail_data, function($message)  use ($mail_data) {
         $message->to($mail_data['toemail'], $mail_data['username'])->subject
              ($mail_data['subject']);
          $message->attach(asset('assets/pdf/AHEC_Terms_and_Conditions.pdf'));
          $message->attach(asset('assets/pdf/AHEC_Privacy_Policy.pdf'));
          $message->attach(asset('assets/pdf/AHEC_Refund_and_Return.pdf'));
          $message->from("info@ahecounselling.com","Ahecounselling");
         });
         $data->email_status =1;
         $data->updated_at = date('Y-m-d h:i:s');
         $data->save();
         session()->flash('successFlash','Please Check your mail for more Details');
     } 
        
        if(empty($data)){
               session()->flash('errorFlash','your request cannot be processed');
               return redirect()->route('paynow');
           }
         $this->viewData['seoTitle'] = "Payment failed";
         $this->viewData['paymentdata'] = $data;
         $this->viewData['jsone'] = json_decode($data->jsone);
         view()->share($this->viewData);
         return view('paymentgetway/failed');
    }
    
   public function savePaymentDetails(Request $request){

         $validatedData = $request->validate([
                'firstname' => 'required',
                'phone' => 'required',
                'payable_amount' => 'required',
                'productinfo' => 'required',
                'email' => 'required|email|'
             ], [
                'firstname.required' => 'Frist Name is required',
                'phone.required' => 'Phone No is required',
                'productinfo.required' => 'Service type  is required',
                'payable_amount.required' => 'Payable Amount is required',
              ]);
          $userData =  UserModel::where('user_email',$request->email)->first();
        
         if(empty($userData)){
               $objuser = new UserModel;
               $objuser->user_name = $request->firstname.' '.$request->Lastname;
               $objuser->user_email = $request->email;
               $objuser->user_password = $request->phone;
               $objuser->mobile     = $request->phone;
               $objuser->phone_code     = '91';
               $objuser->user_status = 2;
               $objuser->rm_id = 0;
               $objuser->save();

                $mail_data = array();
                $mail_data['username'] ='Dear '.$objuser->user_name;
                $mail_data['toemail'] =$objuser->user_email;
                $mail_data['password'] =$objuser->mobile;
              
                Mail::send('emails/login',$mail_data, function($message)  use ($mail_data) {
                   $message->to($mail_data['toemail'], $mail_data['username'])->subject
                      ("Ahecounselling Account login details");
                   $message->from("info@ahecounselling.com","Ahecounselling");
               });
                 
           } 

            $obj = new PaymentDetails_model;
            $obj->firstname = $request->firstname;
            $obj->Lastname = $request->Lastname;
            $obj->email = $request->email;
            $obj->phone = $request->phone;
            $obj->address1 = $request->address1;
            $obj->address2 = $request->address2;
            $obj->Zipcode = $request->Zipcode;
            $obj->city = $request->city;
            $obj->state = $request->state;
            $obj->country = $request->country;
            $obj->amount = $request->payable_amount;
            $obj->productinfo = $request->productinfo;
            $obj->payment_key_type = $this->payment_key_type;
            $obj->txnid = 'Tnx-'.strtotime(date('m/d/Y h:i:s a',time()));
            $obj->created_at = date('Y-m-d h:i:s');
            $obj->updated_at = date('Y-m-d h:i:s');
            if($obj->save()){
               return redirect()->route('PayUBiz', ['id' => base64_encode($obj->id)]);
             }
       }

    public function PayUBiz($id){

            $data = PaymentDetails_model::find(base64_decode($id));

            if(empty($data)){
            	  session()->flash('errorFlash','your request cannot be processed');
            	 return redirect()->route('paynow');
             }
             if($data->payment_status!="pending"){
                session()->flash('errorFlash','your request cannot be processed');
              return redirect()->route('paynow');
             }
            $servicedata = Service_model::find($data->productinfo)->services_name;
             if(empty($servicedata)){
            	 session()->flash('errorFlash','your request cannot be processed');
            	 return redirect()->route('paynow');
             }
            $keyData = Payment_key_model::find($data->payment_key_type);

            $key=$keyData->getway_key;
            $salt=$keyData->getway_salt;
            $udf5 =date('d-m-Y');
            $action = 'https://secure.payu.in/_payment';
            $hash=hash('sha512', $key.'|'.$data->txnid.'|'.$data->amount.'|'.$servicedata.'|'.$data->firstname.'|'.$data->email.'|||||'.$udf5.'||||||'.$salt);
            $html = '<form action="'.$action.'" id="payment_form_submit" method="post">
            <input type="hidden" id="udf5" name="udf5" value="'.$udf5.'" />
            <input type="hidden" id="surl" name="surl" value="'.route('PaymentSuccess').'" />
            <input type="hidden" id="furl" name="furl" value="'.route('Paymentfailed').'" />
            <input type="hidden" id="curl" name="curl" value="'.route('Paymentfailed').'" />
            <input type="hidden" id="key" name="key" value="'.$key.'" />
            <input type="hidden" id="txnid" name="txnid" value="'.$data->txnid.'" />
            <input type="hidden" id="amount" name="amount" value="'.$data->amount.'" />
            <input type="hidden" id="productinfo" name="productinfo" value="'.$servicedata.'" />
            <input type="hidden" id="firstname" name="firstname" value="'.$data->firstname.'" />
            <input type="hidden" id="Lastname" name="Lastname" value="'.$data->Lastname.'" />
            <input type="hidden" id="Zipcode" name="Zipcode" value="'.$data->Zipcode.'" />
            <input type="hidden" id="email" name="email" value="'.$data->email.'" />
            <input type="hidden" id="phone" name="phone" value="'.$data->phone.'" />
            <input type="hidden" id="address1" name="address1" value="'.$data->address1.'" />
            <input type="hidden" id="address2" name="address2" value="'.(isset($data->address2)? $data->address2 : '').'" />
            <input type="hidden" id="city" name="city" value="'.$data->city.'" />
            <input type="hidden" id="state" name="state" value="'.$data->state.'" />
            <input type="hidden" id="country" name="country" value="'.$data->country.'" />
            <input type="hidden" id="Pg" name="Pg" value="'.$data->Pg.'" />
            <input type="hidden" id="hash" name="hash" value="'.$hash.'" />
            </form>
            <script type="text/javascript"><!--
                document.getElementById("payment_form_submit").submit();    
            //-->
            </script>
            <script language="JavaScript">
                 document.onkeypress=function(e){if(123==(e=e||window.event).keyCode)return alert("Error"),!1},document.onmousedown=function(e){if(123==(e=e||window.event).keyCode)return alert("Error"),!1},document.onkeydown=function(e){if(123==(e=e||window.event).keyCode)return alert("Error"),!1};var message="Error";function clickIE(){if(document.all)return!1}function clickNS(e){if((document.layers||document.getElementById&&!document.all)&&(2==e.which||3==e.which))return!1}function disableCtrlKeyCombination(e){var o,n,t=new Array("a","n","c","x","v","j","w","i");if(window.event?(o=window.event.keyCode,n=!!window.event.ctrlKey):(o=e.which,n=!!e.ctrlKey),n)for(i=0;i<t.length;i++)if(t[i].toLowerCase()==String.fromCharCode(o).toLowerCase())return alert("Error"),!1;return!0}document.layers?(document.captureEvents(Event.MOUSEDOWN),document.onmousedown=clickNS):(document.onmouseup=clickNS,document.oncontextmenu=clickIE),document.oncontextmenu=new Function("return false"),document.onkeydown=function(e){return!(e.ctrlKey&&86===e.keyCode||67===e.keyCode||85===e.keyCode||16===e.keyCode||117===e.keyCode)||(alert("Error"),!1)};
                </script>
            ';
            echo $html;
             exit;
       } 

     public function  PaymentSuccess(Request $request){
          
           // $key=$this->payu_key; $salt=$this->payu_salt;
            $data = PaymentDetails_model::where('txnid',$request->txnid)->first();
            $keyData = Payment_key_model::find($data->payment_key_type);
            $key=$keyData->getway_key;
            $salt=$keyData->getway_salt;

          if($data->payment_status!="pending"){
          	session()->flash('errorFlash','your request cannot be processed');
            return redirect()->route('paynow');
           }

         if (isset($request->key)) {

            $key                =   $request->key;
            $txnid              =   $request->txnid;
            $amount             =   $request->amount;
            $productInfo        =   $request->productinfo;
            $firstname          =   $request->firstname;
            $email              =   $request->email;
            $udf5               =   $request->udf5;
            $status             =   $request->status;
            $resphash           =   $request->hash;
            $keyString          =   $key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'|||||';
            $keyArray           =   explode("|",$keyString);
            $reverseKeyArray    =   array_reverse($keyArray);
            $reverseKeyString   =   implode("|",$reverseKeyArray);
            $CalcHashString     =   strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString)); //hash without additionalcharges
            $additionalCharges  =   "";
            If (isset($postdata["additionalCharges"])) {
            $additionalCharges=$postdata["additionalCharges"];
            $CalcHashString  =   strtolower(hash('sha512', $additionalCharges.'|'.$salt.'|'.$status.'|'.$reverseKeyString));
            }
          }   
         if ($status == 'success'  && $resphash == $CalcHashString) {
           
            $verfyData =$this->verifyPayment($request->txnid,$request->status);
              if($verfyData==false){
                 session()->flash('errorFlash','Unable to verify your payment');
                 return redirect()->route('paynow');
               }             
          } else {
               session()->flash('errorFlash','Payment failed for Hash not verified...');
                 return redirect()->route('paynow');
          }
          $data->jsone =json_encode($verfyData[$request->txnid]);
          $data->payment_status =$request->status;
          $data->updated_at = date('Y-m-d h:i:s');
          $data->save();

           return redirect()->route('success', ['id' => base64_encode($data->id)]);
      }

     public function  Paymentfailed(Request $request){

          $data = PaymentDetails_model::where('txnid',$request->txnid)->first();
       	 if($data->payment_status!="pending"){
          	session()->flash('errorFlash','your request cannot be processed');
            return redirect()->route('paynow');
          }
           $verfyData =$this->verifyPayment($request->txnid,$request->status);
          if($verfyData==false){
          	 session()->flash('errorFlash','Unable to verify your payment');
             return redirect()->route('paynow');
           }
          $data->jsone =json_encode($verfyData[$request->txnid]);
          $data->payment_status =$request->status;
          $data->updated_at = date('Y-m-d h:i:s');
          $data->save();
          return redirect()->route('failed', ['id' => base64_encode($data->id)]);
    
      }


  function verifyPayment($txnid,$status){

    $data = PaymentDetails_model::where('txnid',$txnid)->first();
    $keyData = Payment_key_model::find($data->payment_key_type);
    $key=$keyData->getway_key; $salt=$keyData->getway_salt;
    $command = "verify_payment"; //mandatory parameter
    $hash_str = $key  . '|' . $command . '|' . $txnid . '|' . $salt ;
    $hash = strtolower(hash('sha512', $hash_str)); //generate hash for verify payment request
    $r = array('key' => $key , 'hash' =>$hash , 'var1' => $txnid, 'command' => $command);
    $qs= http_build_query($r);
     $wsUrl = "https://info.payu.in/merchant/postservice.php?form=2";
    try {       
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $wsUrl);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $qs);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSLVERSION, 6); //TLS 1.2 mandatory
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
        $o = curl_exec($c);
        if (curl_errno($c)) {
            $sad = curl_error($c);
            throw new Exception($sad);
        }
        curl_close($c);
        $response = json_decode($o,true);
        if(isset($response['status'])){
            $transaction_details = $response['transaction_details'];
            $response = $response['transaction_details'];
            $response = $response[$txnid];
            
            if($response['status'] == $status) //payment response status and verify status matched
                return $transaction_details;
            else
                return false;
        }
        else {
            return false;
        }
    }
    catch (Exception $e){
        return false;   
    }
  }
}


 
 

