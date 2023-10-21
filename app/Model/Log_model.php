<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;

class Log_model extends Model
{
   
    protected $table = 'log_table_records';
    protected $primaryKey = 'log_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['log_id'];
    public function __construct()
    {
         
    }

  	public function log_insertData($userid,$tableFile,$table_id,$tableTitle,$type,$sessionID,$entryID=NULL)
  	{
  		if(!empty($userid) && !empty($tableTitle) && !empty($table_id) && !empty($tableTitle) && !empty($type))
  		{
  			$records = array(
  				'log_user_id'   	=> $userid,
  				'log_table'     	=> $tableFile,
  				'log_table_id'  	=> $table_id,
  				'log_title'     	=> $tableTitle,
  				'log_type'      	=> $type,
  				'log_session_id'  => $sessionID,
          'log_job_id'      => $entryID,
  				'log_timestamp'   => date('Y:m:d H:i:s'),
  			);
  		

  			return $this->insert($records);
  		}
      else
      {
        return false;
      }
  	}
  	

    public function singleRecord($table,$col,$slug)
    {
      return DB::table($table)->where($col,$slug)->first();
    }
    public function vehicleOpening($data)
    {
      if((!empty($data))){
      return DB::table('vehicle_opening_record')->insert($data);
      }
    }

}
?>