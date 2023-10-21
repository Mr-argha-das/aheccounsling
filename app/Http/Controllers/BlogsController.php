<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Model\Entry\Blog_model as WorkmModel;



class BlogsController extends Controller

{

    public $viewData= [];

    public $ViewFile="blogs"; /*Php File*/

    public $PageFile="blogs";

    public function __construct(){

          parent::__construct();
          $this->Event_model = new WorkmModel;
          $this->viewData['timedate'] = $this->timedate;

      }

  public function index($Slug=NULL){

       $CityName =  str_replace("_"," ",$Slug);

       $findCity = $this->Event_model::where('blog_name',$CityName)->first();

       $Attraction = $this->Event_model::whereNotIn('blog_id',[$findCity->blog_id])->orderBy('blog_id','desc')->get();

       $this->viewData['Records'] = $this->headerlist($findCity);

       $this->viewData['find'] = $findCity;

       $this->viewData['title'] = $findCity->blog_name;

       $this->viewData['AttractionData'] = $Attraction;

       $this->viewData['cityData'] = 1;

        view()->share($this->viewData);

        return view('tpl/blogs');

    }

    public function headerlist($rowdata,$attraction=NULL){
        
        $row = [];
        $row['menu_alias'] =  !empty($attraction)?''.$rowdata->blog_name:$rowdata->blog_name;
        $row['menu_thumb'] = $rowdata->blog_image;

        $row['menu_slider_img'] = '';

        $row['menu_slider_status'] =2;

        $row['menu_id'] =$rowdata->blog_id;

        $row = (Object) $row;

            return $row;

    }       

    

   

}