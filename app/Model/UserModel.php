<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use DB;

use Validator;



class UserModel extends Model

{

   

    protected $table = 'user_login';

    protected $primaryKey = 'user_id';

    protected $appends = ['rmusers'];

    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];

    public $timestamps = false;

    protected $guarded = ['user_id'];

    public $cart_info;

    public function __construct()

    {

       

         

        

    }


public function getDefautl()

    {

       return $this;

    }
 
 public function getRmusersAttribute()
        {   
            // dd($this->rm_ids_list);  
             if($this->rm_ids_list!=null && $this->rm_ids_list!=""){
                return DB::table('register_member')->whereIn('id',explode(',',$this->rm_ids_list))
              ->get();

             }else{

                return array(); 
             }
                
            // return 'https://www.ahecounselling.com/payment/quick-checkout/'.base64_encode($this->id);
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



}

?>