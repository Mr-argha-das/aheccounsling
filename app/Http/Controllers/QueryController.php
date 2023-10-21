<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Mail;
use \App\Model\Website\QueryModel as QueryModel;
use \App\Model\UserModel as UserModel;
use \App\Model\BlogerModel as BlogerModel;
use \App\Model\Entry\Blog_model as Blog_model;
use \App\Model\Website\AffilateModel as AffilateModel;
use \App\Model\Downloaduser_model as DownloaduserModal;
use \App\Model\Website\FlModel as FlModel;
use \App\Model\Sendmail as MailSendModel;
use Illuminate\Support\Facades\File;
use App\Mail\Downloadlink as DownloadlinkMail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
class QueryController extends Controller{

  public $viewData= [];

  public $ViewFile="query"; /*Php File*/

  public $PageFile="page";

  public $title = 'Home';

  public $url;

  public function __construct(){

       parent::__construct();
       $this->viewData['serviceArray']  =\App\Model\Entry\Service_model::makeArray();
       $this->url =  ($_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http') . "://{$_SERVER['SERVER_NAME']}" . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

   }


 public function sendmail($to,$link,$filename,$user_name){


      $mail_data['subjet'] =$filename;
      $mail_data['username'] =$user_name;
      $mail_data['toemail'] =$to;
      $mail_data['link'] =$link;

    Mail::send('emails/downloadfilelink',$mail_data, function($message)  use ($mail_data) {
           $message->to($mail_data['toemail'], $mail_data['username'])->subject
              ($mail_data['subjet']);
           $message->from("info@ahecounselling.com","Ahecounselling");
       });

      
         return true;

 }

 
 
 public function datasave($slug){

     return DB::table($slug)->get();

     return $slug;
  }


 
  public function saveQuery(Request $req){

       
       $obj = new QueryModel;

       $obj->en_first_name = $req->en_first_name;

       $obj->en_last_name  = $req->en_last_name;

       $obj->en_email      = $req->en_email;

       $obj->en_mobile     = $req->en_mobile;

       $obj->phone_code     = $req->country_code;

       $obj->en_service    = $req->en_service;

       $obj->en_subject    = $req->en_subject;

       $obj->en_query      = $req->en_query;

       $obj->en_attachment= $this->uploadfile($req->file('en_attachment_1'),1);

       $obj->en_attachment_2 =$this->uploadfile($req->file('en_attachment_2'),2);
       
       $obj->en_attachment_3 =$this->uploadfile($req->file('en_attachment_3'),3);

      if(preg_match("/^\d+\.?\d*$/",$req->en_mobile) && strlen($req->en_mobile)==10){

       }else{

       $req->session()->flash('errorFlash','Mobile number atleast 10 digits and number only');

       return redirect('/');

      } 

      
       if($obj->save()){

           $subject = 'Query Request Received from '.$obj->en_email;

           $msg = '';

           $msg .= '<p>Name : '.$obj->en_first_name.' '.$obj->en_last_name.'</p>';

           $msg .= '<p>Mobile No. : '.$obj->phone_code.' '.$obj->en_mobile.'</p>';

           $msg .= '<p>Email : '.$obj->en_email.'</p>';

           $msg .= '<p>Service : '.$this->viewData['serviceArray'][$obj->en_service].'</p>';

           $msg .= '<p>Subject : '.$obj->en_subject.'</p>';

           $msg .= '<p>Query : '.$obj->en_query.'</p>';

           $this->basic_email($subject,$msg);

           $req->session()->flash('successFlash','Successfully Query Send ');
          
           return redirect('/');

       }

        $req->session()->flash('errorFlash','unable to send mail or save');

      return redirect('/');

  }   


 

    // $obj = QueryModel::where('en_email',trim($req->last_en_email))->whereYear('en_created_at', Carbon::now()->year)
    //        ->whereMonth('en_created_at', Carbon::now()->month)->with('rmuserdetails')->get();
    //   $data =array();
    // foreach ($obj as $key => $value) {

    //   $data[$key]['order_number'] =$value->rmuserdetails->rmid.'_'.date('d-m-Y',strtotime($value->en_created_at)).'_'.$value->order_number;
    //   $data[$key]['id'] =$value->en_id;
              
        
    //  }

    //        return $data;exit;

    //  if(!empty($obj)){

    //    echo json_encode($obj);
    //  }else{
         
    //      echo 'false';
    //  }


  

  public function searcholduser(Request $req){
     // ->whereYear('en_created_at', Carbon::now()->year)
     //       ->whereMonth('en_created_at', Carbon::now()->month)
      $rm_id = $req->session()->get('usersession')['rm_id'];
    
           
      $obj = QueryModel::where('en_email',trim($req->modal_en_email))->where('order_type','1')->where('rm_id',$rm_id)->with('rmuserdetails')->orderBy('en_id','asc')->get();
      $data =array();
     foreach ($obj as $key => $value) {
           
       $data[$key]['order_number'] =$value->rmuserdetails->rmid.'-'.date('d-m-y',strtotime($value->en_created_at)).'_'.sprintf("%02d", $value->order_number);
       $data[$key]['id'] =$value->en_id;
      }
    if(!empty($data)){

       echo json_encode($data);
     }else{
         
         echo 'false';
     }


  }

   public function searcholduserdetails(Request $req){

     $obj = QueryModel::find($req->pre_order_id);

     if(!empty($obj)){

       echo json_encode($obj);
     }else{
         
         echo 'false';
     }


  }
  public function saveQueryModal(Request $req){
           
     $rmuserdata = \App\Model\Entry\RegisterMember_model::findOrFail($req->rm_id);
     if($req->user_type==1 || $req->order_type==1){
           $order_number = QueryModel::
             whereYear('en_created_at', Carbon::now()->year)
            ->where('rm_id',$req->rm_id)
            ->groupBy('order_number')
            ->whereMonth('en_created_at', Carbon::now()->month)
            ->get()->count();
            $order_number =$order_number+1;
            $order_date = date('d-m-y');
       }else{
            $per_order_data = QueryModel::find($req->pre_order_id);
            $order_number = $per_order_data->order_number;
            $order_date = date('d-m-y',strtotime($per_order_data->en_created_at));
       }
         $userData =  UserModel::where('user_email',$req->modal_en_email)->first();
        
         if(empty($userData)){
               $objuser = new UserModel;
               $objuser->user_name = $req->modal_en_first_name.' '.$req->modal_en_last_name;
               $objuser->user_email = $req->modal_en_email;
               $objuser->user_password = $req->modal_en_mobile;
               $objuser->mobile     = $req->modal_en_mobile;
               $objuser->phone_code     = $req->country_code;
               $objuser->user_status = 2;
               $objuser->rm_id = $req->rm_id;
               $objuser->save();
               $slug = urlencode(base64_encode($objuser->user_id));
               $req->session()->put('userLg',$slug);
          } 
         

       $obj = new QueryModel;

       $obj->en_first_name = $req->modal_en_first_name;

       $obj->en_last_name  = $req->modal_en_last_name;

       $obj->en_email      = $req->modal_en_email;

       $obj->en_mobile     = $req->modal_en_mobile;

       $obj->phone_code     = $req->country_code;

       $obj->en_service    = $req->en_service;

       $obj->en_subject    = $req->modal_en_subject;

       $obj->en_query      = $req->modal_en_query;

       $obj->rm_id      = $req->rm_id;
       
       $obj->user_type      = $req->user_type;
       $obj->order_type      = $req->order_type;

       $obj->order_number      = $order_number;

       $obj->payment_type      = $req->payment_type;

       $obj->module_name      = $req->modal_en_module_name;
       
       $obj->en_attachment= $this->uploadfile($req->file('modal_en_queryen_attachment_1'),'_first_doc');

       $obj->en_attachment_2 =$this->uploadfile($req->file('modal_en_queryen_attachment_2'),'_secound_doc');
       
       $obj->en_attachment_3 =$this->uploadfile($req->file('modal_en_queryen_attachment_3'),'_third_doc');
       
       $obj->Screenshot =$this->uploadfile($req->file('input'),'payment_image');

      if($obj->save()){
             
       $servicedata = \App\Model\Entry\Service_model::findOrFail($req->en_service); 
       $mail_data = array();
       $mail_data['username'] ='Dear '.$obj->en_first_name.' '.$obj->en_last_name;
       $mail_data['toemail'] =$obj->en_email;
       $mail_data['user_type'] =$obj->user_type;
       $mail_data['subject'] =$servicedata->services_name;
       $mail_data['tormemail'] =$rmuserdata->email;
       $mail_data['user_type'] =$req->user_type;
       $mail_data['tormname'] =$rmuserdata->name;
       $mail_data['en_attachment'] =$obj->en_attachment;
       $mail_data['en_attachment_2'] =$obj->en_attachment_2;
       $mail_data['en_attachment_3'] =$obj->en_attachment_3;
       $mail_data['Screenshot'] =$obj->Screenshot;
       $mail_data['booking_user_name'] =$obj->en_first_name.' '.$obj->en_last_name;
       $mail_data['booking_user_email'] =$obj->en_email;
       $mail_data['booking_user_phone'] =$obj->phone_code.' '.$obj->en_mobile;
       $mail_data['password'] =$obj->en_mobile;
       $mail_data['booking_user_message'] =$obj->en_query;
       $mail_data['booking_user_subject'] =$obj->en_subject;

       $mail_data['order_number'] =$rmuserdata->rmid.'-'.$order_date.'_'.sprintf("%02d", $obj->order_number);

       $mail_data['booking_user_paymnet'] =$mail_data['order_number'].' | '.$rmuserdata->symbol.$obj->en_first_name.'_'.$obj->en_subject.'_'.$obj->module_name;
       // $mail_data['booking_user_paymnet'] =$mail_data['order_number'].' | '.$req->payment_type.' Confirm for';
       $mail_data['table_id'] =$obj->en_id;
       $mail_data['user_mail_subject'] =$rmuserdata->symbol.$obj->en_first_name.'_'.$obj->en_subject.'_'.$obj->module_name.'|'.$req->payment_type.' Confirm for';

       $this->sendmailrmuser($mail_data);
         
        $req->session()->flash('successFlash','Successfully Submitted ');
        return redirect('/account');

      }else{

         return redirect('/ordernow');
        }

      exit;

  }   

  public function sendmailrmuser($mail_data){
     
      if($mail_data['user_type']==1){

       Mail::send('emails/login',$mail_data, function($message)  use ($mail_data) {
           $message->to($mail_data['toemail'], $mail_data['username'])->subject
              ("Ahecounselling login details");
           $message->from("info@ahecounselling.com","Ahecounselling");
       });
      } 
     Mail::send('emails/userreview',$mail_data, function($message)  use ($mail_data) {
           $message->to($mail_data['toemail'], $mail_data['username'])->subject
              ($mail_data['user_mail_subject']);
           $message->from("info@ahecounselling.com","Ahecounselling");
       });

     Mail::send('emails/rmiduser',$mail_data, function($message)  use ($mail_data) {
        
         $message->to($mail_data['tormemail'], $mail_data['tormname'])->subject
            ($mail_data['booking_user_paymnet']);

          
          if(!empty($mail_data['en_attachment'])){
           $message->attach(asset('assets/uploads/enquiry/'.$mail_data['en_attachment']));
          }

          if(!empty($mail_data['en_attachment_2'])){
           $message->attach(asset('assets/uploads/enquiry/'.$mail_data['en_attachment_2']));
          }

         if(!empty($mail_data['en_attachment_3'])){
           $message->attach(asset('assets/uploads/enquiry/'.$mail_data['en_attachment_3']));
          }
         if(!empty($mail_data['Screenshot'])){
           $message->attach(asset('assets/uploads/enquiry/'.$mail_data['Screenshot']));
          }
         $message->cc("assignmenthelpandecounselling@outlook.com", "Ahecounselling");
         $message->from("info@ahecounselling.com","Ahecounselling");
      });
 
     return true;
   }

  public function confirmorder($id){

     $obj = QueryModel::with('rmuserdetails','services')->where('email_status',0)->find($id);
     if(empty($obj)){
        return redirect('/');
     }
     // return $obj;exit;
     $mail_data = array();
     $mail_data['subject'] =$obj->rmuserdetails->symbol.$obj->en_first_name.'_'.$obj->en_subject.'_'.$obj->module_name;
     $mail_data['username'] ='Dear '.$obj->en_first_name.' '.$obj->en_last_name;
     $mail_data['toemail'] =$obj->en_email;
     $mail_data['user_type'] =$obj->user_type;
     $mail_data['title'] =$obj->services->services_name;
     $mail_data['payment_type'] =$obj->payment_type;
     $mail_data['order_number'] =$obj->rmuserdetails->rmid.'-'.date('d-m-y').'-'.sprintf("%02d", $obj->order_number);
     
     Mail::send('emails/thankuuser',$mail_data, function($message)  use ($mail_data) {
     $message->to($mail_data['toemail'], $mail_data['username'])->subject
          ($mail_data['subject']);
      $message->attach(asset('assets/pdf/AHEC_Terms_and_Conditions.pdf'));
      $message->attach(asset('assets/pdf/AHEC_Privacy_Policy.pdf'));
      $message->attach(asset('assets/pdf/AHEC_Refund_and_Return.pdf'));
      $message->from("info@ahecounselling.com","Ahecounselling");
     });
        
     $obj->email_status =1;
    if($obj->en_attachment!=0){
     unlink('assets/uploads/enquiry/'.$obj->en_attachment);
    }
    if($obj->en_attachment_2!=0){
     unlink('assets/uploads/enquiry/'.$obj->en_attachment_2);
    }
    if($obj->en_attachment_3!=0){
     unlink('assets/uploads/enquiry/'.$obj->en_attachment_3);
    }
    $obj->en_attachment=0;
    $obj->en_attachment_2=0;
    $obj->en_attachment_3=0;
     $obj->save();
     return redirect('/');

     
  }
  


    public function uploadfile($file,$num=null){

         
          if(!empty($file)){
          $uploadPath = 'assets/uploads/enquiry/';
          $file->move(public_path().'/'.$uploadPath, $num.date('d_m_y_h_i_s').'.'.$file->getClientOriginalExtension());
          $filenamecreated = $num.date('d_m_y_h_i_s').'.'.$file->getClientOriginalExtension();
          return $filenamecreated;
         }
         return false;
     }
 
   public function basic_email($subject,$messaghe) {

         $headers  = 'MIME-Version: 1.0' . "\r\n";

         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         $headers = "From: info@ahecounselling.com" . "\r\n"."X-Mailer: php";;
         $to = "info@ahecounselling.com";
          mail($to,$subject,$messaghe,$headers);
     }

  public function attlicateform(Request $req){

       $obj = new AffilateModel;

       $obj->af_name = $req->al_name;

       $obj->af_email  = $req->al_email;

       $obj->af_address      = $req->al_address;

       $obj->af_mobile      = $req->al_mobile;
       $obj->country_code      = $req->fl_country_code;

           $images=array();
           if($files=$req->file('multi_file')){

              $path = public_path().'/assets/'.preg_replace("/\s+/", "", $req->al_name).'_'.date('d-M-Y');
              if (! File::exists($path)) {
                File::makeDirectory($path);
              } 
               $uploadPath = public_path().'/assets/'.preg_replace("/\s+/", "", $req->al_name).'_'.date('d-M-Y').'/';
               $obj->folder_path ='/assets/'.preg_replace("/\s+/", "", $req->al_name).'_'.date('d-M-Y').'/'; 

               $num=1;
              foreach($files as $file){
                  $file->move($uploadPath, $num.'.'.$file->getClientOriginalExtension());
                   $images[]=$num.'.'.$file->getClientOriginalExtension();
                 $num++;
              }
            
              $obj->af_file = json_encode($images);
             

          }else{

              $obj->af_file = null; 
              $obj->folder_path = null; 
           }

     

        if($obj->save())

       {

          

          $req->session()->flash('successFlash','Successfully Submitted ');

          return redirect('/affiliates-terms');

       }

        $req->session()->flash('errorFlash','unable to send mail or save');

      return redirect('/affiliates-terms');

 }

 

 public function senddownloadlink(Request $req){

           $project_overview = array(
                             'email' => $req->download_email,
                             );


           $downloadcound = DownloaduserModal::where($project_overview)->count();

           if($downloadcound >= 2){
               $req->session()->flash('errorFlash','The limit is exceeded please contact +91 9664182955');
               return redirect()->back();
             }
           
          
           $obj = array();
           $obj['name'] = $req->download_first_name.'  '.$req->download_last_name;
           $obj['email']  = $req->download_email;
           $obj['project_id']  = $req->download_project_id;
           $obj['phone']      =  $req->download_mobile;
           $obj['code']      =   $req->download_country_code;
            DownloaduserModal::insertIgnore($obj);
            $projectdata = \App\Model\Entry\Project_model::with('category_list')->where('id',$req->download_project_id)->first();
            $projectdata->download  = $projectdata->download+1;
            $projectdata->save();

            $this->sendmail($req->download_email,$projectdata->url,$projectdata->title,$req->download_first_name.'  '.$req->download_last_name);
            
            $req->session()->flash('successFlash_link','Click here to download!');
            return redirect()->back();
          
  }

 

   public function affuploadfile($request)

  {

      $file = $request->file('idproof');

      if(!empty($file))

      {

           $filenamecreated = $file->getClientOriginalName();

       $destinationPath = 'public/assets/uploads/enquiry/';

        $file->move($destinationPath,$file->getClientOriginalName());

      return $filenamecreated;

      }

      return false;

     

  }

  

   public function flform(Request $req){

       $obj = new FlModel;

       $obj->af_name = $req->fl_name;

       $obj->af_email  = $req->fl_email;

       $obj->af_address      = $req->fl_address;

       $obj->af_mobile      = $req->fl_mobile;

       $obj->bank_name      = $req->bank_name;

       $obj->bank_no      = $req->bank_no;

       $obj->bank_ifsc      = $req->bank_ifsc;

       $obj->bank_branch      = $req->bank_branch;
       
       $obj->fl_alternate_number      = $req->fl_alternate_number;
       
       $obj->aadhar_number      = $req->aadhar_number;
       
       $obj->pan_number      = $req->pan_number;
       $obj->country_code      = $req->fl_country_code;



       $obj->af_file = $this->uploadfilefl($req->file('idproof'),1);

       $obj->doc_2 = $this->uploadfilefl($req->file('pan_number_doc'),2);

        
     
        if($obj->save()){

          $req->session()->flash('successFlash','Successfully Submitted ');

          return redirect('/FL-Registration');
        }

        $req->session()->flash('errorFlash','unable to send mail or save');

       return redirect('/FL-Registration');

 }


      public function uploadfilefl($file,$num=null){

       
            if(!empty($file)){

            $uploadPath = 'assets/uploads/flregistration/';
            $file->move(public_path().'/'.$uploadPath, date('d_m_y_h_i_s').$num.'.'.$file->getClientOriginalExtension());
            $filenamecreated = date('d_m_y_h_i_s').$num.'.'.$file->getClientOriginalExtension();
            return $filenamecreated;
           }
           return false;
       }
  

  public function registration(Request $req)

  {

    

      $UserModel = new UserModel;

       $UserModel->user_name = $req->name;

       $UserModel->user_email  = $req->email;

       $UserModel->user_password      = $req->password;

       $UserModel->user_status      = 1;

       $find= $UserModel::where('user_email',$req->email)->first();

       if(!empty($find)){

           

      

       if($find->user_status == 1)

       {

           $slug = urlencode(base64_encode($find->user_id));

           $url = $this->url.'Query/verification/'.$slug;

           $mailLink = 'Dear AHEC User please verify your email to click this below link : <a href="'.$url.'">Activate Account </a>';

           MailSendModel::setupMail('AHEC Account verification ',$mailLink,$find->user_email);

           $req->session()->flash('successFlash','Already Registered ,We send a verify mail to your registered email,to click and activate your account');

          return redirect('/sign-up');

       }

       if($find->user_status == 2)

       {

             $req->session()->flash('errorFlash','Already Registered Please Login');

            return redirect('/sign-up');

       }

       }

       if($UserModel->save())

       {

             $slug = urlencode(base64_encode($UserModel->user_id));

           $url = $this->url.'Query/verification/'.$slug;

           $mailLink = 'Dear AHEC User please verify your email to click this below link : <a href="'.$url.'">Activate Account </a>';

           

           MailSendModel::setupMail('AHEC Account verification ',$mailLink,$UserModel->user_email);

          $req->session()->flash('successFlash','Registration Done ,We send a verify mail to your registered email,to click and activate your account');

          return redirect('/sign-up');

       }else{

            $req->session()->flash('errorFlash','Some Error Occured');

            return redirect('/sign-up');

       }

  }
public function blogerRegistration(Request $req){
     
       $UserModel = new UserModel;
       $UserModel->user_name = $req->name;

       $UserModel->user_email  = $req->email;

       $UserModel->user_password      = $req->password;

       $UserModel->user_status      = 1;

       $find= $UserModel::where('user_email',$req->email)->first();

       if(!empty($find)){

           

      

       if($find->user_status == 1)

       {

           $slug = urlencode(base64_encode($find->user_id));

           $url = $this->url.'Query/verification/'.$slug;

           $mailLink = 'Dear AHEC User please verify your email to click this below link : <a href="'.$url.'">Activate Account </a>';

          

            MailSendModel::setupMail('AHEC Account verification ',$mailLink,$find->user_email);

          $req->session()->flash('successFlash','Already Registered ,We send a verify mail to your registered email,to click and activate your account');

          return redirect('/sign-up');

       }

       if($find->user_status == 2)

       {

             $req->session()->flash('errorFlash','Already Registered Please Login');

            return redirect('/sign-up');

       }

       }

       if($UserModel->save())

       {

             $slug = urlencode(base64_encode($UserModel->user_id));

           $url = $this->url.'Query/verification/'.$slug;

           $mailLink = 'Dear AHEC User please verify your email to click this below link : <a href="'.$url.'">Activate Account </a>';

           

           MailSendModel::setupMail('AHEC Account verification ',$mailLink,$UserModel->user_email);

          $req->session()->flash('successFlash','Registration Done ,We send a verify mail to your registered email,to click and activate your account');

          return redirect('/sign-up');

       }else{

            $req->session()->flash('errorFlash','Some Error Occured');

            return redirect('/sign-up');

       }

  }

  

  public function verification(Request $req,$urlSkl)

  {

        $UserModel = new UserModel;

      $decode = base64_decode(urldecode($urlSkl));

      $find = $UserModel::find($decode);

      if(empty($find))

      {

             $req->session()->flash('errorFlash','Sorry User / Account not found ');

            return redirect('/sign-up');

      }

      if($find->user_status == 2)

      {

             $req->session()->flash('errorFlash','Already Account Activated');

            return redirect('/sign-up');

      }

      $find->user_status = 2;

      $find->save();

        $req->session()->flash('successFlash','Account Activated Successfully Please Login');

          return redirect('/sign-in');

  }

  

  public function login(Request $req)

  {

       $UserModel = new UserModel;

       $UserModel->user_email  = $req->email;

       $UserModel->user_password      = $req->password;

       $find= $UserModel::where(['user_email'=>$req->email,'user_password'=>$req->password])->first();

       if(empty($find))

      {

             $req->session()->flash('errorFlash','Invalid Login Credentials ');

            return redirect('/sign-in');

      }

       if($find->user_status == 1)

      {

          $slug = urlencode(base64_encode($find->user_id));

           $url = $this->url.'Query/verification/'.$slug;

           $mailLink = 'Dear AHEC User please verify your email to click this below link : <a href="'.$url.'">Activate Account </a>';
         
           MailSendModel::setupMail('AHEC Account verification ',$mailLink,$find->user_email);

          $req->session()->flash('successFlash','We send a verify mail to your registered email,to click and activate your account');

          return redirect('/sign-in');

      }

      $slug = urlencode(base64_encode($find->user_id));
      $req->session()->put('userLg',$slug);

       $req->session()->flash('successFlash','Login Successfully');

          return redirect('/account');

  }

  

  public function addblog(Request $req)

  {

      









       $UserModel = new Blog_model;

       $UserModel->blog_name  = $req->title;

       $UserModel->blog_user_id      = $req->userid;

       $UserModel->blog_desc      = $req->content;

       $UserModel->blog_image      = $this->ddss($req);;;

       $UserModel->blog_status      =2;

       $UserModel->blog_comment      =1;

       $UserModel->blog_type      =$req->blog_type;

       $UserModel->blog_date = date('Y-m-d');

       if($UserModel->save())

       {

           $req->session()->flash('successFlash','We send a verify mail to your registered email,to click and activate your account');

          return redirect('/account');

       }else

       {

              $req->session()->flash('errorFlash','Some Error to Save');

            return redirect('/account');

       }

        

  }

  

    public function ddss($request)

  {

      $file = $request->file('image');

      if(!empty($file))

      {

           $filenamecreated = $file->getClientOriginalName();

       $destinationPath = 'public/assets/uploads/blogs/';

        $file->move($destinationPath,$file->getClientOriginalName());

      return $filenamecreated;

      }

      return false;

     

  }

  public function logout(Request $req)

  {

      $req->session()->forget('userLg');

       $req->session()->flash('successFlash','Logout Success');

          return redirect('/');

  }

  

  

  public function newsletter(Request $req)

  {

           $mailLink = 'One new mail id received for newsletter : '.$req->email;

          

            MailSendModel::setupMail('AHEC Recevied One Newsletter Subscripton User mail '.$req->email,$mailLink,'info@ahecounselling.com');

          $req->session()->flash('successFlash','Success saved your mail for newsletter');

          return redirect('/');

  }

 public function varifyemail(Request $request){
         
      $rm_id = $request->session()->get('usersession')['rm_id'];
      $userData =  UserModel::where('user_email',$request->modal_en_email)->where('rm_id',$rm_id)->first();
      if(empty($userData)){
           echo json_encode(true);
       }else{
          echo json_encode(false);
        }
   }
  public function varifyphone(Request $request){

      $rm_id = $request->session()->get('usersession')['rm_id'];
      $userData =  UserModel::where('mobile',$request->modal_en_mobile)->where('rm_id',$rm_id)->first();
      if(empty($userData)){
           echo json_encode(true);
       }else{
          echo json_encode(false);
        }
        
  }

}



