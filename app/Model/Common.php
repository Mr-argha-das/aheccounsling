<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request as rq;
use Hashids\Hashids;
use Illuminate\Support\Facades\Auth;

class Common extends Model
{
    public $pConfig;
    public $hashId;

    public function __construct(){
        $this->setSetings();

        $this->hashId = new Hashids(app_path(),'10');
        //$hashids->encode(1, 2, 3); // Z4UrtW

    }

    public function getUser()
    {
        $session = session('session_nm');
        if(empty($session))
        {
            return false;
        }

        if (!empty(Auth::guard('admin')->user())){
            $user  = Auth::guard('admin')->user();
            $user->sessionId = $session;
            return $user;
        }
        return false;
    }

    public function decode($id)
    {
        //echo $id;die();
        if(empty($id))
        {
            return false;
        }
        $decodeID = $this->hashId->decode($id);
      //  print_r($decodeID);die();
        if(empty($decodeID[0]))
        {
            return false;
        }
        return $decodeID[0];
    }

    public function setSetings()
    {
        $records = DB::table('project_config')->get();
        foreach ($records as $ob){
            $this->pConfig[$ob->setting_var] = $ob->setting_value;
        }
        $this->pConfig = (object) $this->pConfig;
        config()->set(['backendLayout'=>'backend']);
        $request = request();
        if($request->query->has('fancybox'))
        {
            config()->set(['backendLayout'=>'backendFancybox']);
        }
        //


        config()->set(['app.name'=>'AVI']);
        config()->set(['p'=>$this->pConfig]);
    }

    public function setPagination($dbObj,$perPage=NULL)
    {
        require_once (app_path() . '/Thirdparty/Zebra_Pagination.php');

        $records_per_page = empty($perPage)?$this->pConfig->adminRecordsPerPage:$perPage;

        $pagination = new \Zebra_Pagination();
        $pagination->records($dbObj->count());
        $pagination->records_per_page($records_per_page);
        $start = ($pagination->get_page() - 1) * $records_per_page;

        $records = $dbObj->offset($start)
            ->limit($records_per_page)
            ->get();

        return ['records'=>$records,'pagination'=>$pagination];
    }

    public function dropdownList($table,$id,$col)
    {
        $tableObj = DB::table($table);
        return $tableObj->pluck($col,$id);
    }


}
