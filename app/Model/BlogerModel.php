<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use DB;

use Validator;



class BlogerModel extends Model

{

   

    protected $table = 'bloger_user';

    protected $primaryKey = 'bloger_id';

    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];

    public $timestamps = false;

    protected $guarded = ['bloger_id'];

    public $cart_info;

    public function __construct()

    {

       

         

        

    }


public function getDefautl()

    {

       return $this;

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