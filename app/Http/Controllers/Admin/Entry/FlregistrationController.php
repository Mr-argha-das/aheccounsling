<?php

namespace App\Http\Controllers\Admin\Entry;
use Illuminate\Http\Request;
use Validator;
use \App\Model\Website\FlModel as WorkmModel;
use \App\Model\Login_model as loginModel;
use App\Http\Controllers\Controller;
use DB;
use File;



class FlregistrationController  extends Controller

{



  public $title = 'FL Registration Forms ';

  public $viewFolder = "entry/flregistration";

  public $viewData = [];

  public $model = [];

  public $UserData = [];

  public function __construct(Request $request)

  {

   parent::__construct();
    
    $this->storePath  =  'admin/' . $this->viewFolder;
    $this->viewpPath = $this->viewFolder . '/';
    $this->viewFolder = 'admin/' . $this->viewFolder . '/';
    $this->viewData['viewpPath'] = $this->viewpPath;
    $this->viewData['viewFolder'] = $this->viewFolder;
    $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI; //tableToArray('party_id','party_name','sy_master_party','select');
    $this->arraydb = new \App\Library\Arraydb;
    $this->WorkmModel = new WorkmModel;
    $this->viewData['timedate'] = $this->timedate;
  }



  public function index(Request $request)

  {

    $userData = session()->get('usersession');

    $ticketId = $request->query('id');



    if (empty($userData)) {

      return redirect()->route('wpanelLogin');

    }

  

    $table = new WorkmModel;

    $this->viewData['title'] = $this->title;

    $sqlObj = $table->getDefautl()->orderBy('af_id','desc'); 

    $data = $this->common->setPagination($sqlObj);

   $this->viewData['pagination'] = $data['pagination'];

    $this->viewData['records'] = $data['records'];

    view()->share($this->viewData);

    return view($this->viewFolder . 'index');

  }
 

 public function create(){

    $userData = session()->get('usersession');
    if (empty($userData)) {
     return redirect()->route('wpanelLogin');
    }

    $this->viewData['title'] = 'Add ' . $this->title;

    $this->viewData['formAction'] = $this->storePath;

    view()->share($this->viewData);

    return view($this->viewFolder . 'create');

  }

  public function store(Request $request){
        
        
       $obj               = new WorkmModel;
       $obj->af_name      = $request->fl_name;
       $obj->af_email     = $request->fl_email;
       $obj->af_mobile    = $request->fl_mobile;
       $obj->af_address   = $request->fl_address;
       $obj->bank_name    = $request->bank_name;
       $obj->bank_no      = $request->bank_no;
       $obj->bank_ifsc    = $request->bank_ifsc;
       $obj->bank_branch  = $request->bank_branch;
       $obj->fl_alternate_number      = $request->fl_alternate_number;
       $obj->aadhar_number = $request->aadhar_number;
       $obj->pan_number    = $request->pan_number;
       $obj->country_code  = $request->fl_country_code;
      
       if (!$obj->save()) {
         $this->restModel->errorOut('Error While Occur');
       }
       return $this->restModel->successOut('Successfully Saved');
   }



   public function edit($id) {

     $table = new WorkmModel;
     $row = $table->findOrFail($id);

    $this->viewData['row'] = $row;

    $this->viewData['title'] = 'Edit ' . $this->title;

    $this->viewData['formAction'] = $this->viewFolder . $id;

    $this->viewData['niceNames'] = $table->niceNames;

    view()->share($this->viewData);

    return view($this->viewFolder . 'edit');

  }

  public function update(Request $request, $id) {
   
     $cModel = new WorkmModel;
     $obj = $cModel->findOrFail($id);
     $obj->af_name      = $request->fl_name;
     $obj->af_email     = $request->fl_email;
     $obj->af_mobile    = $request->fl_mobile;
     $obj->af_address   = $request->fl_address;
     $obj->bank_name    = $request->bank_name;
     $obj->bank_no      = $request->bank_no;
     $obj->bank_ifsc    = $request->bank_ifsc;
     $obj->bank_branch  = $request->bank_branch;
     $obj->fl_alternate_number      = $request->fl_alternate_number;
     $obj->aadhar_number = $request->aadhar_number;
     $obj->pan_number    = $request->pan_number;
     $obj->country_code  = $request->fl_country_code;
   
    if ($obj->save()) {
       return $this->restModel->successOut('Successfully Updated');
     }

  }

    public function delete($urlSlug){

       $workModel  = new WorkmModel;
       $find = $workModel->find($urlSlug);
       $workModel->destroy($urlSlug);
       return redirect($this->viewFolder);
     }

  

}

