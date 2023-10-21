<?php

namespace App\Http\Controllers\Admin\Entry;
use Illuminate\Http\Request;
use Validator;
use \App\Model\Entry\Aboutus_model as WorkmModel;
use \App\Model\Login_model as loginModel;
use App\Http\Controllers\Controller;
use DB;
use File;
use \App\Model\Login_model as login_model;



class AboutusController  extends Controller{

  public $title = 'About us ';
  public $viewFolder = "entry/aboutus";
  public $viewData = [];
  public $model = [];
  public $UserData = [];
  public function __construct(Request $request){


    parent::__construct();

    $this->viewpPath = $this->viewFolder . '/';
    $this->viewFolder = 'admin/' . $this->viewFolder . '/';
    $this->viewData['viewpPath'] = $this->viewpPath;
    $this->viewData['viewFolder'] = $this->viewFolder;
    $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI; //tableToArray('party_id','party_name','sy_master_party','select');
    $this->arraydb = new \App\Library\Arraydb;
    $this->WorkmModel = new WorkmModel;
    $this->viewData['timedate'] = $this->timedate;
 }

   public function index(Request $request){
    $userData = session()->get('usersession');
    $ticketId = $request->query('id');
    if (empty($userData)) {
     return redirect()->route('wpanelLogin');
    }

    $table = new WorkmModel;
    $this->viewData['title'] = $this->title;
    $sqlObj = $table->getDefautl()->orderBy('about_id','desc'); 
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
    $table = new WorkmModel;
    $sqlObj = $table->orderBy($table->getKeyName());
    $this->viewData['niceNames'] = $table->niceNames;
    $this->viewData['title'] = 'Add ' . $this->title;
    $this->viewData['formAction'] = $this->viewFolder;
    view()->share($this->viewData);
    return view($this->viewFolder . 'create');
  }

  public function store(Request $request){
    $userData = session()->get('usersession');
    if (empty($userData)) {
      return redirect()->route('wpanelLogin');
    }

    $obj = new WorkmModel;
    $validator = $obj->validation($request);
    if ($validator->fails()) {
     return $this->restModel->validationOut($validator->messages());
    }

    $obj->about_name     = $request->about_name;
    $obj->about_desc     = $request->about_desc;
    $obj->about_image    = $request->about_image;
    $obj->about_status   = $request->about_status;
    $obj->keyword     = $request->keyword;
    $obj->description     = $request->description;
    $obj->title     = $request->title;

    if (!$obj->save()) {
      $this->restModel->errorOut('Error While Occur');
     }
    return $this->restModel->successOut('Successfully Saved');
  }

 public function show($id){

    $userData = session()->get('usersession');
    if(empty($userData)) {
      return redirect()->route('wpanelLogin');
     }
    $table = new WorkmModel;
    $row = $table->getDefautl()->findOrFail($id);
    $this->viewData['row'] = $row;
    $this->viewData['title'] = 'View ' . $this->title;
    $this->viewData['niceNames'] = $table->niceNames;
    view()->share($this->viewData);
    return view($this->viewFolder . 'show');
  
  }

  public function edit($id){

    $userData = session()->get('usersession');
    if (empty($userData)) {
      return redirect()->route('wpanelLogin');
    }
    $table = new WorkmModel;
    $row = $table->findOrFail($id);
    $this->viewData['row'] = $row;

    $this->viewData['title'] = 'Edit ' . $this->title;
    $this->viewData['formAction'] = $this->viewFolder . $id;
    $this->viewData['niceNames'] = $table->niceNames;

    view()->share($this->viewData);

    return view($this->viewFolder . 'edit');

  }

  public function update(Request $request, $id)

  {

    $userData = session()->get('usersession');
    if (empty($userData)) {
     return redirect()->route('wpanelLogin');
    }

    $cModel = new WorkmModel;
    $validator = $cModel->validation($request);
    $obj = $cModel->findOrFail($id);

   if ($validator->fails()) {
     return $this->restModel->validationOut($validator->messages());
   }

    $obj->about_name     = $request->about_name;
    $obj->about_desc     = $request->about_desc;
    $obj->about_image    = $request->about_image;
    $obj->about_status   = $request->about_status;
    $obj->keyword     = $request->keyword;
    $obj->description     = $request->description;
    $obj->title     = $request->title;
 
    if ($obj->save()) {
     return $this->restModel->successOut('Successfully Updated');
    }
  }

   public function delete($urlSlug){

       $workModel  = new WorkmModel;
       $find = $workModel->find($urlSlug);

      if(!empty($find->about_image)){
        $filepath = 'public/assets/uploads/aboutus/'.$find->about_image;
        File::delete($filepath);
      }

      $workModel->destroy($urlSlug);

     return redirect($this->viewFolder);

    }

}

