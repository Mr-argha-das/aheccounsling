<?php

namespace App\Http\Controllers\Admin\Entry;
use Illuminate\Http\Request;
 
use Mail;
use Illuminate\Support\Facades\Validator;
use \App\Model\Website\QueryModel as orderModel;
use \App\Model\Entry\Client_Work_status;

use \App\Model\UserModel as UserModel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use File;
use Storage;



class ClientOrderStatusController  extends Controller{

 public function __construct(Request $request){

    parent::__construct();

    date_default_timezone_set("Asia/Calcutta");
     
     //tableToArray('party_id','party_name','sy_master_party','select');
   
  }

   public function index($tran_id) {
         

      $userData = session()->get('usersession');
      if (empty($userData)) {
       return redirect()->route('wpanelLogin');
      }
      $clientOrderStatus = $this->arraydb::$clientOrderStatus;
      $files_list = Client_Work_status::select('enquiry_user.*','client_work_status.file_link','client_work_status.file_name','client_work_status.status as c_status','register_member.rmid')->join('enquiry_user','client_work_status.client_transaction_id','=','enquiry_user.tranxid')->join('register_member','enquiry_user.rm_id','=','register_member.id')->where('client_work_status.client_transaction_id',$tran_id)->get();
       $title="Client Work Status";
       $orderDetails = orderModel::select('register_member.rmid','enquiry_user.*')->join('register_member','enquiry_user.rm_id','=','register_member.id')->where('tranxid',$tran_id)->first();
       // return $orderDetails;
      return view('admin.entry.clientWorkStatus.index',compact('clientOrderStatus','tran_id','title','files_list','orderDetails'));
    
   }

    public function create($tran_id) {
      
      $userData = session()->get('usersession');
      if (empty($userData)) {
        return redirect()->route('wpanelLogin');
      }
      $files_list = Client_Work_status::select('enquiry_user.*','client_work_status.file_link','client_work_status.status as c_status','register_member.rmid')->join('enquiry_user','client_work_status.client_transaction_id','=','enquiry_user.tranxid')->join('register_member','enquiry_user.rm_id','=','register_member.id')->where('client_work_status.client_transaction_id',$tran_id)->first();

      $clientOrderStatus = $this->arraydb::$clientOrderStatus;
       $orderDetails = orderModel::select('register_member.rmid','enquiry_user.*')->join('register_member','enquiry_user.rm_id','=','register_member.id')->where('tranxid',$tran_id)->first();
      
      $title="Client Work Status update";
     
      return view('admin.entry.clientWorkStatus.create',compact('clientOrderStatus','title','tran_id','files_list','orderDetails'));
   }

   public function store(Request $request) {
           date_default_timezone_set("Asia/Calcutta");
          if(empty($request->file('drive_file'))){
           return redirect()->route('admin.entry.client-work-status.create',$request->transaction_id);
          }
          $file_name =$request->transaction_id.$request->file('drive_file')->getClientOriginalName();
          $contents = file_get_contents($request->file('drive_file')->getRealPath());
          $result = Storage::disk('google')->put($file_name,$contents);
           $obj = new Client_Work_status;
           $obj->client_transaction_id=$request->transaction_id;
           $obj->status=$request->status;
            $obj->created_at = date('Y-m-d h:i:s'); 
           if($result){
            $obj->file_link = Storage::disk('google')->url($file_name);
           }
           $obj->file_name = $file_name;
           $obj->save();
          return redirect()->route('admin.entry.client-work-status',$request->transaction_id);
    }
   
 }

