<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use Input;
use Redirect;
use View;
use App\Http\Module\category;
use App\Http\Module\product;

class CategoryAdminController extends BaseController
{

	public function index(){

		$category=new category();
		$data=$category->orderBy('id','desc')->get();	
		return View::make("admin.category.index",array('data'=>$data));
	}

	
	public function save()
	{
		$category= new category();
		$category->fill(Input::get());
		if($category->save()){
			if(Input::exists('json')){
				$data=array(
					'id'=>$category->id,
					'name'=>$category->name,
					'created_at'=>$category->created_at,
					'updated_at'=>$category->updated_at
				);
				return json_encode(array('result'=>1,'message'=>'Thêm thành công loại sản phẩm '.Input::get('name'),'data'=>$data));
			}
			return Redirect::to('admin/category')->with(['message'=>'Thêm thành công loại sản phẩm '.Input::get('name')]);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Vui lòng thử lại'));
			}
			return Redirect::to('admin/category/add')->with(['message'=>'Có lỗi. Vui lòng thử lại']);
		}
	}	

	public function saveedit()
	{
		$category=category::find(Input::get('idedit'));
		$category->fill(Input::get());

		if($category->update()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1,'message'=>'Cập nhật thành công'));
			}
			return Redirect::to('admin/category')->with(['message'=>'Cập nhật thành công loại sản phẩm '.Input::get('name')]);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Cập nhật thất bại. Vui lòng thử lại'));
			}
			return Redirect::to('admin/category/edit?id='.Input::get('idedit'))->with(['message'=>'Cập nhật thất bại. Vui lòng thử lại.']);
		}
	}	

	public function delete()
	{
		$product=product::where('categoryID',Input::get('id'))->get();
		if(count($product)>0){
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Loại sản phẩm "'.Input::get('title').'" đã có sản phẩm. Không thể xóa'));
			}
			return Redirect::to('admin/category')->with(['message'=>'Loại sản phẩm "'.Input::get('title').'" đã có sản phẩm. Không thể xóa']);
		}
		$category=category::find(Input::get('id'));
		if($category->delete()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1));
			}
			return Redirect::to('admin/category')->with(['message'=>'Xóa thành công loại sản phẩm "'.Input::get('title').'"']);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Xóa thất bại'));
			}
			return Redirect::to('admin/category')->with(['message'=>'Loại sản phẩm "'.Input::get('title').'" đã có sản phẩm. Không thể xóa']);
		}
		
	}	
}

?>