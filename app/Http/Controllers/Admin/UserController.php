<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use \App\Model\Login_model as login_model;
use \App\Model\Entry\RegisterMember_model as RegisterMember_model;
use \App\Model\Restmodel;
use Illuminate\Http\Request;
use  \App\Library\Arraydb as arraydb;
class UserController extends Controller


{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public $viewFolder ="user";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->viewFolder = 'admin/'.$this->viewFolder.'/';
        $this->viewData['viewFolder'] = $this->viewFolder;
        $this->viewData['teamType'] = \App\Library\Arraydb::$loginUsers;
        $this->arraydb = new arraydb;;
        $this->restModel= new Restmodel;
    }
    public function login()
    {
       $userData = session()->get('usersession');
        if (!empty($userData)){
          return redirect('admin/dashboard');
       } 

        $arrayTable = new  \App\Library\Arraydb;
        $data=array();
        $data['loginType'] = $arrayTable::$loginUsers;
        $sessionTable = new \App\Model\Session;
        $session = $sessionTable->arrayTable('session_id','session_name');
        $data['session'] = $session;
        view()->share($data);
        return view($this->viewFolder.'login');
    }
    public function checklogin(Request $request)
    {

        $arrayTable = new  \App\Library\Arraydb;
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'session_nm'=>'required',
            'type'=>'required',
        ]);
    
        $credentials=['team_email'=>$request->input('email'),'team_password'=>$request->input('password'),'team_status'=>1];
        $response = login_model::CheckLoginCredentials($credentials);
        if(empty($response['status'])){
            $request->session()->flash('errorFlash',$response['message']);
            return redirect('admin/user/login');
        }else{
          $row = $response['data'];
          $rmUserData =  RegisterMember_model::where('email',$row->team_email)->first();
         if(empty($rmUserData)){
            $rm_id=0;
         }else{
           $rm_id=$rmUserData->id;
          }
    $sessionSet =  [
            "rm_id" => $rm_id,
            "team_id" => $row->team_id,
            "team_name" =>$row->team_name,
            "team_email" =>$row->team_email,
            "team_password" => $row->team_password,
            "team_dob" => $row->team_dob,
            "team_mob" =>$row->team_mob,
            "team_office_mob" =>$row->team_office_mob,
            "team_address" =>$row->team_address,
            "team_pan" => $row->team_pan,
            "team_addhar" => $row->team_addhar,
            "team_type" =>$row->team_type,
            "type_name"=>$arrayTable::$loginUsers[$row->team_type],
            "team_status" =>$row->team_status];
            $request->session()->put('user_id',$row->team_id);
            $request->session()->put('usersession',$sessionSet);
            return redirect('admin/dashboard');
        }
     }
    public function logout(){
        session()->forget('user_id');
        session()->forget('usersession');
        Auth::guard('admin')->logout();
        return \Redirect('admin/user/login');
    }
   public function profile(){
        $userData = session()->get('usersession');
        $this->viewData['title'] = 'Edit Profile';
        $this->viewData['row'] = $userData;
        $this->viewData['formAction'] = $this->viewFolder.'changepassword';
        view()->share($this->viewData);
        return view($this->viewFolder . 'profile');
     }

    public function changepassword(Request $request){

          $userData = session()->get('usersession');
          if(empty($request->currentpassword)){
               return $this->restModel->errorOut('Current password is required');
           }
           if(empty($request->newpassword)){
               return $this->restModel->errorOut('Current password is required');
           }
           if(empty($request->confirmpassword)){
               return $this->restModel->errorOut('Confirm  password is required');
           }
           if($request->newpassword != $request->confirmpassword){
                 return $this->restModel->errorOut('New password and Confirm  password is not match');
           }
           $credentials = [];
           $credentials['team_password'] =$request->currentpassword;
           $credentials['team_id'] = $userData['team_id'];
           $response = login_model::where($credentials)->first();
           if(empty($response)){
           return  $this->restModel->errorOut('Old password did not match');
           }
           $finduser = login_model::find($userData['team_id']);
           $finduser->team_password =$request->confirmpassword;
           if(!$finduser->save()){
            return $this->restModel->errorOut('Updated Failed');
           }
          return $this->restModel->successOut('successfully Updated');
     }
    public function permissiondenied()
    {
         
        return view($this->viewFolder.'pagenotfound');
    }
}
