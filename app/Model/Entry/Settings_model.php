<?php



namespace App\Model\Entry;

use Illuminate\Database\Eloquent\Model;

use DB;

use Validator;

use Hashids\Hashids;





class Settings_model extends Model

{

    //config('app.dateFormatOut')

    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'project_config';

    protected $primaryKey = 'setting_id';

    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];

    public $timestamps = false;

    protected $guarded = ['setting_id'];

    public $niceNames = [];

    public function __construct()

    {

         $this->niceNames = [

             'setting_var'      => 'PHP Keywor(not editable)',

             'setting_name'      => 'Title',

             'setting_access'      => 'Access Type',

             'setting_value'      => ' Value',

             'setting_sorting'      => ' Sorting',



        ];





        

    }



    public function getDefautl()

    {

       return $this;

    }

    

    public function validation($request)

    {

        $rules = [

             'setting_var'             => 'required',

             'setting_name'            => 'required',

             'setting_access'          => 'required',

             'setting_value'           => 'required',

             'setting_sorting'         => 'required',

             

            

        ];

        $customMessages=array();

       



        $validator = Validator::make($request->all(), $rules, $customMessages,$this->niceNames);

        return $validator;

    }





  



    public static function updateRow($table,$data,$where)

    {

       return DB::table($table)->where($where)

              ->update($data);

    }



   

}

?>

