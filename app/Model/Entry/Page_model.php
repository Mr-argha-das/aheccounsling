<?php

namespace App\Model\Entry;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use Hashids\Hashids;


class Page_model extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entry_menu';
    protected $primaryKey = 'menu_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['menu_id'];/*
     const CREATED_AT = 'event_creation_date';
    const UPDATED_AT = 'event_last_update';*/
    //protected $dates = ['student_dob'];
    /*protected $casts =[
        'student_dob' => 'date',
        'student_creation_date' => 'datetime',
        'student_last_update' => 'datetime',
    ];
*/
    public $niceNames = [];
    public function __construct()
    {
         $this->niceNames = [
             'menu_name'      => 'Page Name',
             'menu_parent'      => 'Parent Category',
             'menu_url'      => 'Custom Url',
             'menu_order'=>'Ordering',
             'menu_txt'=>'Description',
             'menu_img'=>'Page Image',
             'sub_menu_status'      => 'Sub Menu Show',
             'menu_cat_type'=>'View File Name',
             'menu_alias'=>'Page Alias',
             'menu_show'      => 'Visibility',
             'menu_seo_title'=>'Seo Title',
             'menu_seo_des'=>'Seo Description',
             'menu_seo_keyword'      => 'Seo Keyword',
             'menu_slider_img'=>'Slider Images',
             'menu_slider_text'=>'Extra Description',
             'menu_thumb'=>'Image Thumbnail',
             'menu_slider_status'=>'Slider Status',
        
          
        ];


        
    }

    public function getDefautl()
    {
       return $this;
    }
    
    public function validation($request)
    {
        $rules = [
             'menu_name'      => 'required',
             'menu_parent'      => '',
             'menu_url'      => '',
             'menu_order'=>'',
             'menu_txt'=>'',
             'sub_menu_status'      => '',
             'menu_cat_type'=>'',
             'menu_alias'=>'required',
             'menu_show'      => '',
             'menu_seo_title'=>'',
             'menu_seo_des'=>'',
             'menu_seo_keyword'      => '',
             'menu_slider_img'=>'',
             'menu_slider_text'=>'',
             'menu_thumb'=>'',
             'menu_slider_status'=>'',
            
        ];
        $customMessages=array();
       

        $validator = Validator::make($request->all(), $rules, $customMessages,$this->niceNames);
        return $validator;
    }


  

    public static function updateRow($table,$data,$where)
    {
       return DB::table($table)->where($where)
              ->update($data);
    }
    public function getSubMenu($parentId=NULL,$type=NULL)
    {
          $STR = '';
        if(!empty($parentId))
        {
          
            $getData = self::where(['sub_menu_status'=>1,'menu_show'=>1,'menu_parent'=>$parentId])->orderBy('menu_order','asc')->get();
            if(!empty($getData))
            {
                $STR .='<ul class="menu__sub-menu">';
                foreach ($getData as $key => $value) {
                    $StrData = '';
                    if(!empty($type))
                    {
                        $StrData = '<span class="navbar-my-caret"></span></a>';
                    }
                    $STR .='<li class="menu__sub-menu__item">
                          <a class="menu__sub-menu__link" href="'.$value->menu_alias.'">'.$value->menu_name.' '.$StrData.'</a>';
                               if(!empty($value->menu_id))
                                    {
                                     $STR.=$this->getSubMenu($value->menu_id,true);
                                    }
                    $STR .='</li>';
                }
                $STR .='</ul>';
            }
        }
        return $STR;
    }
    public function makeHeaderNavigation()
    {
        $bdata = self::where(['sub_menu_status'=>1,'menu_show'=>1,'menu_parent'=>0])->orderBy('menu_order','asc')->get();
        $str = '';

        if(!empty($bdata))
        {
            $str .='<ul>';
            foreach ($bdata as $key => $value) {

                $str .= ' <li class="menu__item">
                                    <a href="javascript:;" class="menu__link">'.$value->menu_name.'</a>';
                                  if(!empty($value->menu_id))
                                    {
                                     $str.=$this->getSubMenu($value->menu_id);
                                    }
                        $str .='</li>';
            }
             $str .='</ul>';
        }
        echo $str;
    }

    public function getCities($parentid)
    {
        $getDB = DB::table('entry_place')->join('entry_city','city_id','=','place_city')->where('place_parent',$parentid)->where('place_status',1)->orderBy('city_id','desc')->get();
        return $getDB;
    }

    public function getDesc($string,$limit,$url=NULL)
    {
    $string = strip_tags($string);
        if (strlen($string) > $limit) {

            // truncate string
            $stringCut = substr($string, 0, $limit);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            if(!empty($url))
            {
                $string .= '... <a href="'.$url.'">Read More</a>';    
            }
            
        }
        echo $string;
    }
}
?>
