<?php
namespace App\Http\Controllers\Wpanel;
use Illuminate\Http\Request;
use Validator;
//use \App\Model\Activity as actModel;
use App\Http\Controllers\Controller;

class AjaxController  extends Controller
{

    public function __construct(Request $request){
        parent::__construct();
        $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI;
    }
  
    public function searchdata($id){
        echo $id.'Date is ';die();
     }
}