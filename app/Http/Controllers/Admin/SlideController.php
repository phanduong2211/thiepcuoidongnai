<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Http\Module\slideshow;
use App\Http\Module\category;
use Input;
use DB;
class SlideController extends Controller
{
	public function getIndex(){
		$slide=new slideshow();
		$data=$slide->select('slideshow.*',DB::raw("(case when page=0 then 'Trang Chu' else (select name from category where slideshow.page=category.id) end) as namepage"))->orderBy('id','desc')->get();	
		$datac=category::get();
		return view("admin.slide.index",array('data'=>$data,'datac'=>$datac));
	}

	public function postAdd(){
		$slide=new slideshow();
		Input::merge(array('name' => str_replace("\"","'",trim(Input::get('name')))));
		Input::merge(array('content' => str_replace("\"","'",trim(Input::get('content')))));
		$slide->fill(Input::get());
		if($slide->save()){
			if(Input::exists('json')){
				$data=array(
					'id'=>$slide->id,
					'name'=>$slide->name,
					'image'=>$slide->image,
					'content'=>$slide->content,
					'url'=>$slide->url,
					'page'=>$slide->page,
					'created_at'=>$slide->created_at,
					'updated_at'=>$slide->updated_at
				);
				return json_encode(array('result'=>1,'message'=>'Thêm thành công slide '.Input::get('name'),'data'=>$data));
			}
			return redirect('admin/slide')->with(['message'=>'Thêm thành công slide '.Input::get('name')]);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Vui lòng thử lại'));
			}
			return view('admin.slide.add')->with(['message'=>'Thêm thất bại. Vui lòng thử lại']);
		}
	}

	public function postEdit(){
		$slide=slideshow::find(Input::get('idedit'));

		Input::merge(array('name' => str_replace("\"","'",trim(Input::get('name')))));
		Input::merge(array('content' => str_replace("\"","'",trim(Input::get('content')))));

		$slide->fill(Input::get());

		if($slide->update()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1,'message'=>'Cập nhật thành công'));
			}
			return redirect('admin/slide')->with(['message'=>'Cập nhật thành công slide "'.Input::get('name').'"']);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Cập nhật thất bại. Vui lòng thử lại'));
			}
			return redirect('admin/slide/edit?id='.Input::get('idedit'))->with(['message'=>'Cập nhật thất bại. Vui lòng thử lại.']);
		}
	}

	public function postDelete(){
		$slideshow=slideshow::find(Input::get('id'));
		if($slideshow->delete()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1));
			}
			return redirect('admin/slide')->with(['message'=>'Xóa thành công slide "'.Input::get('title').'"']);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Xóa thất bại'));
			}
			return redirect('admin/slide')->with(['message'=>'Xóa slide "'.Input::get('title').'" thất bại. Vui lòng thử lại.']);
		}
	}
}

?>