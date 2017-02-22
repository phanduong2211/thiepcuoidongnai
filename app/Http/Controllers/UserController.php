<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\user;
use Input;
use Session;
use Redirect;
use View;

class UserController extends Controller
{
    public static function getuser($id)
    {
    	return user::find($id);
        //user::find($id);
    }
    // đăng nhập tài khoản
    public function login()
    {
    	$email=Input::get("email");
    	$password=Input::get("password");
    	if(user::check_login($email,$password))
    	{
    		Session::put('login',true);    		
    		return Redirect::to("my-account.html");
    	}
    	Session::put('login',false);
    	return Redirect::to('registration.html');
    }
    // tạo tài khoản
    public function register()
    {
    	$data =Input::all();
    	if(user::check_user($data["email"]))
    	{

    		$user = new user();
    		$user->fill($data);
    		$user->save();
            $email=$data["email"];
            $password=$data["password"];
    		if(user::check_login($email,$password))
            {
                Session::put('login',true);         
                return Redirect::to("my-account.html");
            }
    	}
    	Session::put('email_register',false);
    	return Redirect::to('registration.html');
    }
    // kiểm tra login hay chưa
    public static function isLogin()
    {
        if(Session::has('login_userID'))
        {
            return true;
        }
        return false;
    }
    public static function updateUser()
    {
        //
        if(Session::has("login_userID"))
        {
            $user = user::find(Session::get("login_userID"));
            $user->fill(Input::all());
            $user->save();
            Session::put("updateSuccess",true);
            return Redirect::to("info-account.html");
        }
        else 
            return Redirect::to("registration.html");
    }
    public static function updatePass()
    {
        //
        if(Session::has("login_userID"))
        {
            if(Input::get("password") != Input::get("confirm_password"))
                Session::put("updateNotMath","false");
            else
            {
                $user = user::find(Session::get("login_userID"));
                if($user->password == Input::get("password_old"))
                    {
                        $user->fill(Input::all());
                        $user->save();
                        Session::put("updateSuccessPass","true");
                    }
                    else
                        Session::put("updateSuccessPass","false");
            }
            return Redirect::to("info-account.html");
        }
        else 
            return Redirect::to("registration.html");
    }
}
