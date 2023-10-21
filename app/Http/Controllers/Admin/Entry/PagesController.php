<?php

namespace App\Http\Controllers\Admin\Entry;



use Illuminate\Http\Request;

use Validator;

use \App\Model\Entry\Page_model as WorkmModel;

use \App\Model\Login_model as loginModel;

use App\Http\Controllers\Controller;

use DB;

use File;

use \App\Model\Login_model as login_model;



class PagesController  extends Controller

{



  public $title = 'Manage Pages ';

  public $viewFolder = "entry/pages";

  public $viewData = [];

  public $model = [];

  public $UserData = [];

  public function __construct(Request $request)

  {





    parent::__construct();

    // Add a few messages

    $this->viewpPath = $this->viewFolder . '/';

    $this->viewFolder = 'admin/' . $this->viewFolder . '/';

    $this->viewData['viewpPath'] = $this->viewpPath;

    $this->viewData['viewFolder'] = $this->viewFolder;

    $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI; //tableToArray('party_id','party_name','sy_master_party','select');

    $this->arraydb = new \App\Library\Arraydb;

    $this->viewData['categoryType'] = $this->arraydb->tableToArray('tpl_id','tpl_title','master_tpl');

    $this->viewData['orderType'] = $this->arraydb->OrderArrayPages();

    $this->WorkmModel = new WorkmModel;

    $this->viewData['catList'] = $this->arraydb->catList();

    $this->viewData['timedate'] = $this->timedate;

    $this->viewData['status'] = \App\Library\Arraydb::$status; //tableToArray('party_id','party_name','sy_master_party','select');

    

  }



  public function index(Request $request)

  {

    $userData = session()->get('usersession');

    $ticketId = $request->query('id');



    if (empty($userData)) {

      return redirect()->route('wpanelLogin');

    }

   $dtAuth =  login_model::checkUserPermissions($request);

    if (empty($dtAuth)) {

      return redirect('admin/user/permissiondenied');

    }

    $table = new WorkmModel;

    $this->viewData['title'] = $this->title;

    $sqlObj = $table->getDefautl()->orderBy($table->getKeyName(),'desc'); 

    $data = $this->common->setPagination($sqlObj);



    $this->viewData['pagination'] = $data['pagination'];

    $this->viewData['records'] = $data['records'];

    view()->share($this->viewData);

    return view($this->viewFolder . 'index');

  }

  public function create()

  {

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

    $obj->menu_name = $request->menu_name;

    $obj->menu_parent = $request->menu_parent;

    $obj->menu_url = !empty($request->menu_url)?$request->menu_url:'./';

    $obj->menu_order = $request->menu_order;

    $obj->menu_txt = $request->menu_txt;

    $obj->menu_img = $request->menu_img;

    

    $obj->sub_menu_status = $request->sub_menu_status;

    $obj->menu_cat_type = $request->menu_cat_type;

    $obj->menu_alias = $request->menu_alias;

    $obj->menu_show = $request->menu_show;

    $obj->menu_seo_title = $request->menu_seo_title;

    $obj->menu_seo_des = $request->menu_seo_des;

    $obj->menu_seo_keyword = $request->menu_seo_keyword;

    $obj->menu_slider_img = !empty($request->menu_slider_img)?implode('+|',$request->menu_slider_img):'';

    $obj->menu_slider_text = $request->menu_slider_text;

    $obj->menu_thumb = $request->menu_thumb;

    $obj->menu_slider_status = $request->menu_slider_status;



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

  public function edit($id)

  {

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



    $obj->menu_name = $request->menu_name;

    $obj->menu_parent = $request->menu_parent;

    $obj->menu_url = $request->menu_url;

    $obj->menu_order = $request->menu_order;

    $obj->menu_txt = $request->menu_txt;

    $obj->sub_menu_status = $request->sub_menu_status;

    $obj->menu_cat_type = $request->menu_cat_type;

    $obj->menu_alias = $request->menu_alias;

    $obj->menu_show = $request->menu_show;

    $obj->menu_seo_title = $request->menu_seo_title;

    $obj->menu_seo_des = $request->menu_seo_des;

    $obj->menu_seo_keyword = $request->menu_seo_keyword;

    $obj->menu_slider_img = !empty($request->menu_slider_img)?implode('+|',$request->menu_slider_img):$obj->menu_slider_img;

    $obj->menu_slider_text = $request->menu_slider_text;

      $obj->menu_img = $request->menu_img;

    $obj->menu_thumb = $request->menu_thumb;

    $obj->menu_slider_status = $request->menu_slider_status;

    if ($obj->save()) {

      return $this->restModel->successOut('Successfully Updated');

    }

  }





}

