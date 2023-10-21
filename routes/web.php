<?php

use  \App\Library\Arraydb as arraydb;
   Auth::routes();
   Route::get('/admin/', function () {
    return redirect()->route('wpanelLogin');
 });

Route::get('/sitemap.xml',function(){
    $blog = DB::table('entry_blog')->select('blog_name')->get();
    $categrorydropdown = \App\Model\Entry\ProjectCategory_model::get();
    $sampleproject = \App\Model\Entry\Project_model::select('slug')->latest()->get();
    $services = \App\Model\Entry\Service_model::select('services_name')->get();
    $xml = View::make('sitemap',compact('blog','categrorydropdown','sampleproject','services'));
    return Response::make($xml, 200)->header('Content-Type', 'application/xml');
});

Route::get('paynow', 'Paymentgetway@index')->name('paynow');
Route::get('payment/quick-checkout/{any?}', 'Paymentgetway@quickCheckout')->name('quickCheckout');
Route::get('payment/success/{any?}', 'Paymentgetway@success')->name('success');
Route::get('payment/failed/{any?}', 'Paymentgetway@failed')->name('failed');
Route::get('payment/pdf', 'Paymentgetway@pdf')->name('pdf');
Route::post('/payment/savePaymentDetails','Paymentgetway@savePaymentDetails')->name('savePaymentDetails');
Route::post('/payment/Paymentfailed','Paymentgetway@Paymentfailed')->name('Paymentfailed');
Route::post('/payment/PaymentSuccess','Paymentgetway@PaymentSuccess')->name('PaymentSuccess');
Route::get('/payment/PayUBiz/{any?}','Paymentgetway@PayUBiz')->name('PayUBiz');
Route::get('/{id?}', 'HomeController@index')->name('home');
Route::get('document/{any?}', 'HomeController@documentdemo')->name('documentdemo');
Route::get('faq/{any?}', 'HomeController@faqpages')->name('faqpages');
Route::get('confirmorder/{any?}', 'QueryController@confirmorder')->name('confirmorder');
Route::get('/query/varifyemail','QueryController@varifyemail')->name('varifyemail');
Route::get('/query/varifyphone','QueryController@varifyphone')->name('varifyphone');
Route::get('sample-project/{any?}', 'HomeController@sample_project')->name('sample-project');
Route::get('/admin/user/logout', 'Admin\UserController@logout')->name('wpanelLogout');
Route::get('/admin/user/login', 'Admin\UserController@login')->name('wpanelLogin');
Route::post('/admin/user/checklogin', 'Admin\UserController@checklogin')->name('wpanelCheckLogin');
Route::post('/query/saveQuery','QueryController@saveQuery');
Route::post('/search/searchQuery','HomeController@searchQuery');
Route::post('/query/saveQueryModal','QueryController@saveQueryModal');
Route::post('/query/searcholduser','QueryController@searcholduser');
Route::post('/query/searcholduserdetails','QueryController@searcholduserdetails');
Route::get('query/sendmail','QueryController@sendmail');
Route::post('/query/attlicateform','QueryController@attlicateform');
Route::post('/query/senddownloadlink','QueryController@senddownloadlink');
Route::post('/query/flform','QueryController@flform');
Route::post('/query/registration','QueryController@registration');
Route::post('/query/login','QueryController@login');
Route::post('/query/newsletter','QueryController@newsletter');
Route::post('/query/addblog','QueryController@addblog');
Route::get('/query/logout','QueryController@logout');
Route::get('document/{any?}', 'HomeController@documentdemo')->name('documentdemo');
Route::get('ordernow', 'HomeController@ordernow')->name('ordernow');
Route::get('/data/save/{any?}','QueryController@datasave');
 //bloger form
Route::post('/query/blogerRegistration','BlogerController@blogerRegistration');
Route::get('/query/blogerVarifyemail','BlogerController@blogerVarifyemail')->name('blogerVarifyemail');
Route::get('/Query/blogerverification/{slug}','BlogerController@blogerverification');
Route::post('/query/blogerlogin','BlogerController@blogerlogin');
Route::post('/query/addUserBlog','BlogerController@addUserBlog');
Route::get('/query/deleteUserBlog/{any}','BlogerController@deleteUserBlog')->name('deleteUserBlog');
Route::get('/query/editUserBlog/{any}','BlogerController@editUserBlog')->name('editUserBlog');
Route::post('/query/updateUserBlog','BlogerController@updateUserBlog');
Route::get('/temp/clear-temp-sy', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
 });
Route::get('/pagenotfound', function() {
    return view('pagenotfound');
})->name('pageNotFoundFirst');
Route::get('admin/user/permissiondenied','Admin\UserController@permissiondenied')->name('permissiondenied'); 
Route::get('admin/user/profile','Admin\UserController@profile');
Route::post('admin/user/changepassword','Admin\UserController@changepassword');
Route::get('blog/{slug}','BlogController@blogpage')->name('blogpage');
Route::get('services/{slug}','BlogController@servicespage')->name('servicespage');
Route::get('projectview/{slug}','ProjectviewController@index')->name('projectview');
Route::group(['middleware'=>['customAuth']],function(){
    $logintype = arraydb::$loginUsers;
     unset($logintype['']);
   foreach($logintype as $key => $tk){
    $record = DB::table('route_permission')->Join('permission_allotment','pr_parent_id','=','route_id')->where('pr_group_id','=',$key)->get();
     if(!empty($record)){
        foreach($record as $rk){
           if($rk->route_type == 1){
             Route::resource($rk->route_key,$rk->route_value);
            }else{
              Route::get($rk->route_key,$rk->route_value);
            }
         }
     }
  }
 });

Route::get('blogs/{slug}','BlogsController@index');
Route::get('videolist/pl','VideolistController@pl');
Route::get('city/mj/{slug}','CityController@mj');
Route::get('city/mt/{slug}','CityController@mt');
Route::get('admin/entry/myclientorders/excelfile/{any?}', 'Admin\Entry\MyClientOrdersController@excelfile')->name('excelfile');
Route::get('admin/entry/myclientorders/trackstatus/{any?}', 'Admin\Entry\MyClientOrdersController@trackstatus')->name('trackstatus');
Route::get('admin/DashboardController/getAdminData', 'Admin\DashboardController@getAdminData')->name('getAdminData');
Route::get('admin/entry/myclientorders/copyorder/{any?}', 'Admin\Entry\OrdersController@copyorder')->name('copyorder');
Route::get('admin/entry/myclientorders/copyCsvData', 'Admin\Entry\MyClientOrdersController@copyCsvData')->name('copyCsvData');
Route::get('admin/entry/ordersController/resendmail', 'Admin\Entry\OrdersController@resendmail')->name('resendmail');
Route::get('admin/client/statusupdate/{id?}/{any?}', 'Admin\Entry\ClientsController@statusupdate')->name('admin.client.statusupdate');
Route::resource('admin/entry/paymentdetails','Admin\Entry\PaymentDetails');
Route::post('entry/homeoffere/updatevalue','Admin\Entry\HomeoffereController@updatevalue')->name('updatevalue');
Route::post('entry/homeoffere/updatepaymentvalue','Admin\Entry\HomeoffereController@updatepaymentvalue')->name('updatepaymentvalue');
Route::resource('admin/entry/myclients','Admin\Entry\ClientsController');
Route::resource('admin/entry/myclientorders','Admin\Entry\MyClientOrdersController');
Route::get('admin/entry/client-work-status/{any?}', 'Admin\Entry\ClientOrderStatusController@index')->name('admin.entry.client-work-status');
Route::get('admin/entry/client-work-status/create/{any?}', 'Admin\Entry\ClientOrderStatusController@create')->name('admin.entry.client-work-status.create');
Route::post('admin/entry/client-work-status/store/{any?}', 'Admin\Entry\ClientOrderStatusController@store')->name('admin.entry.client-work-status.store');
Route::get('admin/entry/orders/production-cost', 'Admin\Entry\OrdersController@productionCost')->name('admin.entry.orders.production-cost');
Route::get('admin/entry/orders/add-production-cost/{any?}', 'Admin\Entry\OrdersController@addProductionCost')->name('admin.entry.orders.production-cost.add');
Route::post('admin/entry/orders/store-production-cost', 'Admin\Entry\OrdersController@storeProductionCost')->name('admin.entry.orders.production-cost.store');
Route::get('admin/entry/orders/remove-production-cost/{id?}', 'Admin\Entry\OrdersController@removeProductionCost')->name('admin.entry.orders.production-cost.remove');
Route::get('admin/master/team/status/{id?}/{any?}', 'Admin\Master\TeamController@status')->name('admin.masters.status.update');

Route::post('admin/entry/myclients/clientDataDownloadCSV/{any?}','Admin\Entry\ClientsController@clientDataDownloadCSV')->name('admin.entry.myclients.clientDataDownloadCSV');
Route::get('admin/entry/myclients/userData/{any?}','Admin\Entry\ClientsController@userData')->name('admin.entry.myclients.userData');

Route::resource('admin/entry/blogs','Admin\Entry\BlogsController');
Route::resource('admin/entry/orders','Admin\Entry\OrdersController');
Route::resource('admin/entry/project','Admin\Entry\ProjectviewController');
Route::resource('admin/entry/affiliatesdata','Admin\Entry\AffiliatesdataController');
Route::resource('admin/entry/category','Admin\Entry\ProjectCategoryController');
Route::resource('admin/entry/faqcategory','Admin\Entry\FaqCategoryController');
Route::resource('admin/entry/rmiduser','Admin\Entry\RmidusersController');
Route::resource('admin/entry/downloadusers','Admin\Entry\DownloaduserController');
Route::resource('admin/entry/testinomials','Admin\Entry\TestinomialsController');
Route::resource('admin/entry/homevideos','Admin\Entry\HomevideosController');
Route::resource('admin/entry/populars','Admin\Entry\PopularsController');
Route::resource('admin/entry/experiencecity','Admin\Entry\ExperiencecityController');
Route::resource('admin/entry/city','Admin\Entry\CityController');
Route::resource('admin/entry/travel','Admin\Entry\TravelController');
Route::resource('admin/entry/media','Admin\Entry\MediaController');
Route::resource('admin/entry/place','Admin\Entry\PlaceController');
Route::resource('admin/entry/majarattraction','Admin\Entry\MajarattractionController');

Route::get('city/{slug}/{id}','CityController@citypage');
Route::get('event/{slug}','EventController@index');
Route::get('popularindia/{slug}','PopularindiaController@index'); 
Route::get('admin/entry/renewal/indexpage/{slug}','Admin\Entry\RenewalController@indexpage')->name('renewal');
Route::get('admin/entry/workentry/getvalue/{slug}','Admin\Entry\WorkentryController@getvalue')->name('getvalue');
Route::get('admin/entry/renewal/renewableCreate/{slug}','Admin\Entry\RenewalController@renewableCreate')->name('renewableCreate');
Route::post('admin/entry/renewal/storerenewal','Admin\Entry\RenewalController@storerenewal')->name('storerenewal');
Route::post('admin/uploadfile/ajaxUploadFile', 'Admin\UploadfileController@ajaxUploadFile')->name('ajaxUploadFile');
Route::post('admin/uploadfile/ajaxuploadimage', 'Admin\UploadfileController@ajaxuploadimage')->name('ajaxuploadimage');
Route::post('admin/uploadfile/uploadDocs', 'Admin\UploadfileController@uploadDocs')->name('uploadDocs');
Route::get('admin/uploadfile/deleteDocs', 'Admin\UploadfileController@deleteDocs')->name('deleteDocs');
Route::post('admin/uploadfile/deletefile', 'Admin\UploadfileController@deletefile')->name('deletefile');
Route::get('admin/entry/visits/getvisitDropdown/{slug}/{id?}', 'Admin\Entry\VisitsController@getvisitDropdown')->name('getvisitDropdown');
Route::get('admin/entry/operationentry/getvalue/{slug}/{id?}', 'Admin\Entry\OperationentryController@getvalue');
Route::get('admin/report/customeraccount/getDetials/{slug}','Admin\Report\CustomeraccountController@getDetials');//->name('getDetials');
Route::get('admin/report/employeereport/getfullDetials/{slug}','Admin\Report\EmployeereportController@getfullDetials');
Route::get('admin/report/expensereport/getExcelDownload','Admin\Report\ExpensereportController@getExcelDownload');
Route::get('admin/report/customeraccount/getExcelDownload','Admin\Report\CustomeraccountController@getExcelDownload');
Route::get('admin/report/employeereport/getExcelDownload','Admin\Report\EmployeereportController@getExcelDownload');
Route::get('admin/report/investmentreport/getExcelDownload','Admin\Report\InvestmentreportController@getExcelDownload');
Route::get('admin/report/misellinouesreport/getExcelDownload','Admin\Report\MiselliouesreportController@getExcelDownload');
Route::get('admin/report/operationreport/getExcelDownload','Admin\Report\OperationreportController@getExcelDownload');
Route::get('admin/entry/events/delete/{slug}','Admin\Entry\EventsController@delete');
Route::get('admin/entry/services/delete/{slug}','Admin\Entry\ServicesController@delete');
Route::get('admin/entry/category/delete/{slug}','Admin\Entry\ProjectCategoryController@delete');
Route::get('admin/entry/faqcategory/delete/{slug}','Admin\Entry\FaqCategoryController@delete');
Route::get('admin/entry/rmiduser/delete/{slug}','Admin\Entry\RmidusersController@delete');
Route::get('admin/entry/videogallery/delete/{slug}','Admin\Entry\VideogalleryController@delete');
Route::get('admin/entry/enquiry/delete/{slug}','Admin\Entry\EnquiryController@delete');
Route::get('admin/entry/project/delete/{slug}','Admin\Entry\ProjectviewController@delete');
Route::get('admin/entry/homevideos/delete/{slug}','Admin\Entry\HomevideosController@delete');
Route::get('admin/entry/testinomials/delete/{slug}','Admin\Entry\TestinomialsController@delete');
Route::get('admin/entry/blogs/delete/{slug}','Admin\Entry\BlogsController@delete');
Route::get('admin/entry/populars/delete/{slug}','Admin\Entry\PopularsController@delete');
Route::get('admin/entry/place/delete/{slug}','Admin\Entry\PlaceController@delete');
Route::get('admin/entry/experiencecity/delete/{slug}','Admin\Entry\ExperiencecityController@delete');
Route::get('admin/entry/travel/delete/{slug}','Admin\Entry\TravelController@delete');
Route::get('admin/entry/media/delete/{slug}','Admin\Entry\MediaController@delete');
Route::get('admin/master/team/delete/{slug}','Admin\Master\TeamController@delete');
Route::get('admin/entry/majarattraction/delete/{slug}','Wpanel\Entry\MajarattractionController@delete');
Route::get('admin/entry/quickpayment/delete/{slug}','Admin\Entry\QuickpaymentController@delete');
Route::get('admin/entry/flregistration/delete/{slug}','Admin\Entry\FlregistrationController@delete');
