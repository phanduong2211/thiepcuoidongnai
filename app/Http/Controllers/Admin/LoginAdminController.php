<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Input;
use Session;
use Redirect;
use View;
use Cookie;
use App\Http\Module\Admin;

class LoginAdminController extends BaseController
{
	public function index()
	{
		if($this->isLogin()){
			return redirect('admin/index');
		}

		$redirect=(Input::exists("redirect"))?('?redirect='.Input::get("redirect")):'';

		if(Cookie::has('rem_login')){
			$result=Admin::get_userid(Cookie::get('rem_login'));
			if(is_object($result)){
				if($result->active==1){
					Session::put('logininfo',$result);
					if(Input::exists('redirect')){
						return Redirect::to(Input::get('redirect'));
					}
					return Redirect::to('admin');
				}else{
					return Redirect::to('admin/login'.$redirect)->with(['message'=>'Tài khoản '.$username.' đã bị khóa. Vui lòng liên hệ admin để biết thêm chi tiết.','username'=>$username]);
				}
			}
		}

		return View::make("admin.login");
	}	

	private function isLogin(){
		if(Session::has('logininfo')){
			return true;
		}
		return false;
	}

	public function login()
	{
		if($this->isLogin()){
			return redirect('admin/index');
		}

		$redirect=(Input::exists("redirect"))?('?redirect='.Input::get("redirect")):'';

		$username=trim(Input::get('username'));
		$password=trim(Input::get('password'));

		if(empty($username)){
			return Redirect::to('admin/login'.$redirect)->with(['message'=>'Vui lòng nhập tài khoản.','username'=>$username]);
		}

		if(empty($password)){
			return Redirect::to('admin/login'.$redirect)->with(['message'=>'Vui lòng nhập mật khẩu.','username'=>$username]);
		}

		$result=Admin::get_user($username,$password);
		if(is_object($result)){
			if($result->active==1){
				Session::put('logininfo',$result);
				if(Input::get('rememberme')==='on'){
					Cookie::queue('rem_login', $result->id,4800);
				}
				if(Input::exists('redirect')){
					return Redirect::to(Input::get('redirect'));
				}
				return Redirect::to('admin');
			}else{
				return Redirect::to('admin/login'.$redirect)->with(['message'=>'Tài khoản '.$username.' đã bị khóa. Vui lòng liên hệ admin để biết thêm chi tiết.','username'=>$username]);
			}
		}
		return Redirect::to('admin/login')->with(['message'=>'Tài khoản hoặc mật khẩu sai.','username'=>$username]);
	}

	public function logout()
	{
		if($this->isLogin()){
			Session::forget("logininfo");
			Cookie::queue(Cookie::forget('rem_login'));
		}
		return Redirect::to('admin/login');
	}	
}

?>