<?php



namespace App\Model\Entry;

use Illuminate\Database\Eloquent\Model;

use DB;

use Validator;

use Hashids\Hashids;





class Blog_model extends Model

{

    //config('app.dateFormatOut')

    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'entry_blog';

    protected $primaryKey = 'blog_id';

    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];

    public $timestamps = false;

    protected $guarded = ['blog_id'];/*

     const CREATED_AT = 'event_creation_date';

    const UPDATED_AT = 'event_last_update';*/

    //protected $dates = ['student_dob'];

    /*protected $casts =[

        'student_dob' => 'date',

        'student_creation_date' => 'datetime',

        'student_last_update' => 'datetime',

    ];

*/

    public $niceNames = [];

    public function __construct()

    {

         $this->niceNames = [

             'blog_name'      => 'Title',

             /*'blog_keyword'      => ' Blog Keyword',*/

             'blog_desc'      => 'Description',

             'blog_image'      => ' Image',

             'blog_status'      => ' Blog Status',

             'blog_comment'      => ' Comment Status',
           ];





        

    }



    public function getDefautl()

    {

       return $this;

    }

    

    public function validation($request)

    {

        $rules = [

             'blog_name'      => 'required',

             /*'blog_keyword'      => 'required',*/

             'blog_desc'      => 'required',

             'blog_image'      => 'required',

             'blog_status'      => 'required',

             'blog_comment'      => 'required',

            

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

