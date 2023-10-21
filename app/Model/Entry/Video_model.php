<?php

namespace App\Model\Entry;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use Hashids\Hashids;


class Video_model extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'youtube_link';
    protected $primaryKey = 'y_id';
    public $timestamps = false;
    protected $guarded = ['y_id'];
    public $niceNames = [];
    public function __construct()
    {
         $this->niceNames = [
             'y_title'      => 'Video Title',
             'y_url'      => 'Youtube Video URL',
          
        ];


        
    }

    public function getDefautl()
    {
       return $this;
    }
    
    public function validation($request)
    {
        $rules = [
             'y_title'    => 'required',
             'y_url'      => 'required',
            
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

   
}
?>
