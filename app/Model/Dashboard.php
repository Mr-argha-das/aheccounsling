<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Validator;
use DB;
class Dashboard extends Model
{
    //config('app.dateFormatOut')
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entry_job_inland';
    protected $primaryKey = 'inl_id';
    //protected $fillable = ['photo_name', 'photo_file', 'photo_status'];
    public $timestamps = true;
    protected $guarded = ['inl_id'];

    //protected $dates = ['student_dob'];
    /*protected $casts =[
        'student_dob' => 'date',
        'student_creation_date' => 'datetime',
        'student_last_update' => 'datetime',
    ];
*/
    public function __construct()
    {

    }
    public function defaultRecord()
    {

    }

    public function pendingVehicle()
    {
         $billingPartyTable  = "(SELECT cus_id as billing_party_id,cus_nm as billing_party_name FROM master_customer) as billing_party ";
        $consignorTable     = "(SELECT cus_id as consignor_id,cus_nm as consignor_name FROM master_customer) as consignor ";
        $consigneeTable     = "(SELECT cus_id as consignee_id,cus_nm as consignee_name FROM master_customer) as consignee ";
        $unitTable   = "(SELECT unit_id as unit_Id,unit_nm as unit_name FROM master_unit) as unit";
        
        return $this
            ->join('master_party','party_id','=','inl_party')
            ->join('master_unit','unit_id','=','inl_unit')
            ->Leftjoin('entry_job_container','cont_parent_id','=','inl_id')
            ->Leftjoin('master_vehicle','vehicle_id','=','inl_veh_id')
            ->Leftjoin('entry_invoice','invoice_parent_id','=','inl_id')
            ->join(DB::raw($billingPartyTable),
                   function($join)
                   {
                       $join->on('billing_party_id', '=', 'inl_billing_party');
                   })

            ->join(DB::raw($consignorTable),
                   function($join)
                   {
                       $join->on('consignor_id', '=', 'inl_billing_party');
                   })

            ->join(DB::raw($consigneeTable),
                   function($join)
                   {
                       $join->on('consignee_id', '=', 'inl_billing_party');
                   })
            ->orderBy($this->primaryKey,'desc');
    }
       
        public function pendingContainer()
    {
        $billingPartyTable  = "(SELECT cus_id as billing_party_id,cus_nm as billing_party_name FROM master_customer) as billing_party ";
        return $this
          
            ->Leftjoin('entry_job_container','cont_parent_id','=','inl_id')
              ->join('master_party','party_id','=','inl_party')
               ->join(DB::raw($billingPartyTable),
                   function($join)
                   {
                       $join->on('billing_party_id', '=', 'inl_billing_party');
                   })
            ->orderBy($this->primaryKey,'desc');
    }
    public function validation($request)
    {

    }

}
?>