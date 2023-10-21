<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use File;
class UploadfileController  extends Controller
{

    public $title = 'Dashboard';

       public $viewFolder ="dashboard/";
    public $viewData=[];
    public $model=[];

    public function __construct(Request $request)
    {

        parent::__construct();

        $this->viewpPath = $this->viewFolder.'/';
        $this->viewFolder = 'admin/'.$this->viewFolder;

         //dd('yes');
    }

    public function ajaxUploadFile(Request $req)
    {
       
       return $req;

       $validator = Validator::make($req->all(), [
          'userfile' => 'required|mimes:jpeg,png,jpg,',
        ]);
        if ($validator->fails())
        {
               return $this->restModel->validationOut($validator->errors()->all());
            
        }
       
        $uploadPath = $req->input('upload_path');
        $deletePath = $req->input('delete_url');
        $dataname = $req->input('data_name');
        $title = $req->input('data_title');
        $multiple = $req->input('multiple-data');
        
        if($multiple ==2)
        {
            $dataname = $dataname.'[]';
            $title = $title.'[]';
        }

        $file = $req->file('userfile');
      
   
       $data = $imagedatta =  $file->move(public_path().'/'.$uploadPath, date("d_m_y_h_i_s_a").'.'.$file->getClientOriginalExtension());
       $fileTitle = date("d_m_y_h_i_s_a").'.'.$file->getClientOriginalExtension();
        $ext = pathinfo($fileTitle, PATHINFO_EXTENSION);  
        $fileWithOutExt = pathinfo($fileTitle, PATHINFO_FILENAME);

       if(!$data)
       {
          return $this->restModel->errorOut('File Not upload some Error');
       }
       $keyrandom = rand(11111,99999);
      $fileInputName = '<input type="hidden" name="'.$dataname.'" value="'.$fileTitle.'">';
       $fileInputTitle = '<textarea class="form-control" name="'.$title.'" >'.$fileWithOutExt.'</textarea>';
       $imglink = asset($uploadPath.'/'.$fileTitle);
       $deleteurl = $deletePath.'?filename='.$fileTitle.'&fullpath='.$uploadPath.'/'.$fileTitle;

      if($ext === 'jpeg' || $ext ==='jpg' || $ext ==='png' || $ext ==='gif')
      {
        $img = '<a href="'.$imglink.'" class="images" data-fancybox="images" data-caption="My caption">
                            <img src="'.asset($uploadPath.'/'.$fileTitle).'" class="img img-fluid img-thumbnail imgshow" style="max-height: 70px;
    max-width: 166px;" title="image"> 
                             </a>';
        
      }else{
        $img = '<a target="_blank" href="'.$imglink.'" class="docs" ><img src="https://img.icons8.com/color/48/000000/google-docs.png"/></a>';
      }
      $html = '';
      $html .= '<div class="row border-top-4 altms" id="'.$keyrandom.'">
                        <div class="col-md-2">'.$img.'
                        </div>
                        <div class="col-md-9 textareafilename">
                            '.$fileInputName.' '.$fileInputTitle.'
                        </div>
                        <div class="col-md-1 deleteurl">
                           <a href="javascript:;" data-delete-action-url="'.$deleteurl.'" data-del-id="'.$keyrandom.'" class="delbtns"><i class="fas fa-times-circle"></i></a>
                        </div>
                   </div>
               </div>';

   
       
       $data = ['fileInputName'=>$fileInputName,'fileInputTitle'=>$fileInputTitle,'img'=>$imglink,'deleteurl'=>$deleteurl,'html'=>$html];

       return $this->restModel->successOut('File Uploaded Successfully',$data);
    }


    public function deletefile(Request $req)
    {
       $Res=array('Status'=>'Error');

    
     // $fullpath = asset('/').$req->input('path').$req->input('file');
      $filepath = 'public/'.$req->input('path').$req->input('file');
      
      if(empty($filepath))
      {
                $Res['Status']='Error';
                $Res['FileName']='No File Found';
                $Res['FilePath']=$filepath;
      }
         if(!File::delete($filepath))
      {
               $Res['Status']='Error';
                $Res['FileName']='File are not deleted';
                $Res['FilePath']=$filepath;
                
      }
      $Res['Status']='Success';
      $Res['FileName']='File Deleted Successfully';
    
      $Res['FilePath']=$filepath;
      $this->JsoneOut($Res);

              
    }


      public function ajaxuploadimage(Request $req)
      {
                $Res=array('Status'=>'Error');
          $validator = Validator::make($req->all(), [
          'userfile' => 'required|max:5120',
        ]);
         
        if ($validator->fails())
        {
                $Res['Status']='Error';
                $Res['Error']=$validator->errors();
                $this->JsoneOut($Res);
        }
        $uploadPath = $req->input('path');
        $file = $req->file('userfile');
        $data = $imagedatta =  $file->move(public_path().'/'.$uploadPath, date("d_m_y_h_i_s_a").'.'.$file->getClientOriginalExtension());
         if(!$data)
       {
                $Res['Status']='Error';
                $Res['Error']='File upload Failed Try again';
                $this->JsoneOut($Res);
         
       }
                $fileTitle = date("d_m_y_h_i_s_a").'.'.$file->getClientOriginalExtension();
                $Res['Status']='Success';
                $Res['FileName']=$fileTitle;
                $this->JsoneOut($Res);
      }

     public function uploadDocs(Request $req){
          $input = $req->input();
          print_r($input);die;
     }

        public function JsoneOut($Data){
        echo json_encode($Data,JSON_PRETTY_PRINT);
        die; exit;
    }
}
