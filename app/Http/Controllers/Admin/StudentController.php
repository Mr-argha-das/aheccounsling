<?php
namespace App\Http\Controllers\Wpanel;
use Illuminate\Http\Request;
use Validator;
use \App\Model\Student as cModel;
use App\Http\Controllers\Controller;

class StudentController  extends Controller
{

    public $title = 'Student';
    public $viewFolder ="student";
    public $viewData=[];
    public $model=[];

    public function __construct(Request $request)
    {


        parent::__construct();
        // Add a few messages
        $this->viewpPath = $this->viewFolder.'/';
        $this->viewFolder = 'wpanel/'.$this->viewFolder.'/';
        $this->viewData['viewpPath'] = $this->viewpPath;
        $this->viewData['viewFolder'] = $this->viewFolder;
        $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI;
    }

    public function index() {
        $table= new cModel;
        $this->viewData['title'] = $this->title;
        $sqlObj = $table->orderBy($table->getKeyName());
        $data = $this->common->setPagination($sqlObj);
        $this->viewData['pagination'] = $data['pagination'];
        $this->viewData['records'] = $data['records'];
        view()->share($this->viewData);
        return view($this->viewFolder.'index');
    }
    public function create() {
        $this->viewData['title'] = 'Create '.$this->title;
        $this->viewData['formAction'] = $this->viewFolder;
        view()->share($this->viewData);
        return view($this->viewFolder.'create');
    }
    public function store(Request $request) {
        $obj = new cModel;
        $validator = $obj->validation($request);
        if ($validator->fails()) {
            //return $this->restModel->validationOut($validator->messages());
            return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $obj->student_name  =   $request->name;
        $obj->student_class =   $request->st_class;
        $obj->student_dob   =    $this->timedate->dateFormat($request->dob,'in');
        $obj->student_status    =   $request->status;
        $obj->save();
        return \Redirect::back()->with('s', 'Successfully Created');
    }
    public function show($id) {
        $row=cModel::findOrFail($id);
        $this->viewData['row'] = $row;
        view()->share($this->viewData);
        return view($this->viewFolder.'show');
    }
    public function edit($id) {
        $row=cModel::findOrFail($id);
        $this->viewData['row'] = $row;

        $this->viewData['title'] = 'Edit '.$this->title;
        $this->viewData['formAction'] = $this->viewFolder.$id;
        view()->share($this->viewData);
        return view($this->viewFolder.'edit');
    }
    public function update(Request $request, $id) {

        $cModel = new cModel;
        $validator = $cModel->validation($request);
        $obj=$cModel->findOrFail($id);

        if ($validator->fails()) {
            return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $obj->student_name  =   $request->name;
        $obj->student_class =   $request->st_class;
        $obj->student_dob   =    $this->timedate->dateFormat($request->dob,'in');
        $obj->student_status    =   $request->status;

        if( $obj->save()){
            return \Redirect::back()->with('s', 'Successfully Updated');
        }
    }
    public function destroy($id) {
        $obj=cModel::findOrFail($id);
        $obj->delete();
        return \Redirect::back()->with('s', 'Successfully Deleted');
    }

}