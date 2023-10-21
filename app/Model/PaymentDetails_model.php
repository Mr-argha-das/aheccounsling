<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
 

class PaymentDetails_model extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_details';
    protected $primaryKey = 'id';
   
    public $timestamps = false;
    //protected $guarded = ['photo_id'];
    /*const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';*/
    public $status;
    public $msg;
    protected $appends = ['encodeurl'];

    public function __construct(){

    }
     public function getDefautl(){
          return $this;
      }
   
      public function getEncodeurlAttribute()
        {
            return 'https://www.ahecounselling.com/payment/quick-checkout/'.base64_encode($this->id);
        }
}
