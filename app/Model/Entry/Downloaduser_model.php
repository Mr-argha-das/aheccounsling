<?php

namespace App\Model\Entry;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;
use Hashids\Hashids;


class Downloaduser_model extends Model{

    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'download_user';
    protected $primaryKey = 'id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['id'];
    public $niceNames = [];
    public function __construct(){

    }

    public function getDefautl(){

       return $this;
    }
    
   public function project_list(){

    return $this->belongsTo(Project_model::class,'project_id');

   }

   

}
?>
