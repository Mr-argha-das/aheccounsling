<?php
namespace App\Http\Controllers\Wpanel\Master;
use Illuminate\Http\Request;
use Validator;
use \App\Model\Session as cModel;
use App\Http\Controllers\Controller;

class SessionsController  extends Controller
{

    public $title = 'Session ';
    public $viewFolder ="master/sessions";
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

    public function index(request $request) {
       $table= new cModel;
        $this->viewData['title'] = $this->title;

      
        $sqlObj = $table->defaultRecord()->orderBy($table->getKeyName());
        $data = $this->common->setPagination($sqlObj);  
        $this->viewData['niceNames'] = $table->niceNames;
        $this->viewData['pagination'] = $data['pagination'];
        $this->viewData['records'] = $data['records']; 
        view()->share($this->viewData);
        return view($this->viewFolder.'index'); 
    }
    public function create() {
         $table= new cModel;
         // $sqlObj = $table->orderBy($table->getKeyName());
        // echo "test";die();
       
        $this->viewData['title'] = 'Create '.$this->title;
         $this->viewData['niceNames'] = $table->niceNames;
        $this->viewData['formAction'] = $this->viewFolder;

        view()->share($this->viewData);
        return view($this->viewFolder.'create');
    }

      public function store(Request $request) {
        $obj = new cModel;
        $validator = $obj->validation($request);
        if ($validator->fails()) {
            return $this->restModel->validationOut($validator->messages());
            
        }
        $end = substr($request->session_name,-4);
       
        $result = substr($request->session_name, 0, 4);
        
        $session_start =  substr_replace($result,'-04-01',4, 0);
        $session_end =  substr_replace($end,'-03-31',4, 0);

       $cash =  $request->op_cash_opening;
       $pda =  $request->op_pda_opening;
      


        $obj->session_name         =   $request->session_name;
        $obj->session_start         =   $session_start;
        $obj->session_end         =   $session_end;
       

    

      if(!$obj->save())
      {
        $this->restModel->validationOut('Error While Occurs');
      }
       $lastID = $obj->session_id;
      $openingData = array('op_cash_opening'=>$cash,'op_pda_opening'=>$pda,'op_session_id'=>$lastID);
     
     $status =  $obj->multiRecord($openingData);
     if(!$status)
     {
        
        return  $this->restModel->errorOut('Error While Occurs');
     }

     return $this->restModel->successOut('Successfully Inserted');
    }

     public function edit($id) {
        $table= new cModel;
          $row=$table->defaultRecord()->where('session_id','=',$id)->first();

        //  $sqlObj = $table->orderBy($table->getKeyName());

       
        $this->viewData['title'] = 'Edit '.$this->title;
        
       
        $this->viewData['row'] = $row;
         $this->viewData['niceNames'] = $table->niceNames;
        $this->viewData['formAction'] = $this->viewFolder.$id;
        view()->share($this->viewData);
        return view($this->viewFolder.'edit');
    }
    public function update(Request $request, $id) {

        $cModel = new cModel;
        $validator = $cModel->validation($request);
        $obj=$cModel->findOrFail($id);

        if ($validator->fails()) {
           return $this->restModel->validationOut($validation(messages()));
        }
       
        $cash =  $request->op_cash_opening;
       $pda =  $request->op_pda_opening;
      
          $openingData = array('op_cash_opening'=>$cash,'op_pda_opening'=>$pda);
     if(!empty($openingData))
     {

         $status =  $obj->updateRecord($id,$openingData);
     }

      return $this->restModel->successOut('Successfully Updated');
        
    }
   
   
    

}