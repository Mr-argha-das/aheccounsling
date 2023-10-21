<?php
use Illuminate\Http\Request;
use \App\Model\Website\QueryModel as QueryModel;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api'], function(){

  Route::post('google_drive_file', 'UserApiController@google_drive_file');

 $bde_app_version = DB::table('app_version')->select('*')->where('status',1)->where('type','bde')->first();
Route::group(['prefix'=>$bde_app_version->version.'/ahec'], function(){
Route::post('country-code-list', 'ApiController@CountryCodeList');
Route::post('user/login', 'ApiController@userLogin');
Route::post('insertClientData', 'ApiController@insertClientData');
Route::post('updateClientData', 'ApiController@updateClientData');
Route::post('getClientData', 'ApiController@getClientData');
Route::post('deleteUserData', 'ApiController@deleteUserData');
Route::post('addOrder', 'ApiController@addOrder');
Route::post('searcholduser', 'ApiController@searcholduser');
Route::post('searcholduserdetails', 'ApiController@searcholduserdetails');
Route::post('getOrderData', 'ApiController@getOrderData');
Route::post('updateorderstatus', 'ApiController@updateorderstatus');
Route::post('updateOrderStatus', 'ApiController@updateOrderStatus');
Route::post('updateOrderData', 'ApiController@updateOrderData');
Route::post('checklogin', 'ApiController@checklogin');
Route::post('get-payment-getwaykey', 'ApiController@paymentGetwayKey');
Route::post('create-payment-link', 'ApiController@createpaymentlink');
Route::get('rm-list', 'ApiController@rmidList');
Route::get('services-list', 'ApiController@serviceList');
Route::get('currency-list', 'ApiController@currencyList');
Route::get('getClientList/{any?}', 'ApiController@getClientList');
Route::get('getOrderList/{any?}', 'ApiController@getOrderList');
Route::get('orderStatusApi', 'ApiController@orderStatusApi');
Route::get('addOrderClientList/{any?}', 'ApiController@addOrderClientList');
Route::get('trackstatus/{any?}', 'ApiController@trackstatus');
Route::get('getDashboardData/{any?}', 'ApiController@getDashboardData');
Route::get('get-payment-link/{any?}', 'ApiController@getpaymentlink');
Route::get('delete-payment-link/{any?}', 'ApiController@paymentlinkdelete');
Route::get('details-payment-link/{any?}', 'ApiController@paymentlinkdetails');
Route::get('getClientListfullByRm/{any?}', 'ApiController@getClientListfullByRm');
Route::post('uploadClientWorkFiles', 'UserApiController@uploadClientWorkFiles'); 

    Route::post('createWrite', 'ApiController@createWrite');
    Route::post('updateWrite', 'ApiController@updateWrite');
    Route::post('uploadsWriteDoc', 'ApiController@uploadsWriteDoc');
    Route::get('getWriteData/{any?}', 'ApiController@getWriteData');
    Route::get('getwriteorderlist/{any?}', 'ApiController@getWriteOrderList');
	
});
   
   $client_app_version = DB::table('app_version')->select('*')->where('status',1)->where('type','client')->first();
    Route::group(['prefix'=>$client_app_version->version.'/user'], function(){
    Route::post('checklogin', 'UserApiController@login');
    Route::post('forgetPassword', 'UserApiController@forgetPassword');
    Route::post('updatePassword', 'UserApiController@updatePassword');
    Route::post('checkUserloginByPhone', 'UserApiController@checkUserloginByPhone');
    Route::group(['middleware' => 'custom_auth'], function () {
        //  Route::get('getClientOrderList', 'UserApiController@getClientOrderList'); 	
         Route::get('getClientStatusList', 'UserApiController@getClientStatusList'); 	
         Route::get('getClientWorkFiles/{any?}', 'UserApiController@getClientWorkFiles'); 	
         Route::post('changePassword', 'UserApiController@changePassword');
         Route::post('updateProfileData', 'UserApiController@updateProfileData');
         Route::post('contantjsone', 'UserApiController@contantjsone');
     });
   });
 });
 
Route::get('/client/getClientOrderList/{any?}', function ($client_email, Request $request){
                
                 $orderList =  QueryModel::select('enquiry_user.*','register_member.name as rmName','register_member.symbol','register_member.rmid','entry_service.services_name')
                    ->where('en_email',$client_email)->orderBy('en_id','DESC')
                    ->join('register_member','rm_id','=','register_member.id')->Leftjoin('entry_service','services_id','=','en_service')
                    ->get();
                   
                 foreach ($orderList as $key => $workDetails) {
                         $order_number =$workDetails->rmid.'-'.date('d-m-y',$workDetails->tranxid).'_'.sprintf("%02d", $workDetails->order_number);
                         $data['order_title'] =$order_number.' | '.$workDetails->symbol.$workDetails->en_first_name.'_'.$workDetails->en_subject.'_'.$workDetails->module_name;
                         $orderList[$key]->order_thread=$order_number;
                     }

                  return response()->json([
                       'orderList'  =>$orderList,
                       'status' => 200,
                     ], 200);
});    