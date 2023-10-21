<?php

namespace App\Http\Controllers\Admin\Entry;
use Illuminate\Http\Request;
use Validator;
use \App\Model\Entry\Home_offere_model;
use \App\Model\Entry\Payment_key_model;
use App\Http\Controllers\Controller;
use DB;
use File;
 
class HomeoffereController  extends Controller {

  public $title = 'Home Offeres';
  public $viewFolder = "entry/homeoffere";
  public $viewData = [];
  public $UserData = [];
  public $storePath = ''; 

  public function __construct(Request $request){

 
    parent::__construct();

    $this->viewpPath = $this->viewFolder . '/';
    $this->storePath  =  'admin/' . $this->viewFolder;
    $this->viewFolder = 'admin/' . $this->viewFolder . '/';
    $this->viewData['viewpPath'] = $this->viewpPath;
    $this->viewData['viewFolder'] = $this->viewFolder;
  
   }



  public function index(Request $request){

      $userData = session()->get('usersession');
     
      if(empty($userData)) {
        return redirect()->route('wpanelLogin');
       }

      $this->viewData['paymentKeyList'] = Payment_key_model::all();

      $this->viewData['title'] = $this->title;

      $editData = Home_offere_model::all();
      $this->viewData['title'] = $this->title;
      $this->viewData['editData'] = $editData;

      view()->share($this->viewData);

      return view($this->viewFolder . 'index');
  }
  
  public function updatevalue(Request $request){
       

      $ofereData = Home_offere_model::find($request->edit_id);
     
     if($request->type=='text'){

         $ofereData->value =$request->value;
         $ofereData->start_date =date('Y-m-d',strtotime($request->start_date));
         $ofereData->end_date =date('Y-m-d',strtotime($request->end_date));
    
      }elseif($request->type=='banner'){
        $file =$request->value;
        if(!empty($file)){

            $uploadPath = 'webassets/homeBanner/';
            $fileName = date('d_m_y_h_i_s').'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/'.$uploadPath,$fileName);
             $ofereData->value = $uploadPath.$fileName;
         }
         
         $ofereData->start_date =date('Y-m-d',strtotime($request->start_date));
         $ofereData->end_date =date('Y-m-d',strtotime($request->end_date));
         $ofereData->link =$request->link;

        }elseif($request->type=='mobile'){
          $file =$request->value;
          if(!empty($file)){
  
              $uploadPath = 'webassets/homeBanner/';
              $fileName = date('d_m_y_h_i_s').'.'.$file->getClientOriginalExtension();
              $file->move(public_path().'/'.$uploadPath,$fileName);
               $ofereData->value = $uploadPath.$fileName;
           }
           
           $ofereData->start_date =date('Y-m-d',strtotime($request->start_date));
           $ofereData->end_date =date('Y-m-d',strtotime($request->end_date));
           $ofereData->link =$request->link;
    
      }elseif($request->type=='image'){
        $file =$request->value;
        if(!empty($file)){

            $uploadPath = 'webassets/offere/';
            $fileName = date('d_m_y_h_i_s').'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/'.$uploadPath,$fileName);
             $ofereData->value = $uploadPath.$fileName;
         }
         
         $ofereData->start_date =date('Y-m-d',strtotime($request->start_date));
         $ofereData->end_date =date('Y-m-d',strtotime($request->end_date));
    
      }elseif($request->type=='whatsApp'){
       
         $ofereData->value =  $request->value;
        
         
      }
     
        $ofereData->save();
        return redirect()->back();
          
  }

  public function updatepaymentvalue(Request $request){


      $data = Payment_key_model::find($request->edit_id);
      if($request->defalut=='1'){  
         $data->defalut =1;
         $data->save();
         Payment_key_model::where('id','!=',$request->edit_id)->update(array('defalut'=>0));
       }else{
          $data->status =$request->status;
          $data->save();
            

       } 
       

        return redirect()->back();
          
  }
 
  
   

  public function store(Request $request)

  {

    $userData = session()->get('usersession');



    if (empty($userData)) {

      return redirect()->route('wpanelLogin');

    }

    $obj = new WorkmModel;

    $validator = $obj->validation($request);

    if ($validator->fails()) {

      return $this->restModel->validationOut($validator->messages());

    }

    $obj->y_title     = $request->y_title;

    $obj->y_url     = $request->y_url;

  

    if (!$obj->save()) {

      $this->restModel->errorOut('Error While Occur');

    }

    return $this->restModel->successOut('Successfully Saved');

  }





  public function show($id)

  {

    $userData = session()->get('usersession');



    if (empty($userData)) {

      return redirect()->route('wpanelLogin');

    }

    $table = new WorkmModel;

    $row = $table->getDefautl()->findOrFail($id);

    $this->viewData['row'] = $row;

    $this->viewData['title'] = 'View ' . $this->title;

    $this->viewData['niceNames'] = $table->niceNames;

    view()->share($this->viewData);

    return view($this->viewFolder . 'show');

  }

  public function edit($id)

  {

    $userData = session()->get('usersession');



    if (empty($userData)) {

      return redirect()->route('wpanelLogin');

    }

    $table = new WorkmModel;

    $row = $table->findOrFail($id);

    $this->viewData['row'] = $row;



    $this->viewData['title'] = 'Edit ' . $this->title;

    $this->viewData['formAction'] = $this->viewFolder . $id;

    $this->viewData['niceNames'] = $table->niceNames;

    view()->share($this->viewData);

    return view($this->viewFolder . 'edit');

  }

  public function update(Request $request, $id)

  {

    $userData = session()->get('usersession');



    if (empty($userData)) {

      return redirect()->route('wpanelLogin');

    }

    $cModel = new WorkmModel;

    $validator = $cModel->validation($request);

    $obj = $cModel->findOrFail($id);



    if ($validator->fails()) {

      return $this->restModel->validationOut($validator->messages());

    }



     $obj->y_title     = $request->y_title;

    $obj->y_url     = $request->y_url;

    if ($obj->save()) {

      return $this->restModel->successOut('Successfully Updated');

    }

  }



       public function delete($urlSlug)

    {

      $workModel  = new WorkmModel;

       $find = $workModel->find($urlSlug);

     

      $workModel->destroy($urlSlug);

     return redirect($this->viewFolder);

    }

}

