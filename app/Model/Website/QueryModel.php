<?php



namespace App\Model\Website;

use Illuminate\Database\Eloquent\Model;

use DB;

use Validator;

class QueryModel extends Model

{

   

    

    protected $table = 'enquiry_user';

    protected $primaryKey = 'en_id';



    public $timestamps = false;

    protected $guarded = ['en_id'];

  

    public $niceNames = [];

    public function __construct()

    {

         $this->niceNames = [

             'en_first_name'      => 'First Name',

             'en_last_name'       => 'Last Name',

             'en_email'           => ' Email',

             'en_mobile'          => 'Mobile',

             'en_service'         => 'Services',

             'en_subject'         => 'Subject',

             'en_query'           => 'Query',

             'en_attachment'      => 'Attachment',

             

          

        ];





        

    }



    public function getDefautl()

    {

       return $this;

    }

    

    public  function validation($request)

    {

      

        $rules = [

             'en_first_name'      => 'required',

             'en_last_name'      => 'required',

             'en_email'      => 'required',

             'en_mobile'      => '',

             'en_service'      => 'required',

             'en_subject'      => 'required',

             'en_query'=>'required',

          ];

        $customMessages=array();

        $validator = Validator::make($request->all(), $rules, $customMessages,$this->niceNames);

        return $validator;

    }


 public static function updateRow($table,$data,$where){

       return DB::table($table)->where($where)

              ->update($data);

    }



    public function sendMail(){

        

    }


   public function rmuserdetails(){

        return $this->belongsTo(\App\Model\Entry\RegisterMember_model::class,'rm_id',);
    }
  public function services(){

        return $this->belongsTo(\App\Model\Entry\Service_model::class,'en_service',);
    }

   public function productioncost(){
        return $this->hasMany(\App\Model\Entry\Production_model::class,'tranxid','tranxid');
    }
   

}

?>

