<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;

class Login_model extends Model
{
   
    protected $table = 'master_team';
    protected $primaryKey = 'team_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    protected $guarded = ['team_id'];
    public $cart_info;
    public function __construct()
    {
       
         
        
    }


    public static function CheckLoginCredentials($data)
    { 
        $row = ['status'=>false,'message'=>'','data'=>''];
         $dt = self::where($data)->first();
         if(empty($dt))
         {
             $data['team_status'] = 2;
             $datarow = self::where($data)->first();
             if(empty($datarow))
             {
                $row=['status'=>false,'message'=>'Login Credential not match','data'=>$datarow];
             }else{
              $row=['status'=>false,'message'=>'Your Login Status is inactive please contact to admin','data'=>$datarow];
             }
         }else{
           $row=['status'=>true,'message'=>'Login Successfully redirecting to Dashboard','data'=>$dt];
         }
        return $row;
    }


    public static function checkUserPermissions($request)
    {

        $path = $request->path();
        $userrole = session()->get('usersession');
        $roleId = $userrole['team_type'];
        $DBRow =   DB::table('permission_allotment')->Join('route_permission','route_id','=','pr_parent_id')->where(['pr_group_id'=>$roleId,'route_key'=>$path])->get();
        return $row = count($DBRow);
        
        
    }
    public function hi()
    {
        echo "hi";die;
    }
}
?>