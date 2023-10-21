<?php

namespace App\Http\Controllers\Admin\Entry;
use Illuminate\Http\Request;
use Validator;
use \App\Model\Entry\Blog_model as WorkmModel;
use \App\Model\Login_model as loginModel;
use App\Http\Controllers\Controller;
use DB;
use File;
use \App\Model\Login_model as login_model;



class BlogsController  extends Controller
 {

  public $title = 'Blogs ';

  public $viewFolder = "entry/blogs";

  public $viewData = [];

  public $model = [];

  public $UserData = [];

  public $storePath = '';

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



  public function index(Request $request){

     $userData = session()->get('usersession');
     $ticketId = $request->query('id');
     if (empty($userData)) {
      return redirect()->route('wpanelLogin');
     }

     $table = new WorkmModel;
     $this->viewData['title'] = $this->title;
     $sqlObj = $table->getDefautl()->Leftjoin('user_login','user_id','=','blog_user_id')->orderBy('blog_id','desc');
     if (!empty($request->query('blog_title'))) {
          $sqlObj->where('blog_name', 'like', '%' . $request->query('blog_title') . '%');
      }
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
     $this->viewData['formAction'] = $this->storePath;
     view()->share($this->viewData);
     return view($this->viewFolder . 'create');
  }

  public function store(Request $request)

  {

    $userData = session()->get('usersession');



    if (empty($userData)) {

      return redirect()->route('wpanelLogin');

    }

    $obj = new WorkmModel;

    $validator = $obj->validation($request);

    if ($validator->fails()) {

      return $this->restModel->validationOut($validator->messages());

    }

    $obj->blog_name     = $request->blog_name;

    $obj->blog_desc     = $request->blog_desc;

    $obj->blog_image    = $request->blog_image;

    $obj->blog_status   = $request->blog_status;

    $obj->blog_comment  = $request->blog_comment;
    $obj->youTubeLink  = $request->youTubeLink;

    $obj->seo_tilte  = $request->seo_tilte;
    $obj->seo_keyword  = $request->seo_keyword;
    $obj->seo_description  = $request->seo_description;
    $obj->image_alt  = $request->image_alt;
    $obj->order_number  = $request->order_number;


    $obj->blog_date = date('Y-m-d');



    if (!$obj->save()) {

      $this->restModel->errorOut('Error While Occur');

    }

    return $this->restModel->successOut('Successfully Saved');

  }





  public function show($id)

  {

    $userData = session()->get('usersession');



    if (empty($userData)) {

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

  public function edit($id) {

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

  public function update(Request $request, $id) {
   
      
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
  
    $obj->blog_name     = $request->blog_name;

    $obj->blog_desc     = $request->blog_desc;

    $obj->blog_image    = $request->blog_image;

    $obj->blog_status   = $request->blog_status;

    $obj->blog_comment  = $request->blog_comment;
    $obj->seo_tilte  = $request->seo_tilte;
    $obj->seo_keyword  = $request->seo_keyword;
    $obj->seo_description  = $request->seo_description;
    $obj->image_alt  = $request->image_alt;
    $obj->order_number  = $request->order_number;
     $obj->youTubeLink  = $request->youTubeLink;

     if($request->questions!=''){
      $obj->questions = json_encode(explode('__',str_replace("\r\n",'',trim($request->questions))));
      $obj->answers = json_encode(explode('__',str_replace("\r\n",'',trim($request->answers))));

     }else{
      $obj->questions = null;
      $obj->answers = null;
       
    }

   

    if ($obj->save()) {

      return $this->restModel->successOut('Successfully Updated');

    }

  }



       public function delete($urlSlug)

    {

      $workModel  = new WorkmModel;

       $find = $workModel->find($urlSlug);

      if(!empty($find->blog_image))

      {

        $filepath = 'public/assets/uploads/blogs/'.$find->blog_image;

        File::delete($filepath);

      }

      $workModel->destroy($urlSlug);

     return redirect($this->viewFolder);

    }

}

