<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

use Validator;

class Session extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_session';
    protected $primaryKey = 'session_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
  //  public $timestamps = true;
    protected $guarded = ['session_id'];
      //  const CREATED_AT = 'student_creation_date';
      //  const UPDATED_AT = 'student_last_update';
    public $niceNames = [];
    public function __construct()
    {
        $niceNames = [
            'session_name'      => 'Session Name',
            
        ];
    }
    public function defaultRecord()
    {
        return $this->Leftjoin('master_opening_amt','op_session_id','=','session_id');
    }



    public function arrayTable($id,$col,$DEFAULT=NULL)
    {
        $optionArray = array();

        if(!empty($id))
        {
            $party = DB::table('master_session')->orderBy($id,'desc')->get();
        }
        if(!empty($party))
        {
             foreach($party as $OB)
             {
                $optionArray[$OB->$id]=$OB->$col;
            }
        }
        return $optionArray;

    }

    public function validation($request)
    {
        $rules = [
            'session_name' => 'required|min:8',
           
        ];
        $customMessages=array();
        

        $validator = Validator::make($request->all(), $rules, $customMessages,$this->niceNames);
        return $validator;
    }


    public function multiRecord($data)
    {
        if(!empty($data))
        {
            return DB::table('master_opening_amt')->insert($data);
        }
    }

    public function updateRecord($id,$openingData)
    {
        if(!empty($id))
        {
            return DB::table('master_opening_amt')->where('op_session_id','=',$id)->update($openingData);
        }
    }
}
?>