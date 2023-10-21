<?php

namespace App\Model\Master;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;

class Permission_model extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'route_permission';
    protected $primaryKey = 'route_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['route_id'];
   // const CREATED_AT = 'student_creation_date';
   // const UPDATED_AT = 'student_last_update';
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
            'route_title'      => 'Permission Title',
            'route_key' =>'Permission Key',
            'route_value' =>'Permission Value',
          
        ];
    }


    public function validation($request,$removeKey=NULL)
    {
        $rules = [
            'route_title'      => 'required',
            'route_key' =>'required',
             'route_value' =>'required',
        ];
         if(!empty($removeKey))
        {
            unset($rules[$removeKey]);
        }
        $customMessages=array();
       

        $validator = Validator::make($request->all(), $rules, $customMessages,$this->niceNames);
        return $validator;
    }

}
?>