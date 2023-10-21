<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use Validator;
use DB;
use \App\Model\Master\Team as team_model;
use App\Http\Controllers\Controller;
use \App\Model\Login_model as login_model;
use  \App\Library\Arraydb as arraydb;

class TeamController  extends Controller
{

    public $title = 'User Management';
    public $table = 'master_team';
    public $viewFolder = "master/team";
    public $tableName = 'master_team';
    public $multiTable = 'allot_user';
    public $multicol = 'allot_user_id';
    public $viewData = [];
    public $model = [];

    public function __construct(Request $request)
    {
        parent::__construct();
        // Add a few messages
        $this->viewpPath = $this->viewFolder . '/';
        $this->viewFolder = 'admin/' . $this->viewFolder . '/';
        $this->viewData['viewpPath'] = $this->viewpPath;
        $this->viewData['viewFolder'] = $this->viewFolder;
        $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI;
        $this->viewData['teamType'] = \App\Library\Arraydb::$loginUsers;

        //dd(session()->get('usersession'));die;

        $this->arraydb = new arraydb;;
        $this->viewData['arraydb'] = $this->arraydb;
    }

    public function logincheckSession($request)
    {
    }

    public function index(Request $request)
    {
       // dd(chop($request->path(),"wpanel"));die;

      /*  $dtAuth =  login_model::checkUserPermissions($request);
        if (empty($dtAuth)) {
            return redirect('wpanel/user/permissiondenied');
        }*/

        $table = new team_model;
        $this->viewData['title'] = $this->title;
        $this->viewData['niceNames'] = $table->niceNames;

        $sqlObj = $table->orderBy($table->getKeyName(), 'desc');

        if (!empty($request->query('filter_team_name'))) {
            $sqlObj->where('team_name', 'like', '%' . $request->query('filter_team_name') . '%');
        }
        if (!empty($request->query('filter_team_email'))) {
            $sqlObj->where('team_email', 'like', '%' . $request->query('filter_team_email') . '%');
        }
        if (!empty($request->query('filter_team_type'))) {
            $sqlObj->where('team_type', $request->query('filter_team_type'));
        }
        if (!empty($request->query('filter_team_mob'))) {
            $sqlObj->where('team_mob', $request->query('filter_team_mob'));
        }

        $data = $this->common->setPagination($sqlObj);

        $this->viewData['pagination'] = $data['pagination'];
        $this->viewData['records'] = $data['records'];
        view()->share($this->viewData);
        return view($this->viewFolder . 'index');
    }
    public function create()
    {

        $table = new team_model;
        $this->viewData['allotTypelist'] = $table->allotlist();
        $this->viewData['title'] = 'Add ' . $this->title;
        $this->viewData['niceNames'] = $table->niceNames;
        $this->viewData['formAction'] = $this->viewFolder;
        view()->share($this->viewData);
        return view($this->viewFolder . 'create');
    }
    public function store(Request $request)
    {

        $obj = new team_model;
        $validator = $obj->validation($request);
        if ($validator->fails()) {
            return $this->restModel->validationOut($validator->messages());
            //return response()->json($validator->messages(), 200);
        }
        $multiInput = $obj->multipleInputs($request);
        $data =  [
            'team_name' => $request->team_name,
            'team_email' => $request->team_email,
            'team_type' => $request->team_type,
            'team_dob' => date('Y-m-d'),
            'team_mob' =>'1231231232',
            'team_office_mob' => '1231231232',
            'team_address' => '',
            'team_pan' => '',
            'team_addhar' => '',
            'team_status' => 1,
            'team_password' => $request->team_password,
            'team_creation_date' => date('Y-m-d H:i:s'),
            'team_last_update' => date('Y-m-d H:i:s'),



        ];
        if(empty($multiInput))
        {
              return $this->restModel->errorOut('Min One Permission is required');
        }


        $id  =   DB::table($this->table)->insertGetId($data);
        if (!$id) {
            return $this->restModel->errorOut('Error While Save');
        } else {
            if (!empty($multiInput)) {
                $obj->storemultiple($this->multiTable, $this->multicol, $multiInput, $id);
            }
            return  $this->restModel->successOut('Successfully Created');
        }
        
    }
    public function show($id)
    {
        $table = new team_model;
        $row = $table->findOrFail($id);
      
        $this->viewData['allotTypelist'] = $table->allotlist();
        $this->viewData['findlistdata'] = $table->findlistdata($id);
        $this->viewData['row'] = $row;
        $this->viewData['title'] = 'View ' . $this->title;
        $this->viewData['niceNames'] = $table->niceNames;
        view()->share($this->viewData);

        return view($this->viewFolder . 'show');
    }
    public function edit($id)
    {
        $table = new team_model;
        $row = $table->findOrFail($id);
        $this->viewData['row'] = $row;
        $this->viewData['title'] = 'Edit ' . $this->title;
        $this->viewData['allotTypelist'] = $table->allotlist();
        $this->viewData['findlistdata'] = $table->findlistdata($id);
        $this->viewData['niceNames'] = $table->niceNames;
        $this->viewData['formAction'] = $this->viewFolder . $id;
        view()->share($this->viewData);
        return view($this->viewFolder . 'edit');
    }
    public function update(Request $request, $id)
    {

        $cModel = new team_model;
        $validator = $cModel->validation($request, 'team_email');
        $obj = $cModel->findOrFail($id);
         if ($validator->fails()) {
            return $this->restModel->validationOut($validator->messages());
          }
        $multiInput  =  $obj->multipleInputs($request);
        $obj->team_name                =   $request->team_name;
        $obj->team_type                =   $request->team_type;
        $obj->team_dob                =   date('Y-m-d');
        $obj->team_mob             =   '11';
        $obj->team_office_mob             =   '11';
        $obj->team_address             =   '1';
        $obj->team_pan             =  '1';
        $obj->team_addhar             =   '1';
        $obj->team_password = $request->team_password;
         if(empty($multiInput))
        {
              return $this->restModel->errorOut('Min One Permission is required');
        }
        if ($obj->save()) {
             if (!empty($multiInput)) {
                $obj->storemultiple($this->multiTable, $this->multicol, $multiInput, $id);
            }
            return $this->restModel->successOut('Successfully Updated');
        } else {
            return $this->restModel->errorOut('Error While Save');
        }
    }
}
