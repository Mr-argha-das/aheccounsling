<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Restmodel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'photos';
    protected $primaryKey = 'photo_id';
    protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = false;
    //protected $guarded = ['photo_id'];
    /*const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';*/
    public $status;
    public $msg;
    public function __construct()
    {
        $this->status=false;
        $this->msg='';
    }
    public function getContent()
    {
        //$data = fopen('php://input', 'rb');
        $data = file_get_contents('php://input');
        return json_decode($data);
    }
    public function errorOut($msg=NULL,$data=NULL){
        $this->msg=$msg;
        $this->status=false;
        return $this->response($data);
    }
    public function successOut($msg=NULL,$data=NULL){
        $this->msg=$msg;
        $this->status=true;
        return $this->response($data);
    }
    public function validationOut($error=NULL,$data=NULL){
        $error = implode("<br>",$error->all());
        return $this->errorOut($error,$data);
    }
    public function response($data=NULL){
        $data=empty($data)?array():$data;
        $arr=array(
            'status'        =>  (empty($this->status))?'error':'success',
            'code'          =>  (empty($this->status))?404:200,
            'message'       =>  $this->msg,
            'data'          =>  $data,
        );

        return response()->json($arr);
        /*header('Content-Type: application/json');
        echo json_encode( $arr );
        die;*/
    }

}
