<?php

namespace App\Model\Entry;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use Hashids\Hashids;


class Home_offere_model extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'home_offere';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
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
