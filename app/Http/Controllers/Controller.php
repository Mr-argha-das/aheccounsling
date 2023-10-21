<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/*By AV*/
use \App\Model\Common;
use \App\Model\Restmodel;
use \App\Model\Entry\Home_offere_model;
use \App\Library\Arraydb as Arraydb;
use \App\Model\Entry\Page_model as PageModel;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*By AV*/
    public function __construct(){

        $this->viewData['whatsAppLink'] = Home_offere_model::find(5)->value;
        $this->timedate = new \App\Library\Timedate;

        $this->common = new Common;
        $this->pageModel = new PageModel;
        //$this->common->setings();
        $this->restModel= new Restmodel;
        $this->arraydb= new Arraydb;


    }
}
