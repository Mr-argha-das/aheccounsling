<?php

namespace App\Model\Entry;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use Hashids\Hashids;


class Work_status extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'work_status';
    protected $primaryKey = 'work_status_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['work_status_id'];/*
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
         // $this->niceNames = [
         //     'currency_name'      => 'currency_name',
         //  ];
    }

    public function getDefautl()
    {
       return $this;
    }
    
    // public function validation($request)
    // {
    //     $rules = [
    //          'currency_name'      => 'required',
    //     ];
    //     $customMessages=array();
    //     $validator = Validator::make($request->all(), $rules, $customMessages,$this->niceNames);
    //     return $validator;
    // }

    public static function updateRow($table,$data,$where)
    {
       return DB::table($table)->where($where)
              ->update($data);
    }

   
}
?>
