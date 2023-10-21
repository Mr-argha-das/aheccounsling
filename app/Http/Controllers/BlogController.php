<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Model\Entry\Blog_model as blogModel;
use \App\Model\Entry\Service_model as serviceModel;

use App\Http\Controllers\Controller;



class BlogController extends Controller{

    public $viewData= [];

    public $ViewFile="home"; /*Php File*/

    public $PageFile="page";

    public $title = 'Home';

    public function __construct(){
          parent::__construct();
     }

    public function blogpage($name=NULL)

    {

        $slug =  str_replace("-"," ",$name);
        $findRow = blogModel::where('blog_name',$slug)->first();
         if(empty($findRow)){
             return redirect()->route('home');
             exit;
       }

        $ListItem = array();
        $ListItem[0]['@type'] ='ListItem';
        $ListItem[0]['position'] =1;
        $ListItem[0]['name'] ='Ahecounselling';
        $ListItem[0]['item'] ='https://www.ahecounselling.com';
        $ListItem[1]['@type'] ='ListItem';
        $ListItem[1]['position'] =2;
        $ListItem[1]['name'] ='Blog';
        $ListItem[1]['item'] =url('').'/blogs';
        $ListItem[2]['@type'] ='ListItem';
        $ListItem[2]['position'] =3;
        $ListItem[2]['name'] =$slug;
        $ListItem[2]['item'] =url('blog/').'/'.$name;

        $this->viewData['ListItem'] = $ListItem;
        $this->viewData['canonical'] = url('blog/').'/'.$name;   

        if(empty($findRow)){
            $this->viewData['title'] = 'Page not found';
            view()->share($this->viewData);
            return view('pagenotfound');

        }

        $this->viewData['seo']= true;
        $this->viewData['row']= $findRow;
        $this->viewData['title'] = !empty($slug)?$slug:'Home';
        if(!empty($findRow)){
            $this->viewData['seoTitle'] = $findRow->seo_tilte;
            $this->viewData['seoKeyword'] = $findRow->seo_keyword;
            $this->viewData['seoDesc'] = $findRow->seo_description;
         }
       
      
        $og_tag ='';
        $og_tag .='<meta property="fb:app_id" content="1047929735969136">';
        $og_tag .='<meta property="fb:pages" content="100418585141316">';
        $og_tag .='<meta property="og:type" content="website">';
        $og_tag .='<meta property="og:title" content="'.$this->viewData['seoTitle'].' - ahecounselling.com">';
        $og_tag .='<meta property="og:description" content="'.$this->viewData['seoDesc'].' - ahecounselling.com">';
        $og_tag .='<meta property="og:url" content="'.url('blog/').'/'.$name.'">';
        $og_tag .='<meta property="og:image" content="'.asset('assets/uploads/projectdoc/'.$findRow->blog_image).'">';
        $og_tag .='<meta property="og:image:alt" content="'.$slug.' - ahecounselling.com">';
        $og_tag .='<meta name="twitter:card" content="summary_large_image">';
        $og_tag .='<meta property="twitter:domain" content="ahecounselling.com">';
        $og_tag .='<meta property="twitter:title" content="'.$this->viewData['seoTitle'].' - ahecounselling.com">';
        $og_tag .='<meta property="twitter:description" content="'.$this->viewData['seoDesc'].' - ahecounselling.com">';
        $og_tag .='<meta property="twitter:url" content="'.url('blog/').'/'.$name.'">';
        $og_tag .='<meta property="twitter:image" content="'.asset('assets/uploads/projectdoc/'.$findRow->blog_image).'">';
        $og_tag .='<meta property="twitter:image:alt" content="'.$slug.' - ahecounselling.com">';
        $this->viewData['og_tag'] = $og_tag;
         view()->share($this->viewData);
         return view('web/singleblog');

    }


      public function servicespage($name=NULL){

        $slug =  str_replace("-"," ",$name);
        $findRow = serviceModel::where('services_name',$slug)->first();
        $ListItem = array();
        $ListItem[0]['@type'] ='ListItem';
        $ListItem[0]['position'] =1;
        $ListItem[0]['name'] ='Ahecounselling';
        $ListItem[0]['item'] ='https://www.ahecounselling.com';
        $ListItem[1]['@type'] ='ListItem';
        $ListItem[1]['position'] =2;
        $ListItem[1]['name'] ='Services';
        $ListItem[1]['item'] =url('').'/services';
        $ListItem[2]['@type'] ='ListItem';
        $ListItem[2]['position'] =3;
        $ListItem[2]['name'] =$slug;
        $ListItem[2]['item'] =url('services/').'/'.$name;
         $this->viewData['canonical'] = url('services/').'/'.$name;
        $this->viewData['ListItem'] = $ListItem;      

        if(empty($findRow))

        {
            $this->viewData['title'] = 'Page not found';
            view()->share($this->viewData);
            return view('pagenotfound');

        }

        $this->viewData['seo']= true;;
        $this->viewData['row']= $findRow;
        $this->viewData['title'] = !empty($slug)?$slug:'Home';

        if(!empty($findRow)){

            $this->viewData['seoTitle'] = $findRow->title;
            $this->viewData['seoKeyword'] = $findRow->keyword;
            $this->viewData['seoDesc'] = $findRow->description;
        }

        view()->share($this->viewData);

        return view('web/singleservices');

    }

 }



