<?php

namespace App\Model\Entry;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use Hashids\Hashids;


class FaqCategory_model extends Model{

    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq_categroy';
    protected $primaryKey = 'id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['id'];
    public $niceNames = [];
    public function __construct(){

    }

    public function getDefautl()
    {
       return $this;
    }
    
    public function validation($request){
        
          $rules = [
             'name'         => 'required',
             'title'    => 'required',
             'name'    => 'required',
            ];
         $customMessages=array();
         $validator = Validator::make($request->all(), $rules, $customMessages,$this->niceNames);
         return $validator;
    }

  public static function updateRow($table,$data,$where){

        return DB::table($table)->where($where)
              ->update($data);
    }
 

   

    public static function getDesc($string,$limit,$url=NULL)
    {

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

    public static function makeArray(){

           return self::orderBy('id','desc')->pluck('name','id')->toArray();
     }
}
?>
