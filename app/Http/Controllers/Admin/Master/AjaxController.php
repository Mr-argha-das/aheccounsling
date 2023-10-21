<?php
namespace App\Http\Controllers\Wpanel\Master;
use Illuminate\Http\Request;
use Validator;
use \App\Model\Bank as cModel;
use App\Http\Controllers\Controller;

class AjaxController  extends Controller
{

    public $viewData=[];
    public $model=[];
    public function __construct(Request $request){
        parent::__construct();
        $this->viewpPath = $this->viewFolder.'/';
        $this->viewFolder = 'wpanel/'.$this->viewFolder.'/';
        $this->viewData['viewpPath'] = $this->viewpPath;
        $this->viewData['viewFolder'] = $this->viewFolder;
        $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI;
    }

    public function index($id) {
        echo $id;die();
     
    }
   
    public function show($id) {
        echo $id;die();
        
    }
  
    

}