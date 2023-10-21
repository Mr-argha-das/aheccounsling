<?php

namespace App\Http\Controllers\Admin\Entry;
use Illuminate\Http\Request;
use Validator;
use \App\Model\UserModel as UserModel;
use \App\Model\Login_model as loginModel;
use \App\Model\Entry\User_contact;
use App\Http\Controllers\Controller;
use DB;
use File;



class ClientsController  extends Controller{



  public $title = 'My Clients List';
  public $viewFolder = "entry/myclients";
  public $viewData = [];
  public $model = [];
  public $UserData = [];
  
  public function __construct(Request $request){

     parent::__construct();

    // Add a few messages
    $this->storePath  =  'admin/' . $this->viewFolder;
    $this->viewpPath = $this->viewFolder . '/';

    $this->viewFolder = 'admin/' . $this->viewFolder . '/';

    $this->viewData['viewpPath'] = $this->viewpPath;

    $this->viewData['viewFolder'] = $this->viewFolder;

    $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI; //tableToArray('party_id','party_name','sy_master_party','select');

    $this->arraydb = new \App\Library\Arraydb;

    $this->UserModel = new UserModel;

    $this->viewData['timedate'] = $this->timedate;

  }



  public function index(Request $request){
    
     $userData = session()->get('usersession');
     if (empty($userData)) {
       return redirect()->route('wpanelLogin');
     }
    $table = new UserModel;
    $this->viewData['title'] = $this->title;
       if($userData['rm_id']==0){
        $sqlObj = $table->getDefautl()->Leftjoin('register_member','id','=','rm_id')->orderBy('user_id','desc'); 
       }else{

       $sqlObj = $table->getDefautl()->where('rm_id',$userData['rm_id'])->orderBy('user_id','desc'); 

       }
     
      if (!empty($request->query('name'))) {
            $sqlObj->where('user_name', 'like', '%' . $request->query('name') . '%');
        }
      if (!empty($request->query('email'))) {
            $sqlObj->where('user_email', 'like', '%' . $request->query('email') . '%');
      }

     if (!empty($request->query('mobile'))) {
            $sqlObj->where('mobile', 'like', '%' . $request->query('mobile') . '%');
      }
        
    $data = $this->common->setPagination($sqlObj);
    $this->viewData['rm_id'] = $userData['rm_id'];
    $this->viewData['pagination'] = $data['pagination'];
    $this->viewData['records'] = $data['records'];
    // return $this->viewData;
    view()->share($this->viewData);

    return view($this->viewFolder . 'index');

  }

  public function userData(Request $request,$client_id){ 
     

     $userData = session()->get('usersession');
     if (empty($userData)) {
       return redirect()->route('wpanelLogin');
     }
      

      $json_data = User_contact::where('client_id',$client_id)->first();
      $this->viewData['client_id'] =$client_id;
      $this->viewData['title'] =   UserModel::find($json_data->client_id)->user_name;
      $this->viewData['records'] =json_decode($json_data->json_data,true);
        
       if(!empty($request->download)){
          $filename = $this->viewData['title']."-" . date('d-F-M') . ".csv"; 
            if(count($this->viewData['records'])==0){return redirect($this->viewFolder);}
            $delimiter = ",";ob_clean();$f = fopen('php://memory', 'w+');
            $fields = array('Name','Mobile');fputcsv($f, $fields, $delimiter);
            $csvHeader =array();
            foreach ($this->viewData['records'] as $key => $value) { 
            $csvHeader['name']  =  $value['name'];
            $csvHeader['phone']   =  $value['number'];
            fputcsv($f, $csvHeader, $delimiter); 
            }  
            fseek($f, 0); 
            header('Content-Type: text/csv'); 
            header('Content-Disposition: attachment; filename="' . $filename . '";'); 
            fpassthru($f);  exit;                  
            return redirect($this->viewFolder);
       }
     view()->share($this->viewData);
     return view($this->viewFolder . 'userData');
  
  }
  public function clientDataDownloadCSV(Request $request){
      
         $filename='';$rm_id =$request->rm_id;
         if($rm_id==0){
            $filename = "AHEC-" . date('d-F-M') . ".csv"; 
          }else{
           $rmuserdata = \App\Model\Entry\RegisterMember_model::findOrFail($rm_id);
           $filename = $rmuserdata->name.'-'. date('d-F-Y') . ".csv"; 
          }
          $start_date = $request->start_date;$end_date = $request->end_date;
          if($start_date!=null && $end_date!=null){
            $filename = date('d-F-Y',strtotime($start_date)).'-'.date('d-F-Y',strtotime($end_date)).'-'.$filename;
          }
          $userData =  UserModel::select('user_login.*','register_member.rmid')->join('register_member','rm_id','=','register_member.id');
       
          if($start_date!=null && $end_date!=null){
            $userData =  $userData->whereBetween('user_created_at', [date('Y-m-d',strtotime($start_date)),date('Y-m-d',strtotime($end_date))]);
          }
          
          if($rm_id!=0){
            $userData =  $userData->where('rm_id',$rm_id);
          }
          $csvData= $userData->orderBy('user_created_at','desc')->groupBy('user_email','mobile')->get();

         
          if(count($csvData)==0){
            return false;
          }
    $delimiter = ","; 
    ob_clean();
    $f = fopen('php://memory', 'w+');
    $fields = array('Name','Email','Mobile','Univercity Name','RMID'); 
    fputcsv($f, $fields, $delimiter); 

     $csvHeader =array();
     foreach ($csvData as $key => $value) { 
       $csvHeader['name']  =  $value->user_name;
       $csvHeader['email']   =  $value->user_email;
       $csvHeader['phone']   =  '+'.$value->phone_code.'-'.$value->mobile;
       $csvHeader['univercity_name']   =  $value->univercity_name;
       $csvHeader['rmid']   =  $value->rmid;
       fputcsv($f, $csvHeader, $delimiter); 
      }  
    fseek($f, 0); 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
    fpassthru($f);  exit;                  
     return true;
   

  }
   public function create(){

    $userData = session()->get('usersession');

    if (empty($userData)) {

     return redirect()->route('wpanelLogin');

    }
   
    $this->viewData['rm_id_selected']  = $userData['rm_id']; 
     
    $this->viewData['title'] = 'Add New Client';

    $this->viewData['formAction'] = $this->storePath;

    view()->share($this->viewData);

    return view($this->viewFolder . 'create');

  }

  public function statusupdate($client_id,$type){
        
         $userData =  UserModel::find($client_id);
         $userData->is_approved =$type;
         $userData->save();
         return redirect()->back();
   }

  public function store(Request $req){
   
    $userData =  UserModel::where('user_email',$req->modal_en_email)->where('rm_id',$req->rm_id)->first();

    if(empty($userData)){
           $messages ="Successfully Saved";
           $preData =  UserModel::where('user_email',$req->modal_en_email)->get();
           $objuser = new UserModel;
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
            
           $objuser->user_name = $req->modal_en_first_name.' '.$req->modal_en_last_name;
           $objuser->user_email = $req->modal_en_email;
           $objuser->user_password = $req->modal_en_mobile;
           $objuser->mobile     = $req->modal_en_mobile;
           $objuser->phone_code     = $req->country_code;
           $objuser->user_status = 2;
           $objuser->rm_id = $req->rm_id;
           $objuser->univercity_name = $req->univercity_name;

           if (!$objuser->save()) {
              $this->restModel->errorOut('Error While Occur');
            }
          } 
       return $this->restModel->successOut('Successfully Saved');
    }

  public function edit($id){

   $userData = session()->get('usersession');
  
   if (empty($userData)) {

     return redirect()->route('wpanelLogin');

    }
   
    $this->viewData['rm_id']  = $userData['rm_id']; 
      
    $this->viewData['row'] = UserModel::find($id);

    $this->viewData['title'] = 'Edit ' . $this->title;

    $this->viewData['formAction'] = $this->viewFolder . $id;

    view()->share($this->viewData);

    return view($this->viewFolder . 'edit');

  }

  public function update(Request $req, $id){
   
   $userData = session()->get('usersession');
    if (empty($userData)) {
     return redirect()->route('wpanelLogin');
    }
         $userData =  UserModel::findOrFail($id);
         $userData->user_name = $req->modal_en_first_name;
         $userData->user_email = $req->modal_en_email;
         $userData->user_password = $req->modal_en_mobile;
         $userData->mobile     = $req->modal_en_mobile;
         $userData->phone_code     = $req->country_code;
         $userData->univercity_name = $req->univercity_name;
         $userData->rm_id = $req->rm_id;
        if (!$userData->save()) {
           $this->restModel->errorOut('Error While Occur');
          }
          
      return $this->restModel->successOut('Successfully Updated');
    }

    public function delete($urlSlug){

       $workModel  = new UserModel;
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

