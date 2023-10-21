<?php

namespace App\Model;

use DB;

use Illuminate\Database\Eloquent\Model;

class Downloaduser_model extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'download_user';
    protected $primaryKey = 'id';
   
    public $timestamps = false;
   
    public function __construct(){
        
         
    }


    public static function insertIgnore($array){

         
    $a = new static();
     
    DB::insert('INSERT IGNORE INTO '.$a->table.' ('.implode(',',array_keys($array)).
        ') values (?'.str_repeat(',?',count($array) - 1).')',array_values($array));
}


 }