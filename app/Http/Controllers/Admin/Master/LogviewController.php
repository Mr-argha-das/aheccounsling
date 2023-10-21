<?php
namespace App\Http\Controllers\Wpanel\Master;
use Illuminate\Http\Request;
use Validator;
use DB;

use \App\Model\Log_model as logModel;
use App\Http\Controllers\Controller;

class LogviewController  extends Controller
{

    public $title = 'Log View';
    public $viewFolder ="master/logview";
     
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
        $this->viewData['logType'] = \App\Library\Arraydb::$logType;
    }

    public function index(Request $request) {
       $table= new logModel;
       // $option = [];
 
         $loginData= $this->common->getUser();
         $sessionID = $loginData['sessionId'];
        $sqlObj = $table->join('users','id','=','log_user_id')->where('log_session_id','=',$loginData['sessionId'])->orderBy($table->getKeyName(),'desc');
/*
         if(!empty($request->query('filter_vehicle_party_name')))
        {
            $sqlObj->where('vehicle_party_name',$request->query('filter_vehicle_party_name'));
        }
        if(!empty($request->query('filter_vehicle_reg')))
        {
            $sqlObj->where('vehicle_reg','like','%'.$request->query('filter_vehicle_reg').'%');
          // $sqlObj->where('vehicle_reg','like','%'.$$request->query('filter_vehicle_reg').'%');
        }
        if(!empty($request->query('filter_vehicle_engine')))
        {
             $sqlObj->where('vehicle_engine','like','%'.$request->query('filter_vehicle_engine').'%');
        }
*/

        $data = $this->common->setPagination($sqlObj);
        $this->viewData['pagination'] = $data['pagination'];
        $this->viewData['title'] = $this->title;
        $this->viewData['records'] = $data['records'];
        view()->share($this->viewData);
        return view($this->viewFolder.'index');
    }

    

}