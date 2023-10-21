<?php
namespace App\Http\Controllers\Admin\Master;
use Illuminate\Http\Request;
use Validator;
use \App\Model\Master\Permission_model as permission_model;
use App\Http\Controllers\Controller;

class PermissionController  extends Controller
{

    public $title = 'Route Permission ';
    public $viewFolder ="master/permission";
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
        $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI;//tableToArray('party_id','party_name','sy_master_party','select');
    }

    public function index() {
       $table= new permission_model;
        $this->viewData['title'] = $this->title;

        $sqlObj = $table->orderBy($table->getKeyName(),'desc');
       // $this->viewData['tableToArray']
        $data = $this->common->setPagination($sqlObj);

        $this->viewData['pagination'] = $data['pagination'];
        $this->viewData['records'] = $data['records']; 
        view()->share($this->viewData);
        return view($this->viewFolder.'index'); 
    }
    public function create() {
         $table= new permission_model;
          $sqlObj = $table->orderBy($table->getKeyName());
     
            $this->viewData['niceNames'] = $table->niceNames;
        $this->viewData['title'] = 'Add '.$this->title;
        $this->viewData['formAction'] = $this->viewFolder;
      
        view()->share($this->viewData);
        return view($this->viewFolder.'create');
    }
    public function store(Request $request) {
        $obj = new permission_model;
        $validator = $obj->validation($request);
        if ($validator->fails()) {
            return $this->restModel->validationOut($validator->messages());
            
        }


          $obj->route_title         =   $request->route_title;
          $obj->route_key         =   $request->route_key;
          $obj->route_value         =   $request->route_value;
          $obj->route_type    = $request->route_type;
    
        if(!$obj->save())
        {
           $this->restModel->errorOut('Error While Occur');
        }
        

         return $this->restModel->successOut('Successfully Inserted');   

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
          $obj->route_type    = $request->route_type;
        if( $obj->save()){
            return $this->restModel->successOut('Successfully Updated');
        }
    }
   
    

}