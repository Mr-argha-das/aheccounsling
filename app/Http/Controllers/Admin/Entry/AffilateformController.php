<?php

namespace App\Http\Controllers\Admin\Entry;
use Illuminate\Http\Request;
use Validator;
use \App\Model\Website\AffilateModel as WorkmModel;
use \App\Model\Login_model as loginModel;
use App\Http\Controllers\Controller;
use DB;
use File;


class AffilateformController  extends Controller{

  public $title = 'Affiliates Forms ';

  public $viewFolder = "entry/affilateform";

  public $viewData = [];

  public $model = [];

  public $UserData = [];

  public function __construct(Request $request)

  {

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

  

}

