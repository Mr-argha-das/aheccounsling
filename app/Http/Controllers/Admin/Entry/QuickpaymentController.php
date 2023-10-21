<?php

namespace App\Http\Controllers\Admin\Entry;
use Illuminate\Http\Request;
use Validator;
use \App\Model\UserModel;
use App\Http\Controllers\Controller;
use App\Model\PaymentDetails_model;
use App\Model\Entry\Service_model;
use \App\Model\Entry\Payment_key_model;


class QuickpaymentController  extends Controller{



  public $title = 'Quick Payment List';
  public $viewFolder = "entry/payment";
  public $viewData = [];
  public $model = [];
  public $UserData = [];

public function __construct(Request $request){

     parent::__construct();
    
    $this->storePath  =  'admin/' . $this->viewFolder;
    $this->viewpPath = $this->viewFolder . '/';
    $this->viewFolder = 'admin/' . $this->viewFolder . '/';
    $this->viewData['viewpPath'] = $this->viewpPath;
    $this->viewData['viewFolder'] = $this->viewFolder;
    $this->viewData['timedate'] = $this->timedate;

  }


  public function index(Request $request){
    
       
      $userData = session()->get('usersession');
      if (empty($userData)) {
       return redirect()->route('wpanelLogin');
      }

      $this->viewData['title'] = $this->title;
      
      $table = new PaymentDetails_model;
      $sqlObj = $table->getDefautl()->select('payment_details.*','entry_service.services_name','payment_key.symbol')->join('entry_service','entry_service.services_id','=','payment_details.productinfo')->join('payment_key','payment_key.id','=','payment_details.payment_key_type')->where('rm_id',$userData['rm_id'])->orderBy('id','desc'); 
      $data = $this->common->setPagination($sqlObj);
   
      // return $data;
      $this->viewData['pagination'] = $data['pagination'];
      $this->viewData['records'] = $data['records'];
      view()->share($this->viewData);
      return view($this->viewFolder . 'quickpayment');
   }
  
   public function create(){

    $userData = session()->get('usersession');
    if (empty($userData)) {
     return redirect()->route('wpanelLogin');
    }
     $this->viewData['client_list'] = UserModel::where('rm_id',$userData['rm_id'])->orderBy('user_id','desc')->get();
     $this->viewData['paymentCurrencyList'] = Payment_key_model::where('status','1')->get();

    $this->viewData['rm_id_selected']  = $userData['rm_id']; 
    $this->viewData['title'] = 'Create Quick Link';
    $this->viewData['formAction'] = "admin/entry/quickpayment";
    view()->share($this->viewData);
    return view($this->viewFolder . 'create');

  }

  public function store(Request $request){
     
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
      $obj->created_at = date('Y-m-d h:i:s');
      $obj->updated_at = date('Y-m-d h:i:s');
      $obj->txnid = 'Tnx-'.strtotime(date('m/d/Y h:i:s a',time()));

      if($obj->save()){
          return $this->restModel->successOut('Quick Link Successfully Created');
       } 
       
    }

  public function edit($id){

   $userData = session()->get('usersession');
   if(empty($userData)) {
      return redirect()->route('wpanelLogin');
   }
    $this->viewData['editData']    =  PaymentDetails_model::find($id);
    $this->viewData['client_list'] =  UserModel::where('rm_id',$userData['rm_id'])->orderBy('user_id','desc')->get();
    $this->viewData['paymentCurrencyList'] = Payment_key_model::where('status','1')->get();
    $this->viewData['rm_id_selected']  = $userData['rm_id']; 
    $this->viewData['title'] = 'Edit Quick Link';
    $this->viewData['formAction'] = "admin/entry/quickpayment/".$id;

    view()->share($this->viewData);
    return view($this->viewFolder . 'edit');

  }

  public function update(Request $request, $id){
     
      $obj = PaymentDetails_model::find($id);
       
      $clientData = UserModel::find($request->client_id);
      $obj->firstname = $clientData->user_name;
      $obj->email = $clientData->user_email;
      $obj->phone = $clientData->phone_code.' '.$clientData->mobile;
      $obj->address1 = $clientData->univercity_name;
      $obj->amount = $request->amount;
      $obj->productinfo = $request->service_id;
      $obj->client_id = $request->client_id;
      $obj->payment_key_type = $request->currenct_type;
      if($obj->save()){
          return $this->restModel->successOut('Quick Link Successfully Update');
       } 
       
    }

    public function delete($id){
      
       $userData =  PaymentDetails_model::findOrFail($id);
       $userData->delete();
       return redirect('admin/entry/quickpayment');

    }

  

}

