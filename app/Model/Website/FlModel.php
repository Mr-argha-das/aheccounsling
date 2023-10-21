<?php

namespace App\Model\Website;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
class FlModel extends Model
{
   
    
    protected $table = 'fl_form';
    protected $primaryKey = 'af_id';

    public $timestamps = false;
    protected $guarded = ['af_id'];
  
    public $niceNames = [];
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
