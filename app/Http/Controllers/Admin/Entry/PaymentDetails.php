<?php

namespace App\Http\Controllers\Admin\Entry;
use Illuminate\Http\Request;
use Validator;
use Mail;
use App\Model\PaymentDetails_model as WorkmModel;
use \App\Model\UserModel as UserModel;
use \App\Model\Login_model as loginModel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use File;



class PaymentDetails  extends Controller{


  public $title = 'Payment Details List';
  
  public $viewFolder = "entry/payment";

  public $viewData = [];

  public $model = [];

  public $UserData = [];

    public $storePath = '';

  public function __construct(Request $request)

  {

    parent::__construct();

    // Add a few messages
    $this->storePath  =  'admin/' . $this->viewFolder;

    $this->viewpPath = $this->viewFolder . '/';

    $this->viewFolder = 'admin/' . $this->viewFolder . '/';

    $this->viewData['viewpPath'] = $this->viewpPath;

    $this->viewData['viewFolder'] = $this->viewFolder;

    $this->arraydb = new \App\Library\Arraydb;

    $this->WorkmModel = new WorkmModel;

  }



  public function index(Request $request){


    $userData = session()->get('usersession');
    
    if(empty($userData)) {
        return redirect()->route('wpanelLogin');
     }
    
    $table = new WorkmModel;
   
    $this->viewData['title'] = $this->title;
   
     $sqlObj = $table->getDefautl()->select('payment_details.*','entry_service.services_name','payment_key.symbol','register_member.name as rm_user')->leftJoin('entry_service','entry_service.services_id','=','payment_details.productinfo')->leftJoin('payment_key','payment_key.id','=','payment_details.payment_key_type')->leftJoin('register_member','register_member.id','=','payment_details.rm_id')->orderBy('id','desc'); 
     $data = $this->common->setPagination($sqlObj);

    
     $this->viewData['pagination'] = $data['pagination'];

     $this->viewData['records'] = $data['records'];
     
      

     view()->share($this->viewData);

     return view($this->viewFolder . 'index');

  }

   public function create(){

    $userData = session()->get('usersession');

    if (empty($userData)) {

      redirect('admin/user/login');

    }
   
   if($userData['rm_id']==0){
     
     $this->viewData['client_list']  = UserModel::get(); 
     
     }else{

    $this->viewData['client_list'] = UserModel::where('rm_id',$userData['rm_id'])->orderBy('user_id','desc')->get(); 

     }

    $table = new WorkmModel;

    $sqlObj = $table->orderBy($table->getKeyName());

    $this->viewData['title'] = 'Add ' . $this->title;

    $this->viewData['formAction'] = $this->storePath;

    $this->viewData['rm_id_selected'] = $userData['rm_id'];

    view()->share($this->viewData);

    return view($this->viewFolder . 'create');

  }
  public function getordernumber($rm_id,$order_type,$pre_order_id=null){
     
    if($order_type==1){
           $order_number = WorkmModel::
             whereYear('en_created_at', Carbon::now()->year)
            ->where('rm_id',$rm_id)
            ->groupBy('order_number')
            ->whereMonth('en_created_at', Carbon::now()->month)
            ->get()->count();
            $data['order_number'] =$order_number+1;
            $data['order_date']= date('d-m-y');
       }else{
           
            $per_order_data = WorkmModel::find($pre_order_id);
            $data['order_number'] = $per_order_data->order_number;
            $data['order_date'] = date('d-m-y',strtotime($per_order_data->en_created_at));
       }
       return $data;
  }

   
  public function store(Request $req){
     
    $userData =  UserModel::where('user_email',$req->user_email)->first();
    $rmuserdata = \App\Model\Entry\RegisterMember_model::findOrFail($req->rm_id);
    $data = $this->getordernumber($req->rm_id,$req->order_type,$req->pre_order_id);
    
    $obj = new WorkmModel;

    $obj->user_type      = 2;
    
    $obj->order_type      = $req->order_type;
    
    $obj->payment_type      = $req->payment_type;

    $obj->en_first_name = $userData->user_name;
    
    $obj->en_email      = $userData->user_email;

    $obj->phone_code     = $userData->phone_code;

    $obj->en_mobile     = $userData->mobile;

    $obj->en_service    = $req->en_service;

    $obj->en_subject    = $req->modal_en_subject;

    $obj->module_name      = $req->modal_en_module_name;

    $obj->univercity_name      = $req->univercity_name;

    $obj->en_query      = $req->modal_en_query;

    $obj->rm_id      = $req->rm_id;
   
    $obj->order_number      = $data['order_number'];

    $obj->Screenshot = $req->Screenshot;

    if ($obj->save()) {

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
         
      return $this->restModel->successOut('Successfully Saved');

      
     }

    return $this->restModel->successOut('Successfully Saved');

  }

 public function sendmailrmuser($mail_data){ 
     
     
     Mail::send('emails/userreview',$mail_data, function($message)  use ($mail_data) {
           $message->to($mail_data['toemail'], $mail_data['username'])->subject
              ($mail_data['user_mail_subject']);
           $message->from("info@ahecounselling.com","Ahecounselling");
       });

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


    public function delete($urlSlug){

       
      $workModel  = new WorkmModel;

       $find = $workModel->find($urlSlug);


      if(!empty($find->en_attachment)){


           $uploadPath = 'assets/uploads/enquiry/';
           $filepath = public_path().'/'.$uploadPath.'/'.$find->en_attachment;
           File::delete($filepath);
       } 
       if(!empty($find->en_attachment_2)){


           $uploadPath = 'assets/uploads/enquiry/';
           $filepath = public_path().'/'.$uploadPath.'/'.$find->en_attachment_2;
           File::delete($filepath);
       }

      if(!empty($find->en_attachment_3)){


           $uploadPath = 'assets/uploads/enquiry/';
           $filepath = public_path().'/'.$uploadPath.'/'.$find->en_attachment_3;
           File::delete($filepath);
       }

       $workModel->destroy($urlSlug);

      return redirect($this->viewFolder);

    }

  

}

