<?php

namespace App\Model\Entry;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use Hashids\Hashids;


class User_contact extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_contants';
    protected $primaryKey = 'id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['id'];/*
     
*/
 
    public function __construct()
    {
         
    }

    public function getDefautl()
    {
       return $this;
    }
    
     

    public static function updateRow($table,$data,$where)
    {
       return DB::table($table)->where($where)
              ->update($data);
    }

   
}
?>
