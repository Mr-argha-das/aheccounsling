<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Model\Website\QueryModel as QueryModel;
use \App\Model\UserModel as UserModel;
use \App\Model\Entry\Client_Work_status;
use \App\Model\Entry\User_contact;
use Mail;
use File;
use Storage;
 class UserApiController extends Controller{

   public function __construct(){
      date_default_timezone_set("Asia/Calcutta");
    } 
   
   function google_drive_file(Request $request){

        if(empty($request->file('drive_file'))){
            return response()->json([
                   'message'  =>'file Not found',
                   'status' => 302,
                 ], 200);
            
          }else{
           $file_name =uniqid("ahec-",15).'-'.$request->file('drive_file')->getClientOriginalName();
           $contents = file_get_contents($request->file('drive_file')->getRealPath());
            Storage::disk('google')->put($file_name,$contents);

              return response()->json([
                       'drive_link'  =>Storage::disk('google')->url($file_name),
                       'status' => 200,
                     ], 200);
               }
         }
   function login(Request $request){
      $UserList = UserModel::where('user_email',$request->email)
                            ->where('user_password',$request->password)
                            ->get()->last();
               if (!empty($UserList)) {
                     UserModel::where('user_email',$request->email)->update(array('_token_id' => $request->_token_id));
                     $UserList->_token_id=$request->_token_id;
                    return response()->json([
                       'usersList'  =>$UserList,
                       'status' => 200,
                     ], 200);
               }else{
                  return response()->json([
                     'message'  =>'Login Credential not match',
                     'status' => 302,
                   ], 200);
               }
       }

   function contantjsone(Request $request){ 

      $json_file = $request->json_file;
      $obj = User_contact::where('client_id',$request->client_id)->where('rm_id',$request->rm_id)->first();
      if(empty($obj)){
       $obj = new User_contact;
      }
      $obj->client_id =$request->client_id;
      $obj->rm_id =$request->rm_id;
      $obj->json_data =$json_file;
      $obj->save();
       return response()->json([
                   'message'  =>'data successfully save',
                   'data'  =>$obj,
                   'status' => 200,
                 ], 200);
     
      // User_contact
   }
   function forgetPassword(Request $request){
   	     if(isset($request->email)){
         
          $UserList = UserModel::where('user_email',$request->email)
                            ->get()->last();
          }else if ($request->mobile) {
   	     	 $UserList = UserModel::where('mobile',$request->mobile)
                            ->get()->last();
   	      }
   	 
           if (!empty($UserList)) {
                    
            $mail_data['subjet'] ="Password Reset";
    				$mail_data['username'] =$UserList->user_name;
    				$mail_data['toemail'] =$UserList->user_email;
    				$mail_data['otp'] =rand(10000,99999);
    				UserModel::where('user_email',$UserList->user_email)->update(array('otp' => $mail_data['otp']));
                 	Mail::send('emails/forgetpassword',$mail_data, function($message)  use ($mail_data) {
    				$message->to($mail_data['toemail'], $mail_data['username'])->subject
    				($mail_data['subjet']);
    				$message->from("info@ahecounselling.com","Ahecounselling");
    				});
		      
		          if(isset($request->email)){
		            $UserList = UserModel::where('user_email',$request->email)
		                            ->get()->last();
		           }else if ($request->mobile) {
		   	         $UserList = UserModel::where('mobile',$request->mobile)
		                            ->get()->last();
		   	      }
					  
            return response()->json([
                   'message'  =>'Otp Send',
                   'data'  =>$UserList,
                   'status' => 200,
                 ], 200);
           }else{
              return response()->json([
                 'message'  =>'error',
                 'status' => 302,
               ], 200);
           }
       }
   function updatePassword(Request $request){
            
           $obj = UserModel::find($request->user_id);
           if(empty($obj)){
              return response()->json([
                     'message'  =>'no user find',
                     'status' => 301,
                   ], 200);
            }else{
             
             $obj->user_password=$request->newPassword;
             $obj->chnage_password_count=$obj->chnage_password_count+1;
             $obj->save();

              return response()->json([
                 'message'  =>'Password Update',
                 'status' => 200,
               ], 200);
           

            }
	      return response()->json([
	         'message'  =>'file link save',
	          'status' => 200,
	        ], 200);
	}  
  function updateProfileData(Request $request){
           $obj = UserModel::find($request->user_id);
           if(empty($obj)){
              return response()->json([
                     'message'  =>'no user find',
                     'status' => 301,
                   ], 200);
            }else{

             $file_name='';
            if(!empty($request->profile)){
                $file = $request->file('profile');
              if(!empty($file)){
                 $uploadPath = 'assets/userProfile/';
                 $file_name = $request->user_id.strtotime(date('d_m_y_h_i_s')).'.'.$file->getClientOriginalExtension();
                 $file->move(public_path().'/'.$uploadPath,$file_name);
                 $file_name=$uploadPath.$file_name;
                } 
             }
             
             $obj->user_name=$request->user_name;
             $obj->univercity_name=$request->univercity_name;
             if(!empty($file_name)){
               $obj->profile=$file_name;
              }
             $obj->save();

              return response()->json([
                 'message'  =>'Profie Update',
                 'status' => 200,
               ], 200);
           

            }
        return response()->json([
           'message'  =>'file link save',
            'status' => 200,
          ], 200);
  } 
   
      function checkUserloginByPhone(Request $request){
         
          $UserList = UserModel::where('mobile',$request->phone_number)
                            ->where('user_password',$request->password)
                            ->get()->last();
          if (!empty($UserList)) {
                    UserModel::where('user_id',$UserList->user_id)->update(array('_token_id' => $request->_token_id));
                     $UserList->_token_id=$request->_token_id;
                    return response()->json([
                       'usersList'  =>$UserList,
                       'status' => 200,
                     ], 200);
               }else{
                  return response()->json([
                     'message'  =>'Login Credential not match',
                     'status' => 302,
                   ], 200);
               }
       }
   
    function getClientOrderList(Request $request){
                
                 $orderList =  QueryModel::select('enquiry_user.*','register_member.name as rmName','register_member.symbol','register_member.rmid','entry_service.services_name')
                    ->where('en_email',$request->login_email)
                    ->join('register_member','rm_id','=','register_member.id')->Leftjoin('entry_service','services_id','=','en_service')
                    ->get();
                   
                 foreach ($orderList as $key => $workDetails) {
                         $order_number =$workDetails->rmid.'-'.date('d-m-y',$workDetails->tranxid).'_'.sprintf("%02d", $workDetails->order_number);
                         $data['order_title'] =$order_number.' | '.$workDetails->symbol.$workDetails->en_first_name.'_'.$workDetails->en_subject.'_'.$workDetails->module_name;
                         $orderList[$key]->order_thread=$order_number;
                     }

                  return response()->json([
                       'orderList'  =>$orderList,
                       'status' => 200,
                     ], 200);
        }

    function getClientWorkFiles($tran_id,Request $request){
          
      $files_list = Client_Work_status::select('enquiry_user.*','client_work_status.file_link','client_work_status.created_at as file_update_date','client_work_status.file_name','client_work_status.status as c_status','register_member.rmid')->join('enquiry_user','client_work_status.client_transaction_id','=','enquiry_user.tranxid')->join('register_member','enquiry_user.rm_id','=','register_member.id')->where('client_work_status.client_transaction_id',$tran_id)->get();

         return response()->json([
                     'files_list'  =>$files_list,
                     'status' => 200,
                   ], 200);
    }

    function getClientStatusList(Request $request){

       $clientOrderStatus = \App\Library\Arraydb::$clientOrderStatus; 
            
        return response()->json([
                   'clientOrderStatus'  =>$clientOrderStatus,
                   'status' => 200,
                 ], 200);
    }
     function uploadClientWorkFiles(Request $request){
            
        
           $obj = new Client_Work_status;
           $obj->client_transaction_id=$request->transaction_id;
           $obj->status=$request->status; 
           $obj->file_link=$request->file_link; 
           $obj->file_name=$request->file_name; 
           $obj->save();
            
           return response()->json([
                     'message'  =>'file link save',
                     'status' => 200,
                   ], 200);
    }

     function changePassword(Request $request){
            
           
           $obj = UserModel::find($request->user_id);
           if(empty($obj)){
              return response()->json([
                     'message'  =>'no user find',
                     'status' => 301,
                   ], 200);
            }else{

               if($obj->user_password==$request->currentPassword){
                 $obj->user_password=$request->newPassword;
                 $obj->chnage_password_count=$obj->chnage_password_count+1;
                 $obj->save();

                  return response()->json([
                     'message'  =>'Password Update',
                     'status' => 200,
                   ], 200);
               }else{
                     return response()->json([
                     'message'  =>'Current password to new not match !',
                     'status' => 301,
                   ], 200);

               }

            }
	      return response()->json([
	         'message'  =>'file link save',
	          'status' => 200,
	        ], 200);
	} 


 
  }  
