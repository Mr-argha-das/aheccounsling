<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Mail;
 
use \App\Model\BlogerModel;
use \App\Model\Entry\Blog_model;
use \App\Model\Sendmail as MailSendModel;
use Illuminate\Support\Facades\File;
 
use App\Http\Controllers\Controller;
use Carbon\Carbon;
class BlogerController extends Controller{

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
   

 public function blogerRegistration(Request $request){

   
      
        // return $this->url;exit;
       $BlogerModel = new BlogerModel;
       $BlogerModel->name = $request->name;
       $BlogerModel->email  = $request->email;
       $BlogerModel->password      = $request->password; 
       $BlogerModel->status      = 1;
        
       if($BlogerModel->save()){

           $slug = urlencode(base64_encode($BlogerModel->bloger_id));
           $url = $this->url.'Query/blogerverification/'.$slug;
           $mailLink = 'Dear AHEC User please verify your email to click this below link : <a href="'.$url.'">Activate Account </a>';
           MailSendModel::setupMail('AHEC Account verification ',$mailLink,$BlogerModel->email);
          
           $request->session()->flash('successFlash','Registration Done ,We send a verify mail to your registered email,to click and activate your account');
           return redirect('/signup-blog-user');
      }else{
            $request->session()->flash('errorFlash','Some Error Occured');
             return redirect('/signup-blog-user');
          }
       }

  
  public function blogerverification(Request $request,$urlSkl){

      $BlogerModel = new BlogerModel; 
      $decode = base64_decode(urldecode($urlSkl));
      $find = $BlogerModel::find($decode);
      
      if(empty($find)){
             $request->session()->flash('errorFlash','Sorry User / Account not found ');
             return redirect('/signup-blog-user');
      }

      if($find->status == 2){
             $request->session()->flash('errorFlash','Already Account Activated');
            return redirect('/signup-blog-user');
      }
      
      $find->status = 2;
      $find->save();
      $request->session()->flash('successFlash','Account Activated Successfully Please Login');
      return redirect('/sign-in');
   }

  

  public function blogerlogin(Request $request){

       $BlogerModel = new BlogerModel;
       $BlogerModel->user_email  = $request->email;
       $BlogerModel->user_password      = $request->password;
       $find= $BlogerModel::where(['email'=>$request->email,'password'=>$request->password])->first();
      
      if(empty($find)){
             $request->session()->flash('errorFlash','Invalid Login Credentials ');
             return redirect('/sign-in');
       }

      if($find->status == 1){
          $slug = urlencode(base64_encode($find->bloger_id));
           $url = $this->url.'Query/blogerverification/'.$slug;
           $mailLink = 'Dear AHEC User please verify your email to click this below link : <a href="'.$url.'">Activate Account </a>';
           MailSendModel::setupMail('AHEC Account verification ',$mailLink,$find->email);
           $request->session()->flash('successFlash','We send a verify mail to your registered email,to click and activate your account');
           return redirect('/sign-in');
       }

      $slug = urlencode(base64_encode($find->bloger_id));
      $request->session()->put('userLg',$slug);
      $request->session()->flash('successFlash','Login Successfully');
      return redirect('/account');
   }

  public function addUserBlog(Request $request){
       $encode_bloger_id = session()->get('userLg');
       $bloger_id = base64_decode(urldecode($encode_bloger_id));
       $BlogerModel = new Blog_model;
       $BlogerModel->blog_name  = $request->blog_title;
       $BlogerModel->seo_tilte  = $request->blog_seo_title;
       $BlogerModel->seo_description  = $request->blog_seo_description;
       $BlogerModel->blog_user_id      = $bloger_id;
       $BlogerModel->blog_desc      = $request->blog_description;
       $BlogerModel->blog_image      = $this->addBlogImage($request);
       $BlogerModel->blog_status      =2;
       $BlogerModel->blog_comment      =1;
       $BlogerModel->blog_date = date('Y-m-d');
       if($BlogerModel->save()){
         $request->session()->flash('successFlash','Blog Added ! <br> Your blog will be reviewed and status will be approved by our team.');
         return redirect('/account');
      }else{
 
            $request->session()->flash('errorFlash','Some Error to Save');
            return redirect('/account');
      }
   }
   public function updateUserBlog(Request $request){

        
       $encode_bloger_id = session()->get('userLg');
       $bloger_id = base64_decode(urldecode($encode_bloger_id));
       $BlogerModel = Blog_model::where(array('blog_user_id'=>$bloger_id,'blog_id'=>$request->blog_id))->first();
        if(empty($BlogerModel)){
            return redirect()->back()->with('errorFlash','No Blog found !!');  
         } 
         $BlogerModel->blog_name  = $request->blog_title;
         $BlogerModel->seo_tilte  = $request->blog_seo_title;
         $BlogerModel->seo_description  = $request->blog_seo_description;
         $BlogerModel->blog_user_id      = $bloger_id;
         $BlogerModel->blog_desc      = $request->blog_description;
       if(!empty($request->file('image')))
         $BlogerModel->blog_image      = $this->addBlogImage($request);
         $BlogerModel->blog_status      =2;
         $BlogerModel->blog_comment      =1;
         $BlogerModel->blog_date = date('Y-m-d');

       if($BlogerModel->save()){
         $request->session()->flash('successFlash','Blog Update Successfully !');
         return redirect('/account');
      }else{
 
            $request->session()->flash('errorFlash','Some Error to Save');
            return redirect('/account');
      }
   }

  public function editUserBlog($blog_id=NULL){

       $encode_bloger_id = session()->get('userLg');
       $bloger_id = base64_decode(urldecode($encode_bloger_id));
       $userBlog = Blog_model::where(array('blog_user_id'=>$bloger_id,'blog_id'=>$blog_id))->first();
        if(empty($userBlog)){
            return redirect()->back()->with('errorFlash','No Blog found !!');  
         } 
       $this->viewData['editBlog'] = $userBlog;
       $Slug= $viewLoad = 'edit-user-blog';
        $this->viewData['title'] = !empty($Slug)?$Slug:'home';
        $seoData = \App\Model\Entry\Page_model::where('menu_alias',$this->viewData['title'])->first();
      
        if(!empty($seoData)){

            $this->viewData['seoTitle'] = $seoData->menu_seo_title;
            $this->viewData['seoKeyword'] = $seoData->menu_seo_keyword;
            $this->viewData['seoDesc'] = $seoData->menu_seo_des;
        
        }else{

            $this->viewData['seoTitle'] = '';
            $this->viewData['seoKeyword'] = '';
            $this->viewData['seoDesc'] = '';
        }

         $this->viewData['canonical'] = url('').'/'.$Slug;
         
        $ListItem = array();

        $ListItem[0]['@type'] ='ListItem';
        $ListItem[0]['position'] =1;
        $ListItem[0]['name'] ='Ahecounselling';
        $ListItem[0]['item'] ='https://www.ahecounselling.com';
        $ListItem[1]['@type'] ='ListItem';
        $ListItem[1]['position'] =2;
        $ListItem[1]['name'] =$viewLoad;
        $ListItem[1]['item'] =url('').'/'.$viewLoad; 
        $this->viewData['ListItem'] = $ListItem;

        $this->viewData['fileName'] = $Slug;

        $og_tag ='';
        $og_tag .='<meta property="fb:app_id" content="1047929735969136">';
        $og_tag .='<meta property="fb:pages" content="100418585141316">';
        $og_tag .='<meta property="og:type" content="website">';
        $og_tag .='<meta property="og:title" content="'.$this->viewData['seoTitle'].' - ahecounselling.com">';
        $og_tag .='<meta property="og:description" content="'.$this->viewData['seoDesc'].' - ahecounselling.com">';
        $og_tag .='<meta property="og:url" content="'.url('').'/'.$Slug.'">';
        $og_tag .='<meta property="og:image" content="https://www.ahecounselling.com/webassets/images/jes.png">';
        $og_tag .='<meta property="og:image:alt" content="'.$viewLoad.' - ahecounselling.com">';
        $og_tag .='<meta name="twitter:card" content="summary_large_image">';
        $og_tag .='<meta property="twitter:domain" content="ahecounselling.com">';
        $og_tag .='<meta property="twitter:title" content="'.$this->viewData['seoTitle'].' - ahecounselling.com">';
        $og_tag .='<meta property="twitter:description" content="'.$this->viewData['seoDesc'].' - ahecounselling.com">';
        $og_tag .='<meta property="twitter:url" content="'.url('').'/'.$Slug.'">';
        $og_tag .='<meta property="twitter:image" content="https://www.ahecounselling.com/webassets/images/jes.png">';
        $og_tag .='<meta property="twitter:image:alt" content="'.$viewLoad  .' - ahecounselling.com">';
        $this->viewData['og_tag'] = $og_tag;
       view()->share($this->viewData);
       return view('web/edit-user-blog');
    }

    public function deleteUserBlog($blog_id){

       $encode_bloger_id = session()->get('userLg');
       $bloger_id = base64_decode(urldecode($encode_bloger_id));
       $userBlog = Blog_model::where(array('blog_user_id'=>$bloger_id,'blog_id'=>$blog_id))->first();
        if(empty($userBlog)){
            return redirect()->back()->with('errorFlash','No Blog found !!');  
         }else{
           $userBlog->delete();
           return redirect()->back()->with('successFlash', 'Blog deleted successfully');   
        }
     }
 public function addBlogImage($request){
       
     $file = $request->file('image');
      
     if(!empty($file)){
       $filenamecreated = $file->getClientOriginalName();
       $file_name =date('d_m_y_h_i_s').'.'.$file->getClientOriginalExtension();
       $uploadPath = 'assets/uploads/blogs/';
       $file->move(public_path().'/'.$uploadPath,$file_name);
       return $file_name;
     }
    return false;
  }
  
 
  public function logout(Request $req)

  {

      $request->session()->forget('userLg');

       $request->session()->flash('successFlash','Logout Success');

          return redirect('/');

  }

  
 
 public function blogerVarifyemail(Request $request){
          
      $userData =  BlogerModel::where('email',$request->email)->first();
      if(empty($userData)){
           echo json_encode(true);
       }else{
          echo json_encode(false);
        }
        
  }
  public function varifyphone(Request $request){

      if(!empty($request->session()->get('userLg'))){
         echo json_encode(true);
      }

      $userData =  BlogerModel::where('mobile',$request->modal_en_mobile)->first();
      if(empty($userData)){
          echo json_encode(false);
       }else{
           echo json_encode(true);
        }
        
  }

}



