<?php

namespace App\Model\Entry;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use Hashids\Hashids;


class City_model extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entry_city';
    protected $primaryKey = 'city_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['city_id'];/*
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
             'city_name'      => 'City Name',
             'city_desc'      => 'Description',
             'city_image'      => 'City Image',
             'city_air'      => 'Air Description',
             'city_rail'      => 'Train Description',
             'city_road'      => 'Road Description',
             'city_near'=>'Near Cities',
             'city_multple_image'=>'Multiple Images',
        ];


        
    }

    public function getDefautl()
    {
       return $this;
    }
    
    public function validation($request)
    {
        $rules = [
             'city_name'      => 'required',
             'city_desc'      => '',
             'city_image'      => 'required',
             'city_air'       => '',
             'city_rail'       => '',
             'city_road'       => '',
             'city_near'       => '',
             'city_multple_image'      => '',
             


       
            
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