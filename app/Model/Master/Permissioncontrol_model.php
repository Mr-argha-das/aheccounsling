<?php

namespace App\Model\Master;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;

class Permissioncontrol_model extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permission_allotment';
    protected $primaryKey = 'pr_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['pr_id'];
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


    public static function manageInputs($request)
    {
        $postdata = [];
        $pr_group_id = $request->input('pr_group_id');
        foreach ($pr_group_id as $key => $value) {
           
            if(!empty($value))
            {
                foreach($value as $vas)
                {
                    $data = [];
                    $data['pr_parent_id'] = $vas;
                    $data['pr_group_id'] = $key;
                    $postdata[] = $data;
                }
            }
        }

        return $postdata;
    }

    public static function saveMultiple($data)
    {   
        self::truncate();
        return self::insert($data);
    }

 
 
  
    public static function listOfPermission()
    {
       return DB::table('route_permission')->orderBy('route_id','asc')->get();
    }

}
?>