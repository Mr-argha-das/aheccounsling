<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Entry\RegisterMember_model;
use App\Model\Country_model;
use \App\Model\UserModel as UserModel;
use App\Model\Api_Model;
use \App\Model\Website\QueryModel as QueryModel;
use Carbon\Carbon;
use Mail; 
use DB;
use \App\Model\Entry\Work_status;
use App\Model\PaymentDetails_model;
use \App\Model\Entry\Payment_key_model;
use \App\Model\Login_model as login_model;
use \App\Model\Entry\Client_Work_status;
 class ApiController extends Controller{
     
     public function __construct(){
      date_default_timezone_set("Asia/Calcutta");
     } 
   
    public function paymentGetwayKey(Request $request){

        $validator = Validator::make($request->all(), [
           "rm_id"=>"required",                    
           "type"=>"required",                    
          ]);
        if($validator->fails()){ 
          return $this->error_message($validator->errors());
        }
         $paymentGetwayKey = Payment_key_model::select('type','id')->get();
         return response()->json([
                      'status' => 200,
                      'paymentGetwayKeyList' => $paymentGetwayKey,
                     ], 200);
     }

   public function createpaymentlink(Request $request){

           $validator = Validator::make($request->all(), [
               "rm_id"=>"required",                    
               "type"=>"required",                    
               "client_id"=>"required",                    
               "amount"=>"required",                    
               "service_id"=>"required",                    
               "currenct_type"=>"required",                    
              ]);
              
             if($validator->fails()){ 
              return $this->error_message($validator->errors());
              }
           
            $clientData = UserModel::find($request->client_id);
            $obj = new PaymentDetails_model;
            $obj->firstname = $clientData->user_name;
            $obj->Lastname = null;
            $obj->email = $clientData->user_email;
            $obj->phone = $clientData->phone_code.' '.$clientData->mobile;
            $obj->address1 = $clientData->univercity_name;
            $obj->address2 = null;
            $obj->Zipcode = null;
            $obj->city = null;
            $obj->state = null;
            $obj->country = null;
            $obj->amount = $request->amount;
            $obj->productinfo = $request->service_id;
            $obj->rm_id = $clientData->rm_id;
            $obj->client_id = $request->client_id;
            $obj->payment_key_type = $request->currenct_type;
            $obj->txnid = 'Tnx-'.strtotime(date('m/d/Y h:i:s a',time()));

            if($obj->save()){
                return response()->json([
                       'message'  =>'Quick Link Successfully Created',
                       'status' => 200,
                     ], 200);
             } 
       
    }

     public function getpaymentlink($rm_id=null){

              if($rm_id!=null){
                $getpaymentlinkList = PaymentDetails_model::select('payment_details.*','entry_service.services_name','payment_key.symbol')->join('entry_service','entry_service.services_id','=','payment_details.productinfo')->join('payment_key','payment_key.id','=','payment_details.payment_key_type')->where('rm_id',$rm_id)->orderBy('id','desc')->paginate(20);
               }else{
                  $getpaymentlinkList = PaymentDetails_model::select('payment_details.*','entry_service.services_name','payment_key.symbol')->join('entry_service','entry_service.services_id','=','payment_details.productinfo')->join('payment_key','payment_key.id','=','payment_details.payment_key_type')->orderBy('id','desc')->paginate(20); 
                }
              return response()->json([
                 'getpaymentlinkList'  =>$getpaymentlinkList,
                 'status' => 200,
               ], 200);
      }

   public function getClientListfullByRm($rm_id=null){
        $getUserList = UserModel::select('user_login.*','register_member.name as rm_user_name')->where(function ($query) {
                      $query->where('is_multipal', '=', 0)
                            ->orWhere('is_approved', '=', 1);
                        })->orderBy('user_id', 'DESC')
                      ->join('register_member','register_member.id','=','user_login.rm_id')
                      ->where('rm_id',$rm_id)->get();
        return response()->json([
             'usersList'  =>$getUserList,
             'status' => 200,
           ], 200);
        }

    public function paymentlinkdelete($id){
        
       $userData =  PaymentDetails_model::findOrFail($id);
       $userData->delete();
       return response()->json([
                'message'  =>"Payment Link Delete Successfully",
                 'status' => 200,
               ], 200);
       
    }
    public function paymentlinkdetails($id){
       $userData =  PaymentDetails_model::findOrFail($id);
       return response()->json([
                 'data'  =>$userData,
                 'status' => 200,
               ], 200);
    }
   public function CountryCodeList(Request $request){

          $validator = Validator::make($request->all(), [
           "user_id"=>"required",                    
          ]);
          if($validator->fails()){ 
           return $this->error_message($validator->errors());
          }
          
        $cuntoryCode = Country_model::pluck('phonecode','id');
        return response()->json([
                      'status' => 200,
                      'countryCodeList' => $cuntoryCode,
                     ], 200);
      }
      
      public function serviceList(Request $request){
          $serviceList = \App\Model\Entry\Service_model::orderBy('services_id','asc')->pluck('services_name','services_id');
          return response()->json([
                      'status' => 200,
                      'serviceList' => $serviceList,
                     ], 200);
         } 
      public function currencyList(Request $request){
           $currencyList = \App\Model\Entry\Currency_model::get();
           return response()->json([
                        'status' => 200,
                        'currencyList' => $currencyList,
                       ], 200);
         } 
         
       public function rmidList(Request $request){
             
             $rmidlist  = RegisterMember_model::makeArray();
             return response()->json([
                          'status' => 200,
                          'rmidlist' => $rmidlist,
                         ], 200);
        }

     public function error_message($errors){

               $ers="";
              foreach($errors->all() as $vt){
                if(empty($ers))
                  $ers=$vt;
                else
                 $ers=$ers.",".$vt;
               }

              return response()->json([
                 'message'  =>$ers,
                 'status' => 300,
                 'otp'  => 0,
              ], 200);
         }

   
       public function getClientList($rm_id=null){
            
              if($rm_id!=null){
                $getUserList = UserModel::select('user_login.*','register_member.name as rm_user_name')->orderBy('user_id', 'DESC')
                 ->join('register_member','register_member.id','=','user_login.rm_id')
                 ->where('rm_id',$rm_id)->paginate(20);
               }else{

                  $getUserList = UserModel::select('user_login.*','register_member.name as rm_user_name')->orderBy('user_id', 'DESC')
                  ->join('register_member','register_member.id','=','user_login.rm_id')
                  ->paginate(20);
               }
              return response()->json([
                 'usersList'  =>$getUserList,
                 'status' => 200,
               ], 200);
        }


        public function addOrderClientList($rm_id=null){

              $getUserList = UserModel::where(function ($query) {
                  $query->where('is_multipal', '=', 0)
                        ->orWhere('is_approved', '=', 1);
              })->where('rm_id',$rm_id)->get();
                            $data= array();
              foreach ($getUserList as $key => $value) {
                  $data[$value->user_email] = $value->user_name.'('.$value->mobile.')';
              }

               return response()->json([
                 'usersList'  =>$data,
                 'status' => 200,
               ], 200);
        }


    public function insertClientData(Request $request){
          
            $userData =  UserModel::where('user_email',$request->email)->where('rm_id',$request->rm_id)->first();
           if(empty($userData)){
               $messages ="Successfully Saved";
               $objuser = new UserModel;
               $preData =  UserModel::where('user_email',$request->email)->get();
               if(!empty($preData)){
                $rm_ids_list = '';
                foreach ($preData as $key => $value) {
                    $rm_ids_list .= $value->rm_id. ','; 
                }
                if($rm_ids_list!=''){

                  $objuser->rm_ids_list = trim($rm_ids_list, ',');     
                $objuser->is_multipal =1;
                $objuser->is_approved =0;
                $messages ="This user is alredy exists. Plz contact to admin for approved status";

                }
                
               }
               $objuser->user_name = $request->first_name.' '.$request->last_name;
               $objuser->user_email = $request->email;
               $objuser->user_password = $request->phone_number;
               $objuser->mobile     = $request->phone_number;
               $objuser->phone_code     = $request->country_code;
               $objuser->user_status = 2;
               $objuser->rm_id = $request->rm_id;
               $objuser->univercity_name = $request->univercity_name;
               $objuser->save();
                   
              }else{

                    return response()->json([
                       'message'  =>"Either email or phone number already exists ",
                       'status' => 300,
                       'otp'  => 0,
                    ], 200);

                  }
          return response()->json([
             'message'  =>'Client Data Insert',
             'status' => 200,
           ], 200);
        }
     

    public function updateClientData(Request $request){

          $objuser = UserModel::find($request->client_id);
          $objuser->user_name = $request->user_name;
          $objuser->user_email = $request->email;
          $objuser->user_password = $request->phone_number;
          $objuser->mobile     = $request->phone_number;
          $objuser->phone_code     = $request->country_code;
          $objuser->user_status = 2;
          $objuser->rm_id = $request->rm_id;
          $objuser->univercity_name = $request->univercity_name;
          $objuser->save();

          return response()->json([
             'message'  =>'User Data update',
             'status' => 200,
           ], 200);
        }
   
   public function updateOrderData(Request $request){
           
          $orderDetails = QueryModel::find($request->en_id);
          $orderDetails->payment_type = $request->payment_type;
          $orderDetails->en_service = $request->en_service;
          $orderDetails->en_subject = $request->en_subject;
          $orderDetails->module_name = $request->module_name;
          $orderDetails->deadline    = date('Y-m-d',strtotime($request->deadline));
          $orderDetails->word_count = $request->word_count;
          $orderDetails->assignment_type = $request->assignment_type;
          $orderDetails->currency_type = $request->currency_type;
          $orderDetails->client_amount = $request->client_amount;
          $orderDetails->inr_amount = $request->inr_amount;
          $orderDetails->aud_amount = $request->aud_amount;
          $orderDetails->en_query = $request->en_query;
          $orderDetails->en_id = $request->en_id;
          if(!empty($request->Screenshot)){
            $orderDetails->Screenshot =$this->uploadfile($request->file('Screenshot'),'payment_image');
          }
          $orderDetails->save();

          return response()->json([
             'message'  =>'Order Data update',
             'status' => 200,
           ], 200);
        }


     public function getClientData(Request $request){
         
         $userData = UserModel::find($request->client_id);
          return response()->json([
             'userData'  =>$userData,
             'status' => 200,
           ], 200);
        }

    public function deleteUserData(Request $request){
        
        $userData = Api_Model::find($request->user_id);
         if(empty($userData)){

          return response()->json([
             'message'  =>'no data found',
             'status' => 200,
           ], 200);
         }else{

           Api_Model::destroy($request->user_id);
            return response()->json([
              'message'  =>'user data deleted',
             'status' => 200,
           ], 200);
         }
       }
    

    public function uploadfile($file,$num=null){
         
          if(!empty($file)){
          $uploadPath = 'assets/uploads/enquiry/';
          $file->move(public_path().'/'.$uploadPath, $num.date('d_m_y_h_i_s').'.'.$file->getClientOriginalExtension());
          $filenamecreated = $num.date('d_m_y_h_i_s').'.'.$file->getClientOriginalExtension();
          return $filenamecreated;
         }
         return false;
     }

       public function addOrder(Request $req){ 

            $userData =  UserModel::where('user_email',$req->user_email)->where('rm_id',$req->rm_id)->first();
            $rmuserdata = \App\Model\Entry\RegisterMember_model::findOrFail($req->rm_id);
            $data = $this->getordernumber($req->rm_id,$req->order_type,$req->pre_order_id);

            $obj = new QueryModel;

            $obj->user_type          = 2;
            
            $obj->order_type         = $req->order_type;
            
            $obj->payment_type       = $req->payment_type;

            $obj->assignment_type    = $req->assignment_type;

            $obj->word_count         = $req->word_count;

            $obj->currency_type      = $req->currency_type;

            $obj->aud_amount         = $req->aud_amount;

            $obj->client_amount      = $req->client_amount;

            $obj->inr_amount         = $req->inr_amount;

            $obj->deadline           = date('Y-m-d',strtotime($req->deadline));

            $obj->en_first_name      = $userData->user_name;
            
            $obj->en_email           = $userData->user_email;

            $obj->phone_code         = $userData->phone_code;

            $obj->en_mobile          = $userData->mobile;

            $obj->en_service         = $req->en_service;

            $obj->en_subject         = $req->modal_en_subject;

            $obj->module_name        = $req->modal_en_module_name;

            $obj->univercity_name    = $req->univercity_name;

            $obj->en_query           = $req->modal_en_query;

            $obj->rm_id              = $req->rm_id;
           
            $obj->order_number       = $data['order_number'];
           
            $obj->tranxid            = $data['tranxid'];

            $obj->Screenshot         = $req->Screenshot;

            $obj->en_created_at      = date('Y-m-d h:i:s');

            $obj->Screenshot =$this->uploadfile($req->file('Screenshot'),'payment_image');
           
            if ($obj->save()) {
                $this->addDefaultWorkStatus($obj->tranxid);
               $servicedata = \App\Model\Entry\Service_model::findOrFail($req->en_service); 
               $mail_data = array();
               $mail_data['username'] ='Dear '.$obj->en_first_name;
               $mail_data['toemail'] =$obj->en_email;
               $mail_data['user_type'] =$obj->user_type;
               $mail_data['subject'] =$servicedata->services_name;
               $mail_data['tormemail'] =$rmuserdata->email;
               $mail_data['user_type'] =$obj->user_type;
               $mail_data['tormname'] =$rmuserdata->name;
               $mail_data['en_attachment'] =$obj->en_attachment;
               $mail_data['en_attachment_2'] =$obj->en_attachment_2;
               $mail_data['en_attachment_3'] =$obj->en_attachment_3;
               $mail_data['Screenshot'] =$obj->Screenshot;
               $mail_data['booking_user_name'] =$obj->en_first_name.' '.$obj->en_last_name;
               $mail_data['booking_user_email'] =$obj->en_email;
               $mail_data['booking_user_phone'] =$obj->phone_code.' '.$obj->en_mobile;
               $mail_data['password'] =$obj->en_mobile;
               $mail_data['booking_user_message'] =$obj->en_query;
               $mail_data['booking_user_subject'] =$obj->en_subject;
               $mail_data['order_number'] =$rmuserdata->rmid.'-'.$data['order_date'].'_'.sprintf("%02d", $obj->order_number);
               $mail_data['booking_user_paymnet'] =$mail_data['order_number'].' | '.$rmuserdata->symbol.$obj->en_first_name.'_'.$obj->en_subject.'_'.$obj->module_name;
               $mail_data['table_id'] =$obj->en_id;
               // $mail_data['user_mail_subject'] =$rmuserdata->symbol.$obj->en_first_name.'_'.$obj->en_subject.'_'.$obj->module_name;
                $mail_data['user_mail_subject'] =$rmuserdata->symbol.$obj->en_first_name.'_'.$obj->en_subject.'_'.$obj->module_name.'|'.$req->payment_type.' Confirm for';

               $this->sendmailrmuser($mail_data);
                 
               return response()->json([
                 'message'  =>'Order Add',
                 'status' => 200,
               ], 200);

              }
        }    
    
     public function addDefaultWorkStatus($tranxid=null){

      $oldWorkStatus = Work_status::where('first_enquary_id',$tranxid)->first();
      if(empty($oldWorkStatus)){
       $obj = new Work_status;
       $obj->first_enquary_id      = $tranxid;
       $obj->comment      = "Order Created";
       $obj->status      = 7;
       $obj->writer_id      = null;
       $obj->user_type      = 'BDM';
       $obj->created_at      = date('Y-m-d H:i:s');
       $obj->save();
     }
      return true;
  }


     public function sendmailrmuser($mail_data){ 
     
        Mail::send('emails/rmiduser',$mail_data, function($message)  use ($mail_data) {
        
         $message->to($mail_data['tormemail'], $mail_data['tormname'])->subject
            ($mail_data['booking_user_paymnet']);

          
          if(!empty($mail_data['en_attachment'])){
           $message->attach(asset('assets/uploads/enquiry/'.$mail_data['en_attachment']));
          }

          if(!empty($mail_data['en_attachment_2'])){
           $message->attach(asset('assets/uploads/enquiry/'.$mail_data['en_attachment_2']));
          }

         if(!empty($mail_data['en_attachment_3'])){
           $message->attach(asset('assets/uploads/enquiry/'.$mail_data['en_attachment_3']));
          }
         if(!empty($mail_data['Screenshot'])){
           $message->attach(asset('assets/uploads/enquiry/'.$mail_data['Screenshot']));
          }
         $message->cc("assignmenthelpandecounselling@outlook.com", "Ahecounselling");
         $message->from("info@ahecounselling.com","Ahecounselling");
      });
 
     return true;
   
   }

    public function getordernumber($rm_id,$order_type,$pre_order_id=null){
     
     if($order_type==1){
           $order_number = QueryModel::
              whereYear('en_created_at', Carbon::now()->year)
             ->where('rm_id',$rm_id)
             ->where('order_type','1')
             ->whereMonth('en_created_at', Carbon::now()->month)
             ->get()->count();
            $data['order_number'] =$order_number+1;
            $data['order_date']= date('d-m-y');
            $data['tranxid']= strtotime(date('m/d/Y h:i:s a',time()));
       }else{ 
          $per_order_data = QueryModel::find($pre_order_id);
          $data['order_number'] = $per_order_data->order_number;
          $data['order_date'] = date('d-m-y',strtotime($per_order_data->en_created_at));
           if($per_order_data->tranxid==null){
             $data['tranxid']= strtotime(date('m/d/Y h:i:s a',time()));
             $per_order_data->tranxid  =$data['tranxid'];
             $per_order_data->save();
           }else{
             $data['tranxid']=$per_order_data->tranxid;
            }
       }
       return $data;
  }

    public function searcholduser(Request $request){
     
    $validator = Validator::make($request->all(), [
         "rm_id"=>"required",                    
         "modal_en_email"=>"required",                    
        ]);
        
       if($validator->fails()){ 
        return $this->error_message($validator->errors());
        }

      $obj = QueryModel::where('en_email',trim($request->modal_en_email))->where('rm_id',trim($request->rm_id))->where('order_type','1')->with('rmuserdetails')->orderBy('en_id','asc')->get();
      $data =array();
     foreach ($obj as $key => $value) {
           
       $data[$key]['order_number'] =$value->rmuserdetails->rmid.'-'.date('d-m-y',strtotime($value->en_created_at)).'_'.sprintf("%02d", $value->order_number);
       $data[$key]['id'] =$value->en_id;
      }
    if(!empty($data)){

       return response()->json([
                          'status' => 200,
                          'userData' => $data,
                         ], 200);
      }else{
         
           return response()->json([
                       'message'  =>"No data found",
                       'status' => 300,
                       'otp'  => 0,
                    ], 200);
     }


  }
   
    public function searcholduserdetails(Request $request){

      $userDetails = QueryModel::find($request->pre_order_id);

      if(!empty($userDetails)){
            return response()->json([
                          'status' => 200,
                          'userDetails' => $userDetails,
                         ], 200);
       }else{
            return response()->json([
                       'message'  =>"No data found",
                       'status' => 300,
                       'otp'  => 0,
                    ], 200);
        }
     }

  public function getOrderData(Request $request){
         $userDetails = QueryModel::find($request->order_id);
         if(!empty($userDetails->Screenshot)){
           $Screenshot  =asset('assets/uploads/enquiry/'.$userDetails->Screenshot);
          }else{
            $Screenshot  =null;
         }
        return response()->json([
             'userData'  =>$userDetails,
             'Screenshot'  =>$Screenshot,
             'status' => 200,
           ], 200);
        }
public function trackstatus($tranxid){
         

          $workStatus   = Work_status::select('work_status.*','fl_form.af_name')->where('first_enquary_id',$tranxid)
           ->Leftjoin('fl_form','af_id','=','work_status.writer_id')
           ->get();
          $workDetails =  QueryModel::
              where('tranxid',$workStatus[0]->first_enquary_id)
              ->join('register_member','rm_id','=','register_member.id')->Leftjoin('entry_service','services_id','=','en_service')
             ->first();
         $order_number =$workDetails->rmid.'-'.date('d-m-y',$workDetails->tranxid).'_'.sprintf("%02d", $workDetails->order_number);
          $order_title =$order_number.' | '.$workDetails->symbol.$workDetails->en_first_name.'_'.$workDetails->en_subject.'_'.$workDetails->module_name;
           $result['order_title'] =$order_title;
           $result['workStatus'] =$workStatus;
          return response()->json([
             'userData'  =>$result  ,
             'status' => 200,
           ], 200);
        }    
 
  public function getOrderList($rm_id=null){
               
              $table = new QueryModel;
              $sqlObj = $table->getDefautl();
              if($rm_id!=null)
               $sqlObj = $sqlObj->where('rm_id',$rm_id);
               $sqlObj = $sqlObj->join('register_member','rm_id','=','register_member.id')->Leftjoin('entry_service','services_id','=','en_service')->orderBy('en_id','desc')->paginate(20); 

              $arrPaginateData = $sqlObj->toArray();

              $users = $arrPaginateData['data'];

              unset($arrPaginateData['data']); //remove data from paginate array
              $result =array();

              $result =  $arrPaginateData;
               $clientOrderStatus = \App\Library\Arraydb::$clientOrderStatus; 
                
              foreach ($users as $key => $value) {

                  $data =array();
                 $data['en_id']  =$value['en_id'];
                 $data['order_number']  =$value['rmid'].'-'.date('d-m-y',$value['tranxid']).'_'.sprintf("%02d", $value['order_number']);
                 $data['order_date']  =date('d-m-Y',strtotime($value['en_created_at']));
                 $data['client_name']  =trim($value['en_first_name'].' '.$value['en_last_name']);
                 $data['services_name']  =$value['services_name'];
                 $data['tranxid']  =$value['tranxid'];
                 $data['writer_id']  =$value['work_allocation'];
                 $data['payment_type']  =$value['payment_type'];

                    $lastStatus = Client_Work_status::where('client_transaction_id',$value['tranxid'])->orderBy('client_work_id','desc')->first();
                    if(!empty($lastStatus)){
                     $data['clients_last_status']  =  $clientOrderStatus[$lastStatus->status];
                    }else{
                      $data['clients_last_status']  =  '';
                    }

                 $data['deadline']  =date('d-F-Y',strtotime($value['deadline']));
                 if(!empty($value['Screenshot'])){
                
                  $data['Screenshot']  =asset('assets/uploads/enquiry/'.$value['Screenshot']);
                
                 }else{
                  
                  $data['Screenshot']  =null;

                 }
                $result['data'][] =$data;
  
              }
                   
              return response()->json([
                 'usersList'  =>$result,
                 'status' => 200,
               ], 200);
        }


   public function orderStatusApi(){
               
            $orderStatus = \App\Library\Arraydb::$orderStatus; 
            
            return response()->json([
                 'orderStatus'  =>$orderStatus,
                 'status' => 200,
               ], 200);
        }


      public function updateorderstatus(Request $request){
          
          $obj = new Work_status;
          $obj->first_enquary_id      = $request->tranxid;
          $obj->comment      = $request->comment;
          $obj->status      = $request->status;
          $obj->writer_id      = $request->writer_id;
          $obj->file_link      = $request->file_link;
          $obj->file_name      = $request->file_name;
          $obj->user_type      = 'BDM';
          $obj->created_at      = date('Y-m-d H:i:s');
          $obj->save();
          return response()->json([
             'message'  =>'order status updated',
             'status' => 200,
           ], 200);
        }

    public function checklogin(Request $request)
    {
              
          $credentials=['team_email'=>$request->input('email'),'team_password'=>$request->input('password'),'team_status'=>1];
             
          $response = login_model::CheckLoginCredentials($credentials);

          if(empty($response['status'])){
                return response()->json([
                 'message'  =>$response['message'],
                 'status' => 302,
               ], 200);
          }else{
             
            $row = $response['data'];
            login_model::where('team_id', $row->team_id)->update(array('token' => $request->input('token')));
            $rmUserData =  RegisterMember_model::where('email',$row->team_email)->first();
           if(empty($rmUserData)){
              $rm_id=$empid=$symbol=$rmid=0;

           }else{ 
                  $rm_id=$rmUserData->id;
                  $empid=$rmUserData->emid;
                  $rmid=$rmUserData->rmid;
                  $symbol=$rmUserData->symbol;
             }
        $arrayTable = new  \App\Library\Arraydb;
        
        $sessionSet =  [
              "rm_id" => $rm_id,
              "empid" => $empid,
              "symbol" => $symbol,
              "rm_code" => $rmid,
              "team_id" => $row->team_id,
              "team_name" =>$row->team_name,
              "team_email" =>$row->team_email,
              "team_password" => $row->team_password,
              "team_dob" => $row->team_dob,
              "team_mob" =>$row->team_mob,
              "team_office_mob" =>$row->team_office_mob,
              "team_address" =>$row->team_address,
              "team_pan" => $row->team_pan,
              "team_addhar" => $row->team_addhar,
              "team_type" =>$row->team_type,
              "type_name"=>$arrayTable::$loginUsers[$row->team_type],
              "team_status" =>$row->team_status];

             return response()->json([
                 'data'  =>$sessionSet,
                 'message'  =>'Login Successfully',
                 'status' => 200,
               ], 200);
            }

        
        }

   public function getDashboardData($rm_id=null){
          $totalCurrencyAmount = QueryModel::
             select(DB::raw('SUM(inr_amount) AS inr'),DB::raw('SUM(aud_amount) AS aud'))
           ->whereYear('en_created_at', Carbon::now()->year)
           ->whereMonth('en_created_at', Carbon::now()->month);
           if($rm_id!=null){
              $totalCurrencyAmount = $totalCurrencyAmount->where('rm_id',$rm_id);
              }
        $totalCurrencyAmount = $totalCurrencyAmount->where('currency_type','!=',null)->first();
        $totalCurrencyAmount->inr =number_format($totalCurrencyAmount->inr,2);
        $totalCurrencyAmount->aud =number_format($totalCurrencyAmount->aud,2);
        $weekTotalAmount = QueryModel::
                 select(DB::raw('SUM(inr_amount) AS inr'),DB::raw('SUM(aud_amount) AS aud'))
                 ->whereBetween('en_created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
         if($rm_id!=null){
            $weekTotalAmount= $weekTotalAmount->where('rm_id',$rm_id);
          }
        $weekTotalAmount     = $weekTotalAmount->where('currency_type','!=',null)->first();
        $weekTotalAmount->inr = number_format($weekTotalAmount->inr,2);
        $weekTotalAmount->aud = number_format($weekTotalAmount->aud,2);
        $userData['weekTotalAmount']    = $weekTotalAmount;
        $userData['mothTotalCurrencyAmount']    = $totalCurrencyAmount;
        if($rm_id==null){
          $userData['adminData']    = $this->getAdminData();
        }
        
         
         return response()->json([
                 'data'  =>$userData,
                 'status' => 200,
               ], 200);
    } 

     public function getAdminData(){

          $rmDataService =$rmData =array();
          $rmuser = RegisterMember_model::get();
          $rmData =array();
          $rmDataService =$rmCompairOrders = $rmCompairAud =array();
           $n =$j=0;
          foreach ($rmuser as $key => $data) {
              $total_order =0;
              $orderdataarray =$audDataArray =array();
             for ($i=4; $i <=date('m'); $i++) { 
                 $monthly_order = QueryModel::
                          whereYear('en_created_at', Carbon::now()->year)
                         ->whereMonth('en_created_at',$i)
                         ->where('rm_id',$data->id)
                         ->where('order_type',1)->count();

                   $orderdataarray[] =$monthly_order;
                   $name = $data->name;
               }

             for ($i=6; $i <=date('m'); $i++) { 
                 $aud_amount = QueryModel::
                          whereYear('en_created_at', Carbon::now()->year)
                         ->whereMonth('en_created_at',$i)
                         ->where('rm_id',$data->id)
                          ->sum('aud_amount');
                 $audDataArray[] =(float)(number_format($aud_amount,2, '.', ''));
                }
        $rmCompairOrders[$j]['data'] =$orderdataarray;
        $rmCompairOrders[$j]['name'] =$name;
        $rmCompairAud[$j]['data'] =$audDataArray;
        $rmCompairAud[$j]['name'] =$name;
        $j++;
              
              $total_order = QueryModel::
                whereYear('en_created_at', Carbon::now()->year)
              ->where('rm_id',$data->id)
              ->groupBy('order_number')
              ->whereMonth('en_created_at', Carbon::now()->month)
              ->get()->count();

              if($total_order==0){
                continue;
              }
            $rmData[$n]['name'] =$data->rmid;
            $rmData[$n]['y'] =$total_order;
            $rmData[$n]['drilldown'] =$data->rmid;
            $rmDataService[$n]['name'] =$data->rmid;
            $rmDataService[$n]['id'] =$data->rmid;
              $k=0;
            
            $servicedataCount = QueryModel::select('services_name', DB::raw('count(services_name) as services_count') )->
               whereYear('en_created_at', Carbon::now()->year)
              ->where('rm_id',$data->id)
              ->Leftjoin('entry_service','services_id','=','en_service')
              ->groupBy('en_service')
              ->whereMonth('en_created_at', Carbon::now()->month)
              ->get();

            foreach ($servicedataCount as $service_key => $services) {
              $rmDataService[$n]['data'][$k][] =$services->services_name;
               $rmDataService[$n]['data'][$k][] =$services->services_count;
               $k++;
             }
             
            $n++;
          }
              
          $currencyAmount = QueryModel::
                             join('currency','currency_type','=','currency_id')
                           ->select('currency.currency_code as name',DB::raw('SUM(client_amount) AS x'),DB::raw('SUM(inr_amount) AS y'),DB::raw('SUM(aud_amount) AS z'))
                           ->groupBy('currency_type')
                           ->whereYear('en_created_at', Carbon::now()->year)
                           ->whereMonth('en_created_at', Carbon::now()->month)
                           ->where('currency_type','!=',null)->get()->toarray();

          $adminData['currencyAmount']    = $currencyAmount;
          $adminData['rmData']           = $rmData;
          $adminData['rmCompairOrders']    = $rmCompairOrders;
          $adminData['rmDataService']    = $rmDataService;
          $adminData['rmCompairAud']    = $rmCompairAud;
          return $adminData;
    } 

  // write list data

     public function getWriteOrderList($wirter_id){
         
           if($wirter_id==0){
             $work_data = Work_status::paginate(20);
            }else{
            $work_data = Work_status::where('writer_id',$wirter_id)->paginate(20);
            }
              $arrPaginateData = $work_data->toArray();
              $users = $arrPaginateData['data'];
              unset($arrPaginateData['data']); //remove data from paginate array
              $result =array();
              $result =  $arrPaginateData;
              foreach ($users as $key => $value) {
                 $data =array();$data =$value;
                 $workDetails =  QueryModel::
                  where('tranxid',$value['first_enquary_id'])
                  ->join('register_member','rm_id','=','register_member.id')->Leftjoin('entry_service','services_id','=','en_service')
                 ->first();
                   if(!empty($workDetails)){
                      $order_number =$workDetails->rmid.'-'.date('d-m-y',$workDetails->tranxid).'_'.sprintf("%02d", $workDetails->order_number);
                      $data['order_title'] =$order_number.' | '.$workDetails->symbol.$workDetails->en_first_name.'_'.$workDetails->en_subject.'_'.$workDetails->module_name;
                    }
                   $result['data'][] =$data;
                 }
                     
           return response()->json([
                 'data'  =>$result,
                 'message'  =>'Success',
                 'status' => 200,
               ], 200);
        
      }
   public function uploadsWriteDoc(Request $request){
            
         
           $obj = writer::find($request->writer_id);
           if(!empty($request->file('address_proof_id'))){
              $file =  $request->file('address_proof_id');
              $address_proof_id_name = $obj->af_name.'-id-'.time().'.'.$file->getClientOriginalExtension();
              $uploadPath = 'assets/uploads/flregistration/';
              $file->move(public_path().'/'.$uploadPath, $address_proof_id_name);
              $obj->af_file          = $address_proof_id_name;
            } 
            if(!empty($request->file('pan_number_doc'))){
              $file =  $request->file('pan_number_doc');
              $pan_number_doc_name = $obj->af_name.'-pan-'.time().'.'.$file->getClientOriginalExtension();
              $uploadPath = 'assets/uploads/flregistration/';
              $file->move(public_path().'/'.$uploadPath, $pan_number_doc_name);
              $obj->doc_2            = $pan_number_doc_name;
            } 
           $obj->save();

             return response()->json([
                 'data'  =>writer::find($request->writer_id),
                 'message'  =>'FL Registration Successfully submited',
                 'status' => 200,
               ], 200);
     }

     public function getWriteData($writer_id){
            return response()->json([
                 'data'  =>writer::find($writer_id),
                 'message'  =>'FL Registration Successfully submited',
                 'status' => 200,
               ], 200);
    }
   
     public function createWrite(Request $request){
               
                 $obj = new writer;
                 $obj->af_name          = $request->name;
                 $obj->af_email         = $request->email;
                 $obj->af_address       = $request->address;
                 $obj->country_code     = $request->country_code;
                 $obj->af_mobile        = $request->mobile;
                 $obj->fl_alternate_number      = $request->alternate_number;
                 $obj->bank_name        = $request->bank_name;
                 $obj->bank_no          = $request->account_number;
                 $obj->bank_ifsc        = $request->ifsc_code;
                 $obj->bank_branch      = $request->branch_name;
                 $obj->aadhar_number    = $request->aadhar_card_number;
                 $obj->pan_number       = $request->pan_card_number;
                 $obj->save();
                
                 return response()->json([
                   'data'  =>$obj,
                   'message'  =>'FL Registration Successfully submited',
                   'status' => 200,
                 ], 200);

            } 
     
       public function updateWrite(Request $request){
               
                 $obj = writer::find($request->id);
                 $obj->af_name          = $request->name;
                 $obj->af_email         = $request->email;
                 $obj->af_address       = $request->address;
                 $obj->country_code     = $request->country_code;
                 $obj->af_mobile        = $request->mobile;
                 $obj->fl_alternate_number      = $request->alternate_number;
                 $obj->bank_name        = $request->bank_name;
                 $obj->bank_no          = $request->account_number;
                 $obj->bank_ifsc        = $request->ifsc_code;
                 $obj->bank_branch      = $request->branch_name;
                 $obj->aadhar_number    = $request->aadhar_card_number;
                 $obj->pan_number       = $request->pan_card_number;
                 $obj->save();
                
                 return response()->json([
                   'data'  =>$obj,
                   'message'  =>'data Update Successfully',
                   'status' => 200,
                 ], 200);   
             }
    
  }  
