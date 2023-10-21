<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use  \App\Library\Arraydb as arraydb;

 Auth::routes();

/*
if (Request::is('wpanel/*'))
{
   */
   Route::get('/wpanel/user/login', function () {
    return redirect()->route('wpanelLogin');
    return view('welcome');
});

 Route::get('/{id?}', 'HomeController@index')->name('home');
Route::get('/wpanel/user/logout', 'Wpanel\UserController@logout')->name('wpanelLogout');
Route::get('/wpanel/user/login', 'Wpanel\UserController@login')->name('wpanelLogin');
Route::post('/wpanel/user/checklogin', 'Wpanel\UserController@checklogin')->name('wpanelCheckLogin');

Route::get('/clear-temp-sy', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    //Artisan::call('config:cache');

    Artisan::call('view:clear');
    return "Cleared!";
});
Route::get('/pagenotfound', function() {
    return view('pagenotfound');
});
Route::get('wpanel/user/permissiondenied','Wpanel\UserController@permissiondenied')->name('permissiondenied');
Route::get('wpanel/user/profile','Wpanel\UserController@profile');
Route::post('wpanel/user/changepassword','Wpanel\UserController@changepassword');


Route::group(['middleware'=>['customAuth']],function(){
    $logintype = arraydb::$loginUsers;
unset($logintype['']);
    foreach($logintype as $key => $tk)
{
    $record = DB::table('route_permission')->Join('permission_allotment','pr_parent_id','=','route_id')->where('pr_group_id','=',$key)->get();
    if(!empty($record))
    {
        foreach($record as $rk)
        {
            if($rk->route_type == 1)
            {
               
             Route::resource($rk->route_key,$rk->route_value);
            }else{
              Route::get($rk->route_key,$rk->route_value);
            }
        }
    }
}
////////////////////// Start of Admin Route //////////////////////////////


});
Route::get('blogs/{slug}','BlogsController@index');
Route::get('videolist/pl','VideolistController@pl');
Route::get('city/mj/{slug}','CityController@mj');
Route::get('city/mt/{slug}','CityController@mt');
Route::resource('wpanel/entry/blogs','Wpanel\Entry\BlogsController');
Route::resource('wpanel/entry/testinomials','Wpanel\Entry\TestinomialsController');
Route::resource('wpanel/entry/homevideos','Wpanel\Entry\HomevideosController');
Route::resource('wpanel/entry/populars','Wpanel\Entry\PopularsController');
Route::resource('wpanel/entry/experiencecity','Wpanel\Entry\ExperiencecityController');
Route::resource('wpanel/entry/city','Wpanel\Entry\CityController');
Route::resource('wpanel/entry/travel','Wpanel\Entry\TravelController');
Route::resource('wpanel/entry/media','Wpanel\Entry\MediaController');
Route::resource('wpanel/entry/place','Wpanel\Entry\PlaceController');
Route::resource('wpanel/entry/majarattraction','Wpanel\Entry\MajarattractionController');
Route::get('city/{slug}/{id}','CityController@citypage');
Route::get('event/{slug}','EventController@index');
Route::get('popularindia/{slug}','PopularindiaController@index');
Route::get('wpanel/entry/renewal/indexpage/{slug}','Wpanel\Entry\RenewalController@indexpage')->name('renewal');
Route::get('wpanel/entry/workentry/getvalue/{slug}','Wpanel\Entry\WorkentryController@getvalue')->name('getvalue');
Route::get('wpanel/entry/renewal/renewableCreate/{slug}','Wpanel\Entry\RenewalController@renewableCreate')->name('renewableCreate');
Route::post('wpanel/entry/renewal/storerenewal','Wpanel\Entry\RenewalController@storerenewal')->name('storerenewal');

///// Image document  upload routes //////
Route::post('wpanel/uploadfile/ajaxUploadFile', 'Wpanel\UploadfileController@ajaxUploadFile')->name('ajaxUploadFile');
Route::post('wpanel/uploadfile/ajaxuploadimage', 'Wpanel\UploadfileController@ajaxuploadimage')->name('ajaxuploadimage');
Route::post('wpanel/uploadfile/uploadDocs', 'Wpanel\UploadfileController@uploadDocs')->name('uploadDocs');
Route::get('wpanel/uploadfile/deleteDocs', 'Wpanel\UploadfileController@deleteDocs')->name('deleteDocs');

Route::post('wpanel/uploadfile/deletefile', 'Wpanel\UploadfileController@deletefile')->name('deletefile');
Route::get('wpanel/entry/visits/getvisitDropdown/{slug}/{id?}', 'Wpanel\Entry\VisitsController@getvisitDropdown')->name('getvisitDropdown');
Route::get('wpanel/entry/operationentry/getvalue/{slug}/{id?}', 'Wpanel\Entry\OperationentryController@getvalue');

Route::get('wpanel/report/customeraccount/getDetials/{slug}','Wpanel\Report\CustomeraccountController@getDetials');//->name('getDetials');
Route::get('wpanel/report/employeereport/getfullDetials/{slug}','Wpanel\Report\EmployeereportController@getfullDetials');
Route::get('wpanel/report/expensereport/getExcelDownload','Wpanel\Report\ExpensereportController@getExcelDownload');

Route::get('wpanel/report/customeraccount/getExcelDownload','Wpanel\Report\CustomeraccountController@getExcelDownload');
Route::get('wpanel/report/employeereport/getExcelDownload','Wpanel\Report\EmployeereportController@getExcelDownload');
Route::get('wpanel/report/investmentreport/getExcelDownload','Wpanel\Report\InvestmentreportController@getExcelDownload');
Route::get('wpanel/report/misellinouesreport/getExcelDownload','Wpanel\Report\MiselliouesreportController@getExcelDownload');
Route::get('wpanel/report/operationreport/getExcelDownload','Wpanel\Report\OperationreportController@getExcelDownload');
/*}else{
    Route::get('/', 'HomeController@index')->name('home');
    $routeUrl = Request::path();
  
    if($routeUrl !='/' || (!empty($routeUrl)))
    {
        $findviewFile = DB::table('entry_menu')->Leftjoin('master_tpl','tpl_id','=','menu_cat_type')->where('menu_alias',$routeUrl)->first();
        if(!empty($findviewFile))
        {
            if(empty($findviewFile->tpl_file))
            {
              $findviewFile->tpl_file;
                 return view('tpl/'.$filename);
            }else{
                $filename = str_replace("-","_",$findviewFile->menu_alias);
                 return view('tpl/'.$filename);
            }
        }else{
             Route::get('/', 'HomeController@index')->name('home');
        }
    }else{
         Route::get('/', 'HomeController@index')->name('home');
    }
   
}*/

   




////////////////////////Start  Website Route ////////////////////////////////

//////////////////////// End of Website Route //////////////////////////////

