<?php

namespace App\Model\Entry;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use Hashids\Hashids;


class Aboutus_model extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entry_aboutus';
    protected $primaryKey = 'about_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['about_id'];
    public $niceNames = [];
    public function __construct()
    {
         $this->niceNames = [
             'about_name'      => 'Title',
             /*'about_keyword'      => ' about Keyword',*/
             'about_desc'      => 'Description',
             'about_image'      => ' Image',
             'about_status'      => ' about Status',
             
             
          
        ];


        
    }

    public function getDefautl()
    {
       return $this;
    }
    
    public function validation($request)
    {
        $rules = [
             'about_name'      => 'required',
             /*'about_keyword'      => 'required',*/
             'about_desc'      => 'required',
             'about_image'      => 'required',
             'about_status'      => 'required',
             
            
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
