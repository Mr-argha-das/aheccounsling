<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ProjectOverview_model;

use Mail;

class HomeController extends Controller
{
    public $viewData= [];
    public $ViewFile="home"; /*Php File*/
    public $PageFile="page";
    public $title = 'Home';
    public function __construct(){
    
         parent::__construct();
         $this->viewData['serviceArray']  =\App\Model\Entry\Service_model::makeArray();
    
    }
    public function index($Slug=NULL){


        $viewLoad = !empty($Slug)?$Slug:'home';
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
      
          if($Slug=='about-us'){

            $this->viewData['aboutusmodel']= $aboutusmodel = \App\Model\Entry\Aboutus_model::where('about_id',1)->first();
            $this->viewData['seoTitle'] = $aboutusmodel->title;
            $this->viewData['seoKeyword'] = $aboutusmodel->keyword;
            $this->viewData['seoDesc'] = $aboutusmodel->description;;
         }
         if($Slug=="home"){
           $this->viewData['canonical'] ='https://www.ahecounselling.com';
         }else{

            
           $this->viewData['canonical'] = url('').'/'.$Slug;
          }
         
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
        // return $this->viewData;
        view()->share($this->viewData);
        return view('web/'.$viewLoad);
    }
    
     public function searchQuery(Request $req){
           $searchValues = preg_split('/\s+/', $req->searchQuery, -1, PREG_SPLIT_NO_EMPTY); 
           array_unshift($searchValues,$req->searchQuery);
           
           $blog_count = \App\Model\Entry\Blog_model::where(function ($q) use ($searchValues) {
              foreach ($searchValues as $value) {
                $q->orWhere('blog_name', 'like', "%{$value}%");
              }
            })->count();
            if($blog_count>=1){
                $req->session()->flash('search_val',$req->searchQuery);
                return redirect('/blogs');
             }else{
                return redirect('/home');
             }
         }
     public function sample_project($slug=NULL){

             $this->viewData['canonical'] =url('sample-project/').'/'.$slug;
             $categrory_data = \App\Model\Entry\ProjectCategory_model::where('cat_slug','like',$slug)->first();

             $ListItem = array();

             $ListItem[0]['@type'] ='ListItem';
             $ListItem[0]['position'] =1;
             $ListItem[0]['name'] ='Ahecounselling';
             $ListItem[0]['item'] ='https://www.ahecounselling.com';

             $ListItem[1]['@type'] ='ListItem';
             $ListItem[1]['position'] =2;
             $ListItem[1]['name'] ='Sample Project';
             $ListItem[1]['item'] =url('').'/sample-project';

              $ListItem[2]['@type'] ='ListItem';
             $ListItem[2]['position'] =3;
             $ListItem[2]['name'] =$slug;
             $ListItem[2]['item'] =url('sample-project/').'/'.$slug;

           $this->viewData['ListItem'] = $ListItem;

            $this->viewData['canonical'] = url('sample-project/').'/'.$slug;

         
        
        $this->viewData['seoTitle'] = $categrory_data->seo_title;
        $this->viewData['seoKeyword'] = $categrory_data->seo_keyword;
        $this->viewData['seoDesc'] = $categrory_data->seo_description;
        $this->viewData['categrory_data'] = $categrory_data;

        $og_tag ='';
        $og_tag .='<meta property="fb:app_id" content="1047929735969136">';
        $og_tag .='<meta property="fb:pages" content="100418585141316">';
        $og_tag .='<meta property="og:type" content="website">';
        $og_tag .='<meta property="og:title" content="'.$this->viewData['seoTitle'].' - ahecounselling.com">';
        $og_tag .='<meta property="og:description" content="'.$this->viewData['seoDesc'].' - ahecounselling.com">';
        $og_tag .='<meta property="og:url" content="'.url('sample-project/').'/'.$slug.'">';
        $og_tag .='<meta property="og:image" content="https://www.ahecounselling.com/webassets/images/jes.png">';
        $og_tag .='<meta property="og:image:alt" content="'.$slug.' - ahecounselling.com">';
        $og_tag .='<meta name="twitter:card" content="summary_large_image">';
        $og_tag .='<meta property="twitter:domain" content="ahecounselling.com">';
        $og_tag .='<meta property="twitter:title" content="'.$this->viewData['seoTitle'].' - ahecounselling.com">';
        $og_tag .='<meta property="twitter:description" content="'.$this->viewData['seoDesc'].' - ahecounselling.com">';
        $og_tag .='<meta property="twitter:url" content="'.url('sample-project/').'/'.$slug.'">';
        $og_tag .='<meta property="twitter:image" content="https://www.ahecounselling.com/webassets/images/jes.png">';
        $og_tag .='<meta property="twitter:image:alt" content="'.$slug  .' - ahecounselling.com">';
        $this->viewData['og_tag'] = $og_tag;

        view()->share($this->viewData);
        return view('web/sample-project');
    }

    public function documentdemo($slug=NULL){

            $lastestProject = \App\Model\Entry\Project_model::latest()->where('slug','!=',$slug)->limit(4)->get();
            $projectdata = \App\Model\Entry\Project_model::with('category_list')->where('slug',$slug)->first();
            $this->viewData['canonical'] =url('document/').'/'.$slug;
            $ListItem = array();

            $ListItem[0]['@type'] ='ListItem';
            $ListItem[0]['position'] =1;
            $ListItem[0]['name'] ='Ahecounselling';
            $ListItem[0]['item'] ='https://www.ahecounselling.com';

            $ListItem[1]['@type'] ='ListItem';
            $ListItem[1]['position'] =2;
            $ListItem[1]['name'] ='Sample Project';
            $ListItem[1]['item'] =url('').'/sample-project';

            $ListItem[2]['@type'] ='ListItem';
            $ListItem[2]['position'] =3;
            $ListItem[2]['name'] =$slug;
            $ListItem[2]['item'] =url('document/').'/'.$slug;

            $this->viewData['ListItem'] = $ListItem;

            $project_overview = array(
                            'ip_address' => $_SERVER['REMOTE_ADDR'],
                            'project_id' => $projectdata->id,
                            );
            $project_overview_check_data = ProjectOverview_model::where($project_overview)->first();

           if(empty($project_overview_check_data)){

               $project_overview = array(
                        'ip_address' => $_SERVER['REMOTE_ADDR'],
                        'project_id' => $projectdata->id,
                        );

           ProjectOverview_model::insertIgnore($project_overview);

            if($projectdata->start_from_view==null){

                     $start_from_download = random_int(100, 999);
                     $start_from_view = random_int(1000, 9999);
                     $projectdata->start_from_view      = $start_from_view; 
                     $projectdata->start_from_download  = $start_from_download;
                     $projectdata->views                = $start_from_view;
                     $projectdata->download             = $start_from_download; 

                   }else{
                       $projectdata->views                = $projectdata->views+1;
                     }
                 $projectdata->save();
          }
         $projectdata = \App\Model\Entry\Project_model::with('category_list')->where('slug',$slug)->first();

         $this->viewData['seoTitle'] = $projectdata->seo_title;
         $this->viewData['seoKeyword'] = $projectdata->seo_keyword;
         $this->viewData['seoDesc'] = $projectdata->seo_description;
         $this->viewData['projectdata'] = $projectdata;
         $this->viewData['lastestProject'] = $lastestProject;

           $og_tag ='';
            $og_tag .='<meta property="fb:app_id" content="1047929735969136">';
            $og_tag .='<meta property="fb:pages" content="100418585141316">';
            $og_tag .='<meta property="og:type" content="website">';
            $og_tag .='<meta property="og:title" content="'.$this->viewData['seoTitle'].' - ahecounselling.com">';
            $og_tag .='<meta property="og:description" content="'.$this->viewData['seoDesc'].' - ahecounselling.com">';
            $og_tag .='<meta property="og:url" content="'.url('sample-project/').'/'.$slug.'">';
            $og_tag .='<meta property="og:image" content="https://www.ahecounselling.com/webassets/images/jes.png">';
            $og_tag .='<meta property="og:image:alt" content="'.$slug.' - ahecounselling.com">';
            $og_tag .='<meta name="twitter:card" content="summary_large_image">';
            $og_tag .='<meta property="twitter:domain" content="ahecounselling.com">';
            $og_tag .='<meta property="twitter:title" content="'.$this->viewData['seoTitle'].' - ahecounselling.com">';
            $og_tag .='<meta property="twitter:description" content="'.$this->viewData['seoDesc'].' - ahecounselling.com">';
            $og_tag .='<meta property="twitter:url" content="'.url('sample-project/').'/'.$slug.'">';
            $og_tag .='<meta property="twitter:image" content="https://www.ahecounselling.com/webassets/images/jes.png">';
            $og_tag .='<meta property="twitter:image:alt" content="'.$slug  .' - ahecounselling.com">';
            $this->viewData['og_tag'] = $og_tag;
        
        view()->share($this->viewData);
        
        return view('web/documentdemo');
    }


   public function faqpages($slug=NULL){

        $this->viewData['canonical'] =url('faq/').'/'.$slug;
        $faqcategory = \App\Model\Entry\FaqCategory_model::where('faq_slug',$slug)->first();
         // return $faqcategory;
        $ListItem = array();
        $ListItem[0]['@type'] ='ListItem';
        $ListItem[0]['position'] =1;
        $ListItem[0]['name'] ='Ahecounselling';
        $ListItem[0]['item'] ='https://www.ahecounselling.com';
        $ListItem[1]['@type'] ='ListItem';
        $ListItem[1]['position'] =2;
        $ListItem[1]['name'] =$faqcategory->name;
        $ListItem[1]['item'] =url('faq/').'/'.$slug;
        $this->viewData['ListItem'] = $ListItem;
        $this->viewData['seoTitle'] = $faqcategory->seo_title;
        $this->viewData['seoKeyword'] = $faqcategory->seo_keyword;
        $this->viewData['seoDesc'] = $faqcategory->seo_description;
        $this->viewData['faqcategory'] = $faqcategory;
        view()->share($this->viewData);
        return view('web/faqpage');
    }

   public function ordernow($slug=NULL){

        view()->share($this->viewData);
        return view('web/ordernow');
    }

    public function account($slug=NULL){
           echo 'sdf';exit;
        view()->share($this->viewData);
        return view('web/useraccount');
    }

 
}

