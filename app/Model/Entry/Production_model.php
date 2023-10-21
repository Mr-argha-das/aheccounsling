<?php

namespace App\Model\Entry;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use Hashids\Hashids;


class Production_model extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'production_cost';
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
   
}
?>
