<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Http\Module\ads;
use Input;
use Session;
class AdsController extends Controller
{
	public function getIndex(){
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$data=ads::orderBy('id','desc')->get();
		return view("admin.ads.index",array('data'=>$data));
	}

	public function postAdd(){
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$ads=new ads();
		Input::merge(array('name' => str_replace("\"","'",trim(Input::get('name')))));
		
		$ads->fill(Input::get());

		if($ads->save()){
			$data=array(
					'id'=>$ads->id,
					'name'=>$ads->name,
					'image'=>$ads->image,
					'url'=>$ads->url,
					'type'=>$ads->type,
					'created_at'=>$ads->created_at,
					'updated_at'=>$ads->updated_at
				);
				return json_encode(array('result'=>1,'message'=>'Thêm thành công quảng cáo '.Input::get('name'),'data'=>$data));
		}else{
			return json_encode(array('result'=>-1,'message'=>'Có lỗi. Vui lòng thử lại'));
		}
	}

	public function postEdit(){
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$ads=ads::find(Input::get('idedit'));

		Input::merge(array('name' => str_replace("\"","'",trim(Input::get('name')))));
		

		$ads->fill(Input::get());

		if($ads->update()){
			return json_encode(array('result'=>1,'message'=>'Cập nhật thành công'));
			
		}else{
			return json_encode(array('result'=>-1,'message'=>'Cập nhật thất bại. Vui lòng thử lại'));
		}
	}

	public function postDelete(){
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$ads=ads::find(Input::get('id'));
		if($ads->delete()){
			return json_encode(array('result'=>1));
		}else{
			return json_encode(array('result'=>-1,'message'=>'Có lỗi. Xóa thất bại'));
		}
	}
}

?>