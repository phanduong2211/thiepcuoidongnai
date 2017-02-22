<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Http\Module\admin;
use Input;
use Session;
class InfoController extends Controller
{
	public function getIndex(){
		
		return view("admin.info.index",array('data'=>admin::find(Session::get('logininfo')->id)));
	}

	public function postIndex(){
		$id=Session::get('logininfo')->id;

		$admin=new admin();

		if(Input::get('email')!=""){
			$email=$admin->where('email',Input::get('email'))->where('id','<>',$id)->get();

			if(count($email)>0){
				return redirect("admin/info")->with('message','Email '.Input::get('email').' đã tồn tại. Vui lòng điền email khác.');
			}
		}

		$username=$admin->where('username',Input::get('username'))->where('id','<>',$id)->get();

		if(count($username)>0){
		
			return redirect("admin/info")->with('message','Tài khoản '.Input::get('username').' đã tồn tại. Vui lòng điền tài khoản khác');
		}

		$admin=$admin->find($id);

		$nameuserold=$admin->name;

		$admin->fill(Input::get());

		if($admin->update()){
			if($nameuserold!=Input::get('name')){
				$info=Session::get('logininfo');
				$info->name=Input::get('name');
			}
			return redirect('admin/info')->with(['message'=>'Cập nhật thành công thông tin cá nhân']);
		}else{
			return redirect('admin/info')->with(['message'=>'Cập nhật thất bại. Vui lòng thử lại.']);
		}
	}


	public function getChangePass(){
		return view('admin.info.change');
	}

	public function postChangePass(){
		$id=Session::get('logininfo')->id;
		$admin=admin::find($id);

		if($admin->password!=md5(trim(Input::get('password')))){
			return redirect('admin/info/change-pass')->with(['message'=>'Mật khẩu cũ sai.']);
		}

		$admin->password=md5(trim(Input::get('newpassword')));

		if($admin->update()){
			return redirect('admin/info/change-pass')->with(['message'=>'Cập nhật mật khẩu thành công.']);
		}
		return redirect('admin/info/change-pass')->with(['message'=>'Cập nhật mật khẩu thất bại.']);

	}

	
}

?>