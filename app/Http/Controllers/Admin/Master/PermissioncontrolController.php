<?php
namespace App\Http\Controllers\Admin\Master;
use Illuminate\Http\Request;
use Validator;
use \App\Model\Master\Permission_model as permission_model;
use \App\Model\Master\Permissioncontrol_model as permissioncontrol_model;
use App\Http\Controllers\Controller;
      
class PermissioncontrolController  extends Controller
{

    public $title = 'Permission Allotment';
    public $viewFolder ="master/permissioncontrol";
    public $viewData=[];
    public $model=[];

    public function __construct(Request $request)
    {


        parent::__construct();
        // Add a few messages
        $this->viewpPath = $this->viewFolder.'/';
        $this->viewFolder = 'admin/'.$this->viewFolder.'/';
        $this->viewData['viewpPath'] = $this->viewpPath;
        $this->viewData['viewFolder'] = $this->viewFolder;
        $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI;//
          $this->viewData['teamType'] = \App\Library\Arraydb::$loginUsers;
          $this->viewData['permissionList'] = permissioncontrol_model::listOfPermission();
          //tableToArray('party_id','party_name','sy_master_party','select');
    }

    public function index() {
       $table= new permissioncontrol_model;
        $this->viewData['title'] = $this->title;

        $sqlObj = $table->orderBy($table->getKeyName(),'desc')->get();
       // $this->viewData['tableToArray']
   
        $this->viewData['records'] = $sqlObj; 
        view()->share($this->viewData);
        return view($this->viewFolder.'index'); 
    }
    public function create() {
         $table= new permissioncontrol_model;
          $sqlObj = $table->orderBy($table->getKeyName())->get();
        $this->viewData['records'] = $sqlObj; 
            $this->viewData['niceNames'] = $table->niceNames;
        $this->viewData['title'] = 'Add '.$this->title;
        $this->viewData['formAction'] = $this->viewFolder;
      
        view()->share($this->viewData);
        return view($this->viewFolder.'create');
    }
    public function store(Request $request) {
        $obj = new permissioncontrol_model;
        $multiInuts = $obj::manageInputs($request);
        if(empty($multiInuts))
        {

         return $this->restModel->errorOut('Min One permission is required');   
        }

        $obj::saveMultiple($multiInuts);
        return $this->restModel->successOut('Successfully Updated');
     }


    public function show($id) {
           $table= new permission_model;
        $row=$table->findOrFail($id);
        $this->viewData['row'] = $row;
          $this->viewData['title'] = 'View '.$this->title;
           $this->viewData['niceNames'] = $table->niceNames;
        view()->share($this->viewData);
        return view($this->viewFolder.'show');
    }
    public function edit($id) {
                  $table= new permission_model;
        $row=$table->findOrFail($id);
        $this->viewData['row'] = $row;

        $this->viewData['title'] = 'Edit '.$this->title;
        $this->viewData['formAction'] = $this->viewFolder.$id;
          $this->viewData['niceNames'] = $table->niceNames;
        view()->share($this->viewData);
        return view($this->viewFolder.'edit');
    }
    public function update(Request $request, $id) {

        $cModel = new permission_model;
        $validator = $cModel->validation($request,'family_name');
        $obj=$cModel->findOrFail($id);

        if ($validator->fails()) {
        return $this->restModel->validationOut($validator->messages());
        }
           $obj->route_title         =   $request->route_title;
          $obj->route_key         =   $request->route_key;
          $obj->route_value         =   $request->route_value;
    
        if( $obj->save()){
            return $this->restModel->successOut('Successfully Updated');
        }
    }
   
    

}