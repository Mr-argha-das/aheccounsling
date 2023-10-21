<?php

namespace App\Model\Entry;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use Hashids\Hashids;


class Service_model extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entry_service';
    protected $primaryKey = 'services_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['services_id'];
    public $niceNames = [];
    public function __construct()
    {
         $this->niceNames = [
             'services_name'      => 'Title',
             /*'services_keyword'      => ' services Keyword',*/
             'services_desc'      => 'Description',
             'services_image'      => ' Image',
             'services_status'      => ' services Status',
             
             
          
        ];


        
    }

    public function getDefautl()
    {
       return $this;
    }
    
    public function validation($request)
    {
        $rules = [
             'services_name'      => 'required',
             /*'services_keyword'      => 'required',*/
             'services_desc'      => 'required',
             'services_image'      => 'required',
             'services_status'      => 'required',
             
            
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

    public static function makeArray()
    {

                return self::orderBy('services_id','desc')->where('services_status',1)->pluck('services_name','services_id')->toArray();
    }
}
?>
