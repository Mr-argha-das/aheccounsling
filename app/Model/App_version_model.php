<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class App_version_model extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_version';
    protected $primaryKey = 'id';
   
    public $timestamps = false;
    //protected $guarded = ['photo_id'];
    /*const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';*/
    public $status;
    public $msg;
    public function __construct(){
        
         
    }
    

}
