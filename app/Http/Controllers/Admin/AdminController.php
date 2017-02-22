<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Input;
use App\Http\Module\admin;
use App\Http\Module\product;
use App\Http\Module\news;
use Session;

class AdminController extends Controller
{
	public function getIndex()
	{
		if(Session::get('logininfo')->level!=1){
			return view('admin.error');
		}
		$data=admin::orderBy('id','desc')->get();

		return view("admin.admin.index",array('data'=>$data));
	}

	public function postAdd(){
		if(Session::get('logininfo')->level!=1){
			return view('admin.error');
		}
		$admin=new admin();

		if(Input::get('email')!=""){
			$email=$admin->where('email',Input::get('email'))->get();

			if(count($email)>0){
				if(Input::exists('json')){
					return json_encode(array('result'=>-1,'message'=>'Email '.Input::get('email').' đã tồn tại. Vui lòng điền email khác.'));
				}
				Session::flash('message', 'Email '.Input::get('email').' đã tồn tại. Vui lòng điền email khác.');
				return view("admin.admin.add");
			}
		}

		$username=$admin->where('username',Input::get('username'))->get();

		if(count($username)>0){
			if(Input::exists('json')){
					return json_encode(array('result'=>-1,'message'=>'Tài khoản '.Input::get('username').' đã tồn tại. Vui lòng điền tài khoản khác'));
				}
			Session::flash('message', 'Tài khoản '.Input::get('username').' đã tồn tại. Vui lòng điền tài khoản khác');
			return view("admin.admin.add");
		}
		Input::merge(array('password' => md5(Input::get('password'))));
		$admin->fill(Input::get());
		if($admin->save()){
			if(Input::exists('json')){
				$data=array(
					'id'=>$admin->id,
					'name'=>$admin->name,
					'username'=>$admin->username,
					'email'=>$admin->email,
					'phone'=>$admin->phone,
					'level'=>$admin->level,
					'created_at'=>$admin->created_at,
					'updated_at'=>$admin->updated_at
				);
				return json_encode(array('result'=>1,'message'=>'Thêm thành công QTV '.Input::get('name'),'data'=>$data));
			}
			return redirect('admin/ad')->with(['message'=>'Thêm thành công QTV "'.Input::get('name').'".']);
		}
		if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Vui lòng thử lại'));
			}
		Session::flash('message', 'Có lỗi. Vui lòng thử lại.');
		return view("admin.admin.add");
	}

	public function postEdit(){
		if(Session::get('logininfo')->level!=1){
			return view('admin.error');
		}
		$admin=new admin();

		if(Input::get('email')!=""){
			$email=$admin->where('email',Input::get('email'))->where('id','<>',Input::get('idedit'))->get();

			if(count($email)>0){
				if(Input::exists('json')){
					return json_encode(array('result'=>-1,'message'=>'Email '.Input::get('email').' đã tồn tại. Vui lòng điền email khác.'));
				}
				Session::flash('message', 'Email '.Input::get('email').' đã tồn tại. Vui lòng điền email khác.');
				return view("admin.admin.add");
			}
		}

		$username=$admin->where('username',Input::get('username'))->where('id','<>',Input::get('idedit'))->get();

		if(count($username)>0){
			if(Input::exists('json')){
					return json_encode(array('result'=>-1,'message'=>'Tài khoản '.Input::get('username').' đã tồn tại. Vui lòng điền tài khoản khác'));
				}
			Session::flash('message', 'Tài khoản '.Input::get('username').' đã tồn tại. Vui lòng điền tài khoản khác');
			return view("admin.admin.add");
		}

		$admin=$admin->find(Input::get('idedit'));
		$admin->fill(Input::get());

		if($admin->update()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1,'message'=>'Cập nhật thành công'));
			}
			return redirect('admin/ad')->with(['message'=>'Cập nhật thành công QTV '.Input::get('name')]);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Cập nhật thất bại. Vui lòng thử lại'));
			}
			return redirect('admin/ad/edit?id='.Input::get('idedit'))->with(['message'=>'Cập nhật thất bại. Vui lòng thử lại.']);
		}
	}

	public function postResetPass(){
		if(Session::get('logininfo')->level!=1){
			return view('admin.error');
		}
		$admin=admin::find(Input::get('id'));
		$admin->password=md5("123456");
		if($admin->update()){
			return json_encode(array('result'=>-1,'message'=>'Cập nhật thành công password. Password hiện tại là 123456'));
		}else{
			return json_encode(array('result'=>-1,'message'=>'Cập nhật password thất bại. Vui lòng thử lại.'));
		}
	}

	public function postDelete(){
		if(Session::get('logininfo')->level!=1){
			return view('admin.error');
		}
		$product=product::where('user',Input::get('id'))->get();
		if(count($product)>0){
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'QTV "'.Input::get('title').'" đã đăng sản phẩm. Không thể xóa'));
			}
			return redirect('admin/ad')->with(['message'=>'QTV "'.Input::get('title').'" đã đăng sản phẩm. Không thể xóa']);
		}
		$news=news::where('user',Input::get('id'))->get();
		if(count($news)>0){
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'QTV "'.Input::get('title').'" đã đăng tin tức. Không thể xóa'));
			}
			return redirect('admin/ad')->with(['message'=>'QTV "'.Input::get('title').'" đã đăng tin tức. Không thể xóa']);
		}
		$admin=admin::find(Input::get('id'));
		if($admin->delete()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1));
			}
			return redirect('admin/ad')->with(['message'=>'Xóa thành công QTV "'.Input::get('title').'"']);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Xóa thất bại'));
			}
			return redirect('admin/ad')->with(['message'=>'QTV "'.Input::get('title').'" đã có sản phẩm. Không thể xóa']);
		}
	}

	public function postActive(){
		$admin=admin::find(Input::get('id'));
		$admin->active=Input::get('loai');
		if($admin->update()){
			return 1;
		}
		return -1;
	}

	
}

?>