<?php

namespace App\Http\Controllers\Admin\Entry;
use Illuminate\Http\Request;
use Validator;
use Mail;
use \App\Model\Website\QueryModel as WorkmModel;
use \App\Model\Entry\Work_status;

use \App\Model\UserModel as UserModel;
use \App\Model\Login_model as loginModel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use File;



class MyClientOrdersController  extends Controller{



  public $title = 'My Order List';

  public $viewFolder = "entry/orders";

  public $viewData = [];

  public $model = [];

  public $UserData = [];

  public function __construct(Request $request)

  {

    parent::__construct();

    // Add a few messages
      date_default_timezone_set("Asia/Calcutta");
    $this->viewpPath = $this->viewFolder . '/';

    $this->viewFolder = 'admin/' . $this->viewFolder . '/';

    $this->viewData['viewpPath'] = $this->viewpPath;

    $this->viewData['viewFolder'] = $this->viewFolder;

    // $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI; //tableToArray('party_id','party_name','sy_master_party','select');
    $this->viewData['orderStatus'] = \App\Library\Arraydb::$orderStatus; //tableToArray('party_id','party_name','sy_master_party','select');

    $this->arraydb = new \App\Library\Arraydb;

    $this->WorkmModel = new WorkmModel;

    $this->viewData['timedate'] = $this->timedate;

  }



  public function index(Request $request) {
    
    $userData = session()->get('usersession');
     if (empty($userData)) {
      return redirect()->route('wpanelLogin');
     }
    if($request->start_date!=null && $request->end_date!=null){
       $request->rm_id = $userData['rm_id'];
       $this->excelfile($request);
     }


    $table = new WorkmModel;
    $this->viewData['title'] = $this->title;
    $sqlObj = $table->getDefautl()->where('rm_id',$userData['rm_id'])->join('register_member','rm_id','=','register_member.id')->Leftjoin('entry_service','services_id','=','en_service')->orderBy('en_id','desc'); 
    $data = $this->common->setPagination($sqlObj);
    $this->viewData['pagination'] = $data['pagination'];

    $this->viewData['records'] = $data['records'];
    $this->viewData['rm_id'] = $userData['rm_id'];
     

    view()->share($this->viewData);

    return view($this->viewFolder . 'myclientsorder');

  }
   public function excelfile($request=null){
        $rm_id =$request->rm_id;
        if($rm_id==null){
           $filename = "A2GPVTLTD" . date('d-F-M') . ".csv"; 
         }else{
           $rmuserdata = \App\Model\Entry\RegisterMember_model::findOrFail($rm_id);
           $filename = $rmuserdata->name.'-'. date('d-F-Y') . ".csv"; 
         }
      
         $csvData = WorkmModel::select('enquiry_user.*','entry_service.services_name','register_member.name as bdm','register_member.rmid as rmid','register_member.symbol','currency.currency_name')
                ->join('register_member','rm_id','=','register_member.id')
                ->join('currency','currency.currency_id','=','enquiry_user.currency_type')
                ->Leftjoin('entry_service','services_id','=','en_service')
                ->orderBy('en_id','asc');
                // ->where('work_allocation','!=','0');
        if($request->rm_id!=null ){
          $csvData = $csvData->where('rm_id', '=',$request->rm_id);
         }
        if($request->start_date!=null && $request->end_date!=null){
               $end_date = date('Y-m-d', strtotime("+1 day", strtotime($request->end_date)));
               $start_date = date('Y-m-d', strtotime($request->start_date));
               $csvData = $csvData->where('en_created_at', '<=', $end_date)
                         ->where('en_created_at', '>=', $start_date);

                       }

         $csvData = $csvData->get();
      
         if(count($csvData)==0){
            return false;
          }

      foreach ($csvData as $key => $value) {
               
           $workStatus    = Work_status::select('work_status.*','fl_form.af_name')
                          ->where('first_enquary_id',$value->tranxid)
                          ->Leftjoin('fl_form','af_id','=','work_status.writer_id')
                          ->orderBy('work_status.work_status_id','desc')
                          ->get()
                          ->unique('writer_id');
            
            $allWriteName ='';
             foreach ($workStatus as $key => $writeName) {
               $allWriteName  .=$writeName->af_name."/";
            }
                    
            $csvHeader[$value->rm_id.'_'.$value->order_number]['Month'] =  date('F',strtotime($value->en_created_at));
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Sr_No']   =  '';
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Creation_Date'] =  date('m/d/Y',strtotime($value->en_created_at));
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Deadline'] =  date('m/d/Y',strtotime($value->deadline));
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Order_Id'] =  $value->rmid.'-'.date('d-m-Y',strtotime($value->en_created_at)).'_'.sprintf("%02d", $value->order_number);
        	   $order_number =$value->rmid.'-'.date('d-m-y',strtotime($value->en_created_at)).'_'.sprintf("%02d", $value->order_number);

        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Subject_Title'] =$order_number.' | '.$value->symbol.$value->en_first_name.'_'.$value->en_subject.'_'.$value->module_name;
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['BDM_Name'] =  $value->bdm;
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Client_Name'] =  $value->en_first_name.' '.$value->en_last_name;
        	  if(!isset($csvHeader[$value->rm_id.'_'.$value->order_number]['Word_Count'])){
                $csvHeader[$value->rm_id.'_'.$value->order_number]['Word_Count'] =0;
                }
            $csvHeader[$value->rm_id.'_'.$value->order_number]['Word_Count']  += (is_numeric($value->word_count)) ? $value->word_count : 0;
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Type']   =  $value->assignment_type;
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Topic']   =  '';
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Stream']   =  $value->services_name;

             if(!empty($workStatus[0]->comment)){

            $csvHeader[$value->rm_id.'_'.$value->order_number]['BDE_Remarks']   =  $workStatus[0]->comment;
            $csvHeader[$value->rm_id.'_'.$value->order_number]['Order_Status']   =  $this->viewData['orderStatus'][$workStatus[0]->status];
           }else{
             $csvHeader[$value->rm_id.'_'.$value->order_number]['BDE_Remarks']   ='';
             $csvHeader[$value->rm_id.'_'.$value->order_number]['Order_Status']   = '';
            }
            
        	  // $csvHeader[$value->rm_id.'_'.$value->order_number]['BDE_Remarks']   =  $workStatus[0]->comment;
        	  // $csvHeader[$value->rm_id.'_'.$value->order_number]['Order_Status']   =  $this->viewData['orderStatus'][$workStatus[0]->status];
        	  // $csvHeader[$value->rm_id.'_'.$value->order_number]['Work_Done_By']   =  $allWriteName;
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Notes']   =  $value->en_query;
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Currency']   =  $value->currency_name;
        	   if(!isset($csvHeader[$value->rm_id.'_'.$value->order_number]['Amount'])){
                $csvHeader[$value->rm_id.'_'.$value->order_number]['Amount'] =0;
				        $csvHeader[$value->rm_id.'_'.$value->order_number]['INR_Conversion']=0;
                $csvHeader[$value->rm_id.'_'.$value->order_number]['AUD_Conversion']=0;
               }
            $csvHeader[$value->rm_id.'_'.$value->order_number]['Amount']   += (is_numeric($value->client_amount)) ? $value->client_amount : 0;
            $csvHeader[$value->rm_id.'_'.$value->order_number]['INR_Conversion']   += (is_numeric($value->inr_amount)) ? $value->inr_amount : 0;
            $csvHeader[$value->rm_id.'_'.$value->order_number]['AUD_Conversion']   +=  (is_numeric($value->aud_amount)) ? $value->aud_amount : 0;
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['Installment'][]    =  $value->inr_amount;
        	  $csvHeader[$value->rm_id.'_'.$value->order_number]['payment_type']   =  $value->payment_type;
       } 
        
    $delimiter = ","; 
    ob_clean();
    $f = fopen('php://memory', 'w+');
    $fields = array('Month','Sr. No.','Creation Date','Deadline','Order Id','Subject Title','BDM Name','Client Name','Word Count','Type       ','Topic      ','Stream     ','BDE Remarks','Order Status ','Notes','Currency','Amount  ','INR Conversion','AUD Conversion','Part/Full/No Payment','Installment 1','Installment 2','Installment 3','Installment 4','Installment 5'); 
    fputcsv($f, $fields, $delimiter); 
    foreach ($csvHeader as $key => $value) {
          
          // return $value;
    	$value['Installment 5'] =$value['Installment 4'] =$value['Installment 3']=$value['Installment 2']=$value['Installment 1']= null;

    	if(isset($value['Installment'][0])){
    	 $value['Installment 1'] = $value['Installment'][0]; 
     	}
     	 if(isset($value['Installment'][1])){
     		$value['Installment 2'] = $value['Installment'][1];

     	}
     	 if(isset($value['Installment'][2])){
     		$value['Installment 3'] = $value['Installment'][2];

     	}
     	 if(isset($value['Installment'][3])){
     		$value['Installment 4'] = $value['Installment'][3];

     	}
     	 if(isset($value['Installment'][4])){
     		$value['Installment 5'] = $value['Installment'][4];

     	}

     	 unset($value['Installment']);
         $lineData = $value;
    	 fputcsv($f, $lineData, $delimiter); 
     }
     
    fseek($f, 0); 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
    fpassthru($f); 
      exit;                  
     return $csvHeader;exit;
   }

   public function trackstatus($tranxid) {

     $userData = session()->get('usersession');
     if (empty($userData)) {
     return redirect()->route('wpanelLogin');
     }
     $workStatus   = Work_status::select('work_status.*','fl_form.af_name')->where('first_enquary_id',$tranxid)
                     ->Leftjoin('fl_form','af_id','=','work_status.writer_id')
                     ->get();
      $workDetails =  WorkmModel::
                        where('tranxid',$workStatus[0]->first_enquary_id)
                        ->join('register_member','rm_id','=','register_member.id')->Leftjoin('entry_service','services_id','=','en_service')
                       ->first();
                     // return $workDetails;
       $order_number =$workDetails->rmid.'-'.date('d-m-y',$workDetails->tranxid).'_'.sprintf("%02d", $workDetails->order_number);
       $order_title =$order_number.' | '.$workDetails->symbol.$workDetails->en_first_name.'_'.$workDetails->en_subject.'_'.$workDetails->module_name;
                      

    $this->viewData['title'] = $this->title;
    $this->viewData['workStatus'] = $workStatus;
    $this->viewData['workDetails'] = $workDetails;
    $this->viewData['rm_id'] = $userData['rm_id'];
    $this->viewData['order_title'] = $order_title;
    view()->share($this->viewData);

    return view($this->viewFolder . 'trackstatus');

  }
   
   public function edit($id){

   	 $userData = session()->get('usersession');
    $this->viewData['rm_id'] = $userData['rm_id'];
     

      $this->viewData['formAction'] = "admin/entry/myclientorders/" . $id;
       $tranxid = WorkmModel::find($id)->tranxid;
       $oldstatus = Work_status::where('first_enquary_id',$tranxid)->orderBy('work_status_id','desc')->first();
       if(!empty($oldstatus)){
       $this->viewData['writer_id'] = $oldstatus->writer_id;
       }else{
        $this->viewData['writer_id'] =0;
       }

      view()->share($this->viewData);
      return view($this->viewFolder . 'statusUpdate');

  }
  
   public function update(Request $req, $id){
       
        
       $userData = session()->get('usersession');
       $data = WorkmModel::find($id);
       $data->work_allocation =$req->writer_id;
       $data->save();
              
       $obj = new Work_status;
       $obj->first_enquary_id      = $data->tranxid;
       $obj->comment      = $req->comment;
       $obj->status      = $req->status;
       $obj->writer_id      = $req->writer_id;
       if($userData['rm_id']==0){
        $obj->user_type      = "Admin";
       }else{
         $obj->user_type      = 'BDM';
       }

       $obj->created_at      = date('Y-m-d H:i:s');

       $obj->save();
      return $this->restModel->successOut('Order Status update  successfully');
  }
   public function create(){

    $userData = session()->get('usersession');
    if (empty($userData)) {
     return redirect()->route('wpanelLogin');
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
    view()->share($this->viewData);
    return view($this->viewFolder . 'create');
 }
 
  public function getordernumber($rm_id,$order_type,$pre_order_id=null){
     
    if($order_type==1){
           $order_number = WorkmModel::
             whereYear('en_created_at', Carbon::now()->year)
            ->where('rm_id',$rm_id)
            ->where('order_type','1')
            ->groupBy('order_number')
            ->whereMonth('en_created_at', Carbon::now()->month)
            ->get()->count();
            $data['order_number'] =$order_number+1;
            $data['order_date']= date('d-m-y');
            $data['tranxid']= strtotime(date('m/d/Y h:i:s a',time()));
       }else{
           
            $per_order_data = WorkmModel::find($pre_order_id);
            $data['order_number'] = $per_order_data->order_number;
            $data['order_date'] = date('d-m-y',strtotime($per_order_data->en_created_at));
            $data['tranxid']=$per_order_data->tranxid;
       }
       return $data;
  }

   
  public function store(Request $req){
      
    $rmSessionId = session()->get('usersession')['rm_id'];
    $userData =  UserModel::where('user_email',$req->user_email)->where('rm_id',$rmSessionId)->first();
    $rmuserdata = \App\Model\Entry\RegisterMember_model::findOrFail($req->rm_id);
    $data = $this->getordernumber($req->rm_id,$req->order_type,$req->pre_order_id);
      
    
    $obj = new WorkmModel;

    $obj->user_type      = 2;
    
    $obj->order_type      = $req->order_type;

    $obj->transaction_id   = $req->transaction_id;
    
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

    $obj->tranxid      = $data['tranxid'];

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

       // $this->sendmailrmuser($mail_data);
         
      return $this->restModel->successOut('Successfully Saved');

      
     }

    return $this->restModel->successOut('Successfully Saved');

  }

 public function sendmailrmuser($mail_data){ 
     
     
     // Mail::send('emails/userreview',$mail_data, function($message)  use ($mail_data) {
     //       $message->to($mail_data['toemail'], $mail_data['username'])->subject
     //          ($mail_data['user_mail_subject']);
     //       $message->from("info@ahecounselling.com","Ahecounselling");
     //   });

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

    public function copyCsvData(){
              
        $userData = session()->get('usersession');
        if (empty($userData)) {
          return redirect()->route('wpanelLogin');
         }
        $table = new WorkmModel;
        $this->viewData['title'] = $this->title;
        $data = $table->getDefautl()->where('rm_id',$userData['rm_id'])
        ->join('currency','currency_type','=','currency.currency_id')
        ->join('register_member','rm_id','=','register_member.id')
        ->Leftjoin('entry_service','services_id','=','en_service')->orderBy('en_id','desc')->limit(5)->get(); 
        $this->viewData['records'] = $data;
        $this->viewData['rm_id'] = $userData['rm_id'];
        view()->share($this->viewData);
        return view($this->viewFolder . 'copyCsvData');

     }

}

