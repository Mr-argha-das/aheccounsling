<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;

class Team extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table      = 'master_team';
    protected $primaryKey = 'team_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public    $timestamps = true;
    protected $guarded    = ['team_id'];
    const CREATED_AT = 'team_creation_date';
    const UPDATED_AT = 'team_last_update';
    public $key = 'keytesting';
    //protected $dates = ['student_dob'];
    /*protected $casts =[
        'student_dob' => 'date',
        'student_creation_date' => 'datetime',
        'student_last_update' => 'datetime',
    ];
*/
    public static $niceNames = [];
    public function __construct()
    {
        $this->niceNames = [
            'team_name'            => 'User Name',
            'team_email'           => 'User email ID',
            'team_type'         => 'User Type ',
            'team_dob'         => 'Date of Birth (DOB)',
            'team_doj'         => 'Date of Joining',
            'team_dol'         => 'Date of Leaving',
            'team_mob'         => 'Personal Mobile No.',
            'team_office_mob'   => 'Office Mobile No.',
            'team_address'   => 'Address',
            'team_pan'         => 'PAN No.',
            'team_addhar'       => 'Aadhar No.',
            'team_status'       => 'Status',
            'team_password'       => 'Password',
        ];
    }

    public function validation($request, $removeKey = NULL)
    {
        $rules = [
            'team_name'            => 'required',
            'team_email'           => 'required|unique:master_team|email',
            'team_type'         => 'required',
            'team_dob'         => '',
            'team_doj'         => '',
            'team_dol'         => '',
            'team_mob'         => '',
            'team_office_mob'        => '',
            'team_address'        => '',
            'team_pan'          => '',
            'team_addhar'       => '',
            'team_status'      => '',
            'team_password'=>'required',

        ];
        if (!empty($removeKey)) {
            unset($rules[$removeKey]);
        }
        $customMessages = array();

        $validator = Validator::make($request->all(), $rules, $customMessages, $this->niceNames);
        return $validator;
    }


    public function multipleInputs($req)
    {
        $multi_team_doc_name = $req->input('nv_id');
        $data = [];
        foreach ($multi_team_doc_name as $key => $value) {
            if (!empty($value)) {
                $row = [];
                $user = DB::table('navigation')->where('nv_id','=',$value)->first();
                $row['allot_type_id'] = $value;
                $row['allot_parent_id'] = $user->nv_parent;
                
                $data[] = $row;
            }
        }

        return $data;
    }
    public function allotlist()
    {
         $parent = DB::table('navigation')->groupBy('nv_parent')->orderBy('nv_parent','asc')->get();
         $data = [];
         foreach ($parent as $key => $value) {
            $row = [] ;
            $row['title'] = $value->nv_parent_name;
            $row['rowdata'] = DB::table('navigation')->orderBy('nv_id','asc')->where('nv_parent','=',$value->nv_parent)->get();
            $data[] = $row;
         }
         return $data;
    }

    public function findlistdata($userid)
    {
        return DB::table('allot_user')->where('allot_user_id',$userid)->get();;
    }
    public function storemultiple($table, $col, $data, $id)
    {
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $data[$key][$col] = $id;
            }
        }
        DB::table($table)->where($col, $id)->delete();
        DB::table($table)->insert($data);
    }


    public function multifiles($slug)
    {
        return  Self::join('multi_team_docs', 'multi_doc_parent_id', '=', 'team_id')->where(['multi_doc_parent_id' => $slug])->get();
    }
}
