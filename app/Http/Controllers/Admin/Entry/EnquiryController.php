<?php

namespace App\Http\Controllers\Admin\Entry;



use Illuminate\Http\Request;

use Validator;

use \App\Model\Website\QueryModel as WorkmModel;

use \App\Model\Login_model as loginModel;

use App\Http\Controllers\Controller;

use DB;

use File;



class EnquiryController  extends Controller{



  public $title = 'Enquiry ';

  public $viewFolder = "entry/enquiry";

  public $viewData = [];

  public $model = [];

  public $UserData = [];

  public function __construct(Request $request)

  {





    parent::__construct();

    // Add a few messages

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

    $sqlObj = $table->getDefautl()->Leftjoin('entry_service','services_id','=','en_service')->orderBy('en_id','desc'); 

    $data = $this->common->setPagination($sqlObj);



    $this->viewData['pagination'] = $data['pagination'];

    $this->viewData['records'] = $data['records'];

    view()->share($this->viewData);

    return view($this->viewFolder . 'index');

  }

    public function delete($urlSlug){

       
      $workModel  = new WorkmModel;

       $find = $workModel->find($urlSlug);


      if(!empty($find->en_attachment)){


           $uploadPath = 'assets/uploads/enquiry/';
           $filepath = public_path().'/'.$uploadPath.'/'.$find->en_attachment;
           File::delete($filepath);
       } 
       if(!empty($find->en_attachment_2)){


           $uploadPath = 'assets/uploads/enquiry/';
           $filepath = public_path().'/'.$uploadPath.'/'.$find->en_attachment_2;
           File::delete($filepath);
       }

      if(!empty($find->en_attachment_3)){


           $uploadPath = 'assets/uploads/enquiry/';
           $filepath = public_path().'/'.$uploadPath.'/'.$find->en_attachment_3;
           File::delete($filepath);
       }

       $workModel->destroy($urlSlug);

      return redirect($this->viewFolder);

    }

  

}

