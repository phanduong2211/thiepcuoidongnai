<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use Input;
use Redirect;
use View;
use App\Http\Module\tab_category;
use App\Http\Module\product;

class TabController extends BaseController
{

	public function index(){

		$tab_category=new tab_category();
		$data=$tab_category->orderBy('id','desc')->get();	
		return View::make("admin.tab.index",array('data'=>$data));
	}

	public function save()
	{
		$tab_category= new tab_category();
		$tab_category->fill(Input::get());
		if($tab_category->save()){
			if(Input::exists('json')){
				$data=array(
					'id'=>$tab_category->id,
					'name'=>$tab_category->name,
					'created_at'=>$tab_category->created_at,
					'updated_at'=>$tab_category->updated_at
				);
				return json_encode(array('result'=>1,'message'=>'Thêm thành công tab '.Input::get('name'),'data'=>$data));
			}
			return Redirect::to('admin/tab')->with(['message'=>'Thêm thành công tab '.Input::get('name')]);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Vui lòng thử lại'));
			}
			return Redirect::to('admin/tab/add')->with(['message'=>'Có lỗi. Vui lòng thử lại']);
		}
	}	

	public function saveedit()
	{
		$tab_category=tab_category::find(Input::get('idedit'));
		$tab_category->fill(Input::get());

		if($tab_category->update()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1,'message'=>'Cập nhật thành công'));
			}
			return Redirect::to('admin/tab')->with(['message'=>'Cập nhật thành công tab '.Input::get('name')]);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Cập nhật thất bại. Vui lòng thử lại'));
			}
			return Redirect::to('admin/tab/edit?id='.Input::get('idedit'))->with(['message'=>'Cập nhật thất bại. Vui lòng thử lại.']);
		}
	}	

	public function delete()
	{
		$product=product::where('tab_categoryID',Input::get('id'))->get();
		if(count($product)>0){
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Tab "'.Input::get('title').'" đã có sản phẩm. Không thể xóa'));
			}
			return Redirect::to('admin/category')->with(['message'=>'Tab "'.Input::get('title').'" đã có sản phẩm. Không thể xóa']);
		}
		$tab_category=tab_category::find(Input::get('id'));
		if($tab_category->delete()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1));
			}
			return Redirect::to('admin/tab')->with(['message'=>'Xóa thành công tab "'.Input::get('title').'"']);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Xóa thất bại'));
			}
			return Redirect::to('admin/tab')->with(['message'=>'Tab "'.Input::get('title').'" đã có nội dung hoặc sản phẩm. Không thể xóa']);
		}
		
	}	
}

?>