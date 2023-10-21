<?php

namespace App\Http\Controllers\Admin\Entry;
use Illuminate\Http\Request;
use Validator;
use \App\Model\Entry\Project_model as WorkmModel;
use \App\Model\Login_model as loginModel;
use App\Http\Controllers\Controller;
use DB;
use File;
use \App\Model\Login_model as login_model;



class ProjectviewController  extends Controller{

  public $title = 'Project-demo ';

  public $viewFolder = "entry/project";

  public $viewData = [];

  public $model = [];

  public $UserData = [];

  public $storePath = '';
  
  public function __construct(Request $request){

    parent::__construct();

    // Add a few messages
    $this->storePath  =  'admin/' . $this->viewFolder;
    $this->viewpPath = $this->viewFolder . '/';
    $this->viewFolder = 'admin/' . $this->viewFolder . '/';
    $this->viewData['viewpPath'] = $this->viewpPath;
    $this->viewData['viewFolder'] = $this->viewFolder;

    $this->viewData['statusDropdown'] = \App\Library\Arraydb::$statusAI; //tableToArray('party_id','party_name','sy_master_party','select');
   
    $this->viewData['category'] = \App\Model\Entry\ProjectCategory_model::makeArray(); //tableToArray('party_id','party_name','sy_master_party','select');
   
    $this->arraydb = new \App\Library\Arraydb;

    $this->WorkmModel = new WorkmModel;

    $this->viewData['timedate'] = $this->timedate;

  }



  public function index(Request $request){

    $userData = session()->get('usersession');
    $ticketId = $request->query('id');
    
     if (empty($userData)) {
         return redirect()->route('wpanelLogin');
     }

    $table = new WorkmModel;

    $this->viewData['title'] = $this->title;

    $sqlObj = $table->getDefautl()->with('category_list')->orderBy('id','desc'); 

    $data = $this->common->setPagination($sqlObj);
    
    $this->viewData['pagination'] = $data['pagination'];

    $this->viewData['records'] = $data['records'];

    view()->share($this->viewData);

    return view($this->viewFolder . 'index');

  }

  public function create(){

    $userData = session()->get('usersession');
    if (empty($userData)) {
      return redirect()->route('wpanelLogin');
    }

    $table = new WorkmModel;

    $sqlObj = $table->orderBy($table->getKeyName());

    $this->viewData['niceNames'] = $table->niceNames;

    $this->viewData['title'] = 'Add ' . $this->title;

    $this->viewData['formAction'] = $this->storePath;

    view()->share($this->viewData);

    return view($this->viewFolder . 'create');

  }
     public function downloadlink($fileName,$drop_box_api){

        $parameters = array('path' => '/project/'.$fileName);
        $headers = array('Authorization: Bearer '.$drop_box_api,
                         'Content-Type: application/json');
        $curlOptions = array(
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($parameters),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_VERBOSE => true
            );
        $ch = curl_init('https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings');
        curl_setopt_array($ch, $curlOptions);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
 
        $return_url =   $data['url'];


        
        return  substr_replace($return_url,"1",-1);

      }

    public  function savefile($file,$filename,$drop_box_api) {
        
        // $drop_box_api ='3KBLzVdPb_gAAAAAAAAAATp7D6b-h-i7WCKhMVRCtqlkJjc4kB7N9qjVVB8DlQ6g';
        $path = $filename;
        $fp = fopen($file['tmp_name'], 'rb');
        $size = $file['size'];
        $cheaders = array('Authorization: Bearer '.$drop_box_api,
         'Content-Type: application/octet-stream',
         'Dropbox-API-Arg: {"path":"/project/'.$path.'", "mode":"add"}');
        $ch = curl_init('https://content.dropboxapi.com/2/files/upload');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $cheaders);
        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_INFILE, $fp);
        curl_setopt($ch, CURLOPT_INFILESIZE, $size);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        fclose($fp);
         return json_decode($response, true);

     }

  public function store(Request $request){
   

    $drop_box_api = \App\Model\Entry\ProjectCategory_model::findOrFail($request->project_categroy_id)->drop_box_api;

    $userData = session()->get('usersession');
    if (empty($userData)) {
      return redirect()->route('wpanelLogin');
    }

    $obj = new WorkmModel;
   
    $validator = $obj->validation($request);
    if ($validator->fails()) {
      return $this->restModel->validationOut($validator->messages());
    }
    
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-',trim($request->title))));

    $file = $request->file('full_project_file');
    $filename =date('d_M_Y_h_i_s').'.'.$file->getClientOriginalExtension();
    $this->savefile($_FILES['full_project_file'],$filename,$drop_box_api);
    $url = $this->downloadlink($filename,$drop_box_api);
    
   
    $obj->title     = $request->title;
    
    $obj->no_of_page     = $request->no_of_page;

    $obj->project_categroy_id = $request->project_categroy_id;
    
    $obj->word_count     = $request->word_count;
    
    $obj->description     = $request->description;
    
    $obj->seo_keyword     = $request->seo_keyword;
    
    $obj->seo_title     = $request->seo_title;
    
    $obj->seo_description     = $request->seo_description;
    
    $obj->thub_img     = $request->thub_img;
    
    $obj->img_1     = $request->img_1;
    
    $obj->img_2     = $request->img_2;

    $obj->url = $url;

    $obj->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
  
    $obj->file_name = $filename;

    if (!$obj->save()) {

      $this->restModel->errorOut('Error While Occur');

    }

    return $this->restModel->successOut('Successfully Saved');

  }





  public function show($id){

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

  public function edit($id){
    

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


  public function deletedropboxfile($fileName,$drop_box_api){

        $parameters = array('path' => '/project/'.$fileName);
        $headers = array('Authorization: Bearer '.$drop_box_api,
                         'Content-Type: application/json');
        $curlOptions = array(
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($parameters),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_VERBOSE => true
            );
        $ch = curl_init('https://api.dropboxapi.com/2/files/delete_v2');
        curl_setopt_array($ch, $curlOptions);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
      }

  public function update(Request $request, $id){

  
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


    $file = $request->file('full_project_file');
     if(!empty($file)){
       
        if($request->project_categroy_id_old==$request->project_categroy_id){
            $drop_box_api = \App\Model\Entry\ProjectCategory_model::findOrFail($request->project_categroy_id)->drop_box_api;
            $this->deletedropboxfile($obj->file_name,$drop_box_api);
            $obj->file_name = $filename =date('d_M_Y_h_i_s').'.'.$file->getClientOriginalExtension();
            $this->savefile($_FILES['full_project_file'],$filename,$drop_box_api);
            $obj->url = $this->downloadlink($filename,$drop_box_api); 
      
        }else{

            $drop_box_api_old = \App\Model\Entry\ProjectCategory_model::findOrFail($request->project_categroy_id_old)->drop_box_api;
            $this->deletedropboxfile($obj->file_name,$drop_box_api_old); 
            $drop_box_api = \App\Model\Entry\ProjectCategory_model::findOrFail($request->project_categroy_id)->drop_box_api;
            $obj->file_name = $filename =date('d_M_Y_h_i_s').'.'.$file->getClientOriginalExtension();
            $this->savefile($_FILES['full_project_file'],$filename,$drop_box_api);
            $obj->url = $this->downloadlink($filename,$drop_box_api); 
      }

    }


    $obj->title     = $request->title;
    $obj->no_of_page     = $request->no_of_page;
    $obj->project_categroy_id     = $request->project_categroy_id;
    $obj->word_count     = $request->word_count;
    $obj->description     = $request->description;
    $obj->seo_title     = $request->seo_title;
    $obj->seo_keyword     = $request->seo_keyword;
    $obj->seo_description     = $request->seo_description;
    $obj->thub_img     = $request->thub_img;
    $obj->img_1     = $request->img_1;
    $obj->img_2     = $request->img_2;
    $obj->slug     = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-',trim($request->title))));

       
    if ($obj->save()) {
      return $this->restModel->successOut('Successfully Updated');

    }

  }



       public function delete($urlSlug){

       
       $workModel  = new WorkmModel;
       $find = $workModel->find($urlSlug);

       if(!empty($find->thub_img)){
        $filepath = 'public/assets/uploads/projectdoc/'.$find->thub_img;
        File::delete($filepath);
       }

      if(!empty($find->img_1)){
        $filepath = 'public/assets/uploads/projectdoc/'.$find->img_1;
        File::delete($filepath);
      }
    
     if(!empty($find->img_2)){
        $filepath = 'public/assets/uploads/projectdoc/'.$find->img_2;
        File::delete($filepath);
      }

      $workModel->destroy($urlSlug);

     return redirect($this->viewFolder);

    }

}

