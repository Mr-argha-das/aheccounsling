<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use \App\Library\Arraydb as arraydb;
use \App\Model\Entry\RegisterMember_model as rmsuerlist;
use \App\Model\Website\QueryModel as ordertable;
use Carbon\Carbon;
use DB;

class DashboardController  extends Controller
{

  public $title = 'Dashboard';

  public $viewFolder = "dashboard/";
  public $viewData = [];
  public $model = [];

  public function __construct(Request $request)
  {

    parent::__construct();
    $this->viewpPath = $this->viewFolder . '/';
    $this->viewFolder = 'admin/' . $this->viewFolder;
    $this->viewData['pendingTikcetsCreate'] = 'entry/workentry/';
    $this->viewData['ticket'] = 'entry/ticketsystem/';
    $this->viewData['investment'] = 'entry/investment/';
    $this->viewData['customer'] = 'master/customer/';
    $this->viewData['renewalPath'] = 'entry/renewal/renewableCreate/'; 
    $this->arraydb = new arraydb;
    $this->viewData['TicketStatus'] = $this->arraydb::$TicketStatus;
    $this->viewData['categorylist'] = $this->arraydb::$categorylist;

  }

  public function index(Request $request){
      
     $userData = session()->get('usersession');
     if (empty($userData)) {
      return redirect()->route('wpanelLogin');
     }
      $this->viewData['title'] = $this->title;
     //bologer name remanig user for use this code
     if($userData['rm_id']==0 && $userData['team_id']!=1){
       view()->share($this->viewData);
       return view($this->viewFolder . 'anotherindex');
     }

     if($userData['team_id']==1){
          
         $totalCurrencyAmount = ordertable::
                             select(DB::raw('SUM(inr_amount) AS inr'),DB::raw('SUM(aud_amount) AS aud'),DB::raw('SUM(word_count) AS word_count'))
                           ->whereYear('en_created_at', Carbon::now()->year)
                           ->whereMonth('en_created_at', Carbon::now()->month)
                           ->where('currency_type','!=',null)->first();

         $weekTotalAmount = ordertable::
                             select(DB::raw('SUM(inr_amount) AS inr'),DB::raw('SUM(aud_amount) AS aud'),DB::raw('SUM(word_count) AS word_count'))
                             ->whereBetween('en_created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                            ->where('currency_type','!=',null)->first();

        $this->viewData['weekTotalAmount']    = $weekTotalAmount;
        $this->viewData['totalCurrencyAmount']    = $totalCurrencyAmount;

         view()->share($this->viewData);
        return view($this->viewFolder . 'adminindex');
        
      }
      if($userData['rm_id']!=0){
          
        $userData = $this->getUserData($userData['rm_id']);
        $audOrderMonthName=$audOrderaud=$audOrdernumber=[];
        
        foreach ($userData['aud_order_monthly'] as $key => $aom_value) {
           $audOrderMonthName[] =$aom_value->new_date;
           $audOrderaud[] =$aom_value->aud_amount;
           $audOrdernumber[] =$aom_value->total_order;
         }
          
         $this->viewData['month_days'] = $userData['month_days'];
         $this->viewData['audOrderMonthName'] = $audOrderMonthName;
         $this->viewData['audOrderaud'] = $audOrderaud;
         $this->viewData['audOrdernumber'] = $audOrdernumber;
         $this->viewData['month_value'] = $userData['month_value'];
         $this->viewData['totalCurrencyAmount'] = $userData['totalCurrencyAmount'];
         $this->viewData['weekTotalAmount'] = $userData['weekTotalAmount'];
         $this->viewData['currencyAmount'] = $userData['currencyAmount'];
         
         view()->share($this->viewData);
         return view($this->viewFolder . 'bdmindex');
       }

   }

  public function getAdminData(){

          $rmDataService =$rmData =array();
          $rmuser = rmsuerlist::where('status',1)->get();
          $rmData =array();
          $rmDataService =$rmCompairOrders = $rmCompairAud =array();
           $n =$j=0;
          foreach ($rmuser as $key => $data) {
              $total_order =0;
              $orderdataarray =$audDataArray =array();
             for ($i=1; $i <=date('m'); $i++) { 
                 $monthly_order = ordertable::
                          whereYear('en_created_at', Carbon::now()->year)
                         ->whereMonth('en_created_at',$i)
                         ->where('rm_id',$data->id)
                         ->where('order_type',1)->count();

                   $orderdataarray[] =$monthly_order;
                   $name = $data->name;
               }
             for ($i=1; $i <=date('m'); $i++) { 
                 $aud_amount = ordertable::
                          whereYear('en_created_at', Carbon::now()->year)
                         ->whereMonth('en_created_at',$i)
                         ->where('rm_id',$data->id)
                          ->sum('aud_amount');
                 $audDataArray[] =number_format($aud_amount,2, '.', '');
                }
            $rmCompairOrders[$j]['data'] =$orderdataarray;
            $rmCompairOrders[$j]['name'] =$name;
            $rmCompairAud[$j]['data'] =$audDataArray;
            $rmCompairAud[$j]['name'] =$name;
            $j++;
              
              $total_order = ordertable::
                whereYear('en_created_at', Carbon::now()->year)
              ->where('rm_id',$data->id)
              ->where('order_type',1)
              ->whereMonth('en_created_at', Carbon::now()->month)
              ->get()->count();

              if($total_order==0){
                continue;
              }
            $rmData[$n]['name'] =$data->rmid;
            $rmData[$n]['y'] =$total_order;
            $rmData[$n]['drilldown'] =$data->rmid;
            $rmDataService[$n]['name'] =$data->rmid;
            $rmDataService[$n]['id'] =$data->rmid;
              $k=0;
            
            $servicedataCount = ordertable::select('services_name', DB::raw('count(services_name) as services_count') )->
               whereYear('en_created_at', Carbon::now()->year)
              ->where('rm_id',$data->id)
              ->Leftjoin('entry_service','services_id','=','en_service')
              ->groupBy('en_service')
              ->whereMonth('en_created_at', Carbon::now()->month)
              ->get();

            foreach ($servicedataCount as $service_key => $services) {
              $rmDataService[$n]['data'][$k][] =$services->services_name;
               $rmDataService[$n]['data'][$k][] =$services->services_count;
               $k++;
             }
             
            $n++;
          }
              
          $currencyAmount = ordertable::
                             join('currency','currency_type','=','currency_id')
                           ->select('currency.currency_code as name',DB::raw('SUM(client_amount) AS x'),DB::raw('SUM(inr_amount) AS y'),DB::raw('SUM(aud_amount) AS z'))
                           ->groupBy('currency_type')
                           ->whereYear('en_created_at', Carbon::now()->year)
                           ->whereMonth('en_created_at', Carbon::now()->month)
                           ->where('currency_type','!=',null)->get()->toarray();

          $aud_order_monthly  =  ordertable::select(DB::raw('IFNULL(SUM(aud_amount),0) as aud_amount'),DB::raw('count(case when order_type=1 then 1 end) as total_order'), DB::raw("MONTHNAME(en_created_at) new_date"),  DB::raw('YEAR(en_created_at) year, MONTH(en_created_at) month',))
          ->groupby('year','month')
          ->get();
          $audOrderMonthName=$audOrderaud=$audOrdernumber=[];
          foreach ($aud_order_monthly as $key => $aom_value) {
          $audOrderMonthName[] =$aom_value->new_date;
          $audOrderaud[] =$aom_value->aud_amount;
          $audOrdernumber[] =$aom_value->total_order;
          }
          $adminData['audOrderMonthName'] = json_encode($audOrderMonthName,JSON_NUMERIC_CHECK);
          $adminData['audOrderaud'] = json_encode($audOrderaud,JSON_NUMERIC_CHECK);
          $adminData['audOrdernumber'] = json_encode($audOrdernumber,JSON_NUMERIC_CHECK);
          $adminData['currencyAmount']    = json_encode($currencyAmount,JSON_NUMERIC_CHECK );
          $adminData['rmData']           =  json_encode($rmData,JSON_NUMERIC_CHECK);
          $adminData['rmCompairOrders']    = json_encode($rmCompairOrders,JSON_NUMERIC_CHECK );
          $adminData['rmDataService']    = json_encode($rmDataService,JSON_NUMERIC_CHECK );
          $adminData['rmCompairAud']    = json_encode($rmCompairAud,JSON_NUMERIC_CHECK );
          return $adminData;
    }

  public function getUserData($rm_id){
              $month_days = $month_value = array()
              ;
         for($i=1;$i<=date('t');$i++){

                $total_order = ordertable::
                whereDate('en_created_at', '=', date('Y-m-'.$i))
               ->where('rm_id',$rm_id)
               ->where('order_type','1')
               ->get()->count();
                  if($total_order==0){
                    continue;
                  }
                $month_days[] =$i.'/'.date('M');
                $month_value[] =[$i.'-'.date('M-Y'),$total_order];
     
          }

        $totalCurrencyAmount = ordertable::
                 select(DB::raw('SUM(inr_amount) AS inr'),DB::raw('SUM(aud_amount) AS aud'),DB::raw('SUM(word_count) AS word_count'))
               ->whereYear('en_created_at', Carbon::now()->year)
               ->whereMonth('en_created_at', Carbon::now()->month)
               ->where('rm_id',$rm_id)
               ->where('currency_type','!=',null)->first();

        $weekTotalAmount = ordertable::
                 select(DB::raw('SUM(inr_amount) AS inr'),DB::raw('SUM(aud_amount) AS aud'),DB::raw('SUM(word_count) AS word_count'))
                 ->whereBetween('en_created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                 ->where('rm_id',$rm_id)
                ->where('currency_type','!=',null)->first();
        $currencyAmount = ordertable::
                             join('currency','currency_type','=','currency_id')
                           ->select('currency.currency_code as name',DB::raw('SUM(client_amount) AS x'),DB::raw('SUM(inr_amount) AS y'),DB::raw('SUM(aud_amount) AS z'))
                           ->groupBy('currency_type')
                           ->whereYear('en_created_at', Carbon::now()->year)
                           ->whereMonth('en_created_at', Carbon::now()->month)
                           ->where('rm_id',$rm_id)
                           ->where('currency_type','!=',null)->get()->toarray();
       $aud_order_monthly  =  ordertable::select(DB::raw('IFNULL(SUM(aud_amount),0) as aud_amount'),DB::raw('count(case when order_type=1 then 1 end) as total_order'), DB::raw("MONTHNAME(en_created_at) new_date"),  DB::raw('YEAR(en_created_at) year, MONTH(en_created_at) month',))
           ->where('rm_id',$rm_id)
          ->groupby('year','month')
          ->get();
        
        $userData['weekTotalAmount']    = $weekTotalAmount;
        $userData['aud_order_monthly']    = $aud_order_monthly;
        $userData['totalCurrencyAmount']    = $totalCurrencyAmount;
        $userData['currencyAmount']    = $currencyAmount;
        $userData['month_days'] = $month_days;
        $userData['month_value'] = $month_value;
        return $userData;
       
  }
  public function AdminDashboard($userData)
  {
    $data['pendingtickets'] = $this->ticketModel->getPendingTickets(['tk_status' => 1]);
    $data['pendingRenewal'] = $this->ticketModel->getRenewals();
    $data['birthdays'] = $this->ticketModel->birthdays();
    $data['anniversary'] = $this->ticketModel->anniversary();
    $data['VisitDue'] = $this->ticketModel->visitdue();
    return $data;
  }
  public function ManagerDashboard($userData)
  {
  }
  public function OperatoinDashboard($userData)
  {
    $data = [];
    $data['getReport'] = $this->WorkmModel->getReport();
    return $data;
  }
  public function staffDashboard($userData)
  {
    $data = [];
    $data['pendingtickets'] = $this->ticketModel->getPendingTickets(['team_id' => $userData['team_id'], 'tk_status' => 1]);
    $data['pendingRenewal'] = $this->ticketModel->getRenewals(['inv_user_id' => $userData['team_id']]);
    $data['birthdays'] = $this->ticketModel->birthdays(['cus_team_id' => $userData['team_id']]);
    $data['anniversary'] = $this->ticketModel->anniversary(['cus_team_id' => $userData['team_id']]);
    $data['listcustomer'] = $this->ticketModel->customerList(['cus_team_id' => $userData['team_id']]);

    return $data;
  }
  public function PageNotFound($userData)
  {
  }
}
