<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public $viewData= [];
    public $ViewFile="home"; /*Php File*/
    public $PageFile="page";
    public $title = 'Home';
    public $id;
    public function __construct(Request $req){
         parent::__construct();
         $this->viewData['serviceArray']  =\App\Model\Entry\Service_model::makeArray();
      }
    public function index(){
        echo $this->id;die;
        $this->viewData['title'] = 'Account';
        $seoData = \App\Model\Entry\Page_model::where('menu_alias','account')->first();
        if(!empty($seoData))
        {
            $this->viewData['seoTitle']   = $seoData->menu_seo_title;
            $this->viewData['seoKeyword'] = $seoData->menu_seo_keyword;
            $this->viewData['seoDesc']    = $seoData->menu_seo_des;
        }
        $this->viewData['fileName'] = $Slug;
        view()->share($this->viewData);
        return view('web/account');
    }
 }