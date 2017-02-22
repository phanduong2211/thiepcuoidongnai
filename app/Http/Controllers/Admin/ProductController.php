<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use Input;
use Redirect;
use View;
use File;
use Session;
use DB;
use App\Http\Module\product;
use App\Http\Module\menu;
use App\Http\Module\category;
use App\Http\Module\tab_category;
use App\Http\Module\detailproduct;
use App\Http\Module\wishlist;
use App\Http\Module\detailorder;

class ProductController extends BaseController
{

	public function index(){

		$bin=0;

		$sortf="product.id";
		$sorttype="desc";

		if(Input::exists('s')){
			switch (Input::get('s')) {
				case '2':
					$sorttype="asc";
					break;
				case '3':
					$sortf="product.name";
					$sorttype="asc";
					break;
				case '4':
					$sortf="quantity";
					$sorttype="desc";
					break;
				case '5':
					$sortf="price";
					$sorttype="desc";
					break;
				case '6':
					$sortf="promotion_price";
					$sorttype="desc";
					break;
				case '7':
					$sortf="original_price";
					$sorttype="desc";
					break;
				case '8':
					$sortf="product.created_at";
					$sorttype="desc";
					break;
				case '9':
					$sortf="product.updated_at";
					$sorttype="desc";
					break;
			}
		}

		$data=product::select('product.*','admin.name as nameuser','category.name as namec')->join('admin','product.user','=','admin.id')->join('category','product.categoryID','=','category.id')->orderBy($sortf,$sorttype)->where('bin',$bin);

		if(Input::exists('f')){
			switch (Input::get('f')) {
				case '1':
					$data=$data->where('admin.id',Session::get('logininfo')->id);
					break;
				case '2':
					$data=$data->where('price','<>',DB::raw('promotion_price'));
					break;
				case '3':
					$data=$data->where('price',DB::raw('promotion_price'));
					break;
				case '4':
					$data=$data->where('status','new');
					break;
				case '5':
					$data=$data->where('status','hot');
					break;
				case '6':
					$data=$data->where('status','over');
					break;
				case '7':
					$data=$data->where('status','sell');
					break;
				case '8':
					$data=$data->where('status','promotion');
					break;
				case '9':
					$data=$data->where('status','Ngừng Kinh Doanh');
					break;
				case '10':
					$data=$data->where('quantity','<',10);
					break;
				case '11':
					$data=$data->where('display',1);
					break;
				case '12':
					$data=$data->where('display',0);
					break;
				
			}
		}

		if(Input::exists('q')){
			$query=trim(Input::get('q'));
			if($query!=""){
				$data=$data->where(function($q) use ($query){
						$q->where('product.name','like','%'.$query.'%');
						$tien=preg_replace("/(\.|-| |\,)*/", "",$query);
						$q->orWhere('promotion_price',$tien);
						$q->orWhere('original_price',$tien);
						$q->orWhere('price',$tien);
						$q->orWhere('quantity',$query);
						$q->orWhere('admin.name',$query);
						$q->orWhere('category.name','like','%'.$query.'%');
					});
			}
		}

		
		$data=$data->paginate(15);
		return View::make("admin.product.index",array('data'=>$data));
	}

	public function recyclebin(){
		$bin=1;

		if(!Input::exists('s') && !Input::exists('q')){
			$data=product::select('product.*','admin.name as nameuser','category.name as namec')->join('admin','product.user','=','admin.id')->join('category','product.categoryID','=','category.id')->where('bin',$bin)->orderBy('id','desc')->paginate(15);
		}else{
			if(Input::exists('q')){
				$query=trim(Input::get('q'));
				if($query!=""){
					
					$data=product::select('product.*','admin.name as nameuser','category.name as namec')->join('admin','product.user','=','admin.id')->join('category','product.categoryID','=','category.id')->where('bin',$bin)->orderBy('id','desc')->where(function($q) use ($query){
						$q->where('product.name','like','%'.$query.'%');
						$q->orWhere('promotion_price',preg_replace("/(\.|-| |\,)*/", "",$query));
						$q->orWhere('original_price',preg_replace("/(\.|-| |\,)*/", "",$query));
						$q->orWhere('price',preg_replace("/(\.|-| |\,)*/", "",$query));
						$q->orWhere('quantity',$query);
						$q->orWhere('admin.name',$query);
						$q->orWhere('category.name','like','%'.$query.'%');
					})->paginate(15);
				}else{
					$data=product::select('product.*','admin.name as nameuser','category.name as namec')->join('admin','product.user','=','admin.id')->join('category','product.categoryID','=','category.id')->where('bin',$bin)->orderBy('id','desc')->paginate(15);
				}
			}else{
				if(Input::exists('s')){
					switch (Input::get('s')) {
						case '2':
							$data=product::select('product.*','admin.name as nameuser','category.name as namec')->join('admin','product.user','=','admin.id')->join('category','product.categoryID','=','category.id')->where('bin',$bin)->orderBy('id','asc')->paginate(15);
							break;
						case '3':
							$data=product::select('product.*','admin.name as nameuser','category.name as namec')->join('admin','product.user','=','admin.id')->join('category','product.categoryID','=','category.id')->where('bin',$bin)->orderBy('name','asc')->paginate(15);
							break;
						case '4':
							$data=product::select('product.*','admin.name as nameuser','category.name as namec')->join('admin','product.user','=','admin.id')->join('category','product.categoryID','=','category.id')->where('bin',$bin)->orderBy('created_at','desc')->paginate(15);
							break;
						case '5':
							$data=product::select('product.*','admin.name as nameuser','category.name as namec')->join('admin','product.user','=','admin.id')->join('category','product.categoryID','=','category.id')->where('bin',$bin)->orderBy('updated_at','desc')->paginate(15);
							break;
						
						default:
							$data=product::select('product.*','admin.name as nameuser','category.name as namec')->join('admin','product.user','=','admin.id')->join('category','product.categoryID','=','category.id')->where('bin',$bin)->orderBy('id','desc')->paginate(15);
							break;
					}
				}
			}
		}
		return View::make("admin.product.bin",array('data'=>$data));
	}

	public function add()
	{
		$data=array();
		$data['datamenu']=menu::select('id','name','root')->where('url','')->get();
		$data['datacategory']=category::select('id','name')->get();
		$data['datatabcategory']=tab_category::select('id','name')->get();

		return View::make("admin.product.add",$data);
	}


	public function save()
	{
		$product=new product();

	
		$data=array(
			'name'=>str_replace("\"", "'", trim(Input::get('name'))),
			'promotion_price'=>preg_replace("/(\.|-| |\,)*/", "", trim(Input::get('promotion_price'))),
			'price'=>preg_replace("/(\.|-| |\,)*/", "", trim(Input::get('price'))),
			'image'=>Input::get('image'),
			'quantity'=>Input::get('quantity'),
			'status'=>Input::get('status'),
			'view'=>0,
			'user'=>Session::get('logininfo')->id,
			'tab_categoryID'=>Input::get('tab_categoryID'),
			'categoryID'=>Input::get('categoryID'),
			'menuID'=>Input::get('menuID'),
			'display'=>Input::get('display')=="on"?1:0,
			'bin'=>0,
			'original_price'=>preg_replace("/(\.|-| |\,)*/", "", trim(Input::get('original_price'))),
			'content'=>str_replace("\"", "'", trim(Input::get('content'))),
			'tagID'=>trim(Input::get('tagID'))
		);
		$product->fill($data);
		if($product->save()){
			$productdetail=new detailproduct();
			$datadetail=array(
				'size'=>Input::get('size'),
				'color'=>Input::get('color'),
				'productID'=>$product->id
			);
			$productdetail->fill($datadetail);
			$productdetail->save();
			return Redirect::to('admin/product/edit?id='.$product->id."#detail")->with(['message'=>'Thêm thành công sản phẩm "'.$product->name.'". Vui lòng nhập chi tiết cho sản phẩm.']);
		}else{
			return Redirect::to('admin/product/add')->with(['message'=>'Thêm sản phẩm thất bại.','dataold'=>$data]);
		}
	}	

	public function edit()
	{
		if(!Input::exists('id'))
			return Redirect::to('admin/product')->with(['message'=>'Vui lòng chọn 1 sản phẩm để sửa.']);
		$data=array();
		$data['data']=product::where('id',Input::get('id'))->first();
		if($data['data']==null)
			return Redirect::to('admin/product')->with(['message'=>'Sản phẩm không tồn tại.']);
		$data['datamenu']=menu::select('id','name','root')->where('url','')->get();
		$data['datacategory']=category::select('id','name')->get();
		$data['datatabcategory']=tab_category::select('id','name')->get();
		$data['detail']=detailproduct::where('productID',Input::get('id'))->first();
		return View::make("admin.product.edit",$data);
	}	

	public function saveedit()
	{
		$product=product::find(Input::get('idedit'));
		$data=array(
			'name'=>str_replace("\"", "'", trim(Input::get('name'))),
			'promotion_price'=>preg_replace("/(\.|-| |\,)*/", "", trim(Input::get('promotion_price'))),
			'price'=>preg_replace("/(\.|-| |\,)*/", "", trim(Input::get('price'))),
			'image'=>Input::get('image'),
			'quantity'=>Input::get('quantity'),
			'status'=>Input::get('status'),
			'tab_categoryID'=>Input::get('tab_categoryID'),
			'categoryID'=>Input::get('categoryID'),
			'menuID'=>Input::get('menuID'),
			'original_price'=>preg_replace("/(\.|-| |\,)*/", "", trim(Input::get('original_price'))),
			'content'=>str_replace("\"", "'", trim(Input::get('content'))),
			'tagID'=>trim(Input::get('tagID'))
		);
		$product->fill($data);
		if($product->update()){
			return Redirect::to('admin/product/edit?id='.$product->id)->with(['message'=>'Cập nhật thành công sản phẩm "'.$product->name.'"']);
		}else{
			return Redirect::to('admin/product/edit?id='.$product->id)->with(['message'=>'Cập nhật sản phẩm thất bại.']);
		}
	}	


	public function detail(){
		$productdetail=detailproduct::find(Input::get('idedit'));

		
		if(Input::exists('images')){
			$images="";
			foreach (Input::get('images') as $key => $value) {
				if($value!=""){
					$images.=$value.",";
				}
			}
			if($images!=""){
				$length=strlen($images);
				$images=substr($images, 0,$length-1);
				

				$productdetail->images=$images;
			}
		}

		if(Input::exists('silebar_images')){
			$silebar_images="";
			foreach (Input::get('silebar_images') as $key => $value) {
				if($value!=""){
					$silebar_images.=$value.",";
				}
			}
			if($silebar_images!=""){
				$length=strlen($silebar_images);
				$silebar_images=substr($silebar_images, 0,$length-1);
				$productdetail->silebar_images=$silebar_images;
			}
		}

		$productdetail->infomation=Input::get('infomation');
		$productdetail->size=Input::get('size');
		$productdetail->color=Input::get('color');
		$productdetail->data_sheet=Input::get('data_sheet');
		
		if($productdetail->update()){
			return Redirect::to('admin/product/edit?id='.Input::get('idproductedit').'#detail')->with(['message'=>'Cập nhật thành công chi tiết sản phẩm "'.Input::get('nameproductedit').'"']);
		}else{
			return Redirect::to('admin/product/edit?id='.Input::get('idproductedit').'#detail')->with(['message'=>'Cập nhật chi tiết sản phẩm "'.Input::get('nameproductedit').'" thất bại. Vui lòng thử lại']);
		}
	}

	public function addbin(){
		$product=product::find(Input::get('id'));
		$product->bin=1;
		if($product->update()){
			return 1;
		}else{
			return -1;
		}
	}

	public function restore(){
		$product=product::find(Input::get('id'));
		$product->bin=0;
		if($product->update()){
			return 1;
		}else{
			return -1;
		}
	}

	public function hidden(){
		$product=product::find(Input::get('id'));
		$product->display=(int)Input::get('flag');
		if($product->update()){
			return 1;
		}else{
			return -1;
		}
	}

	public function delete()
	{
		$order=detailorder::where('productID',Input::get('id'))->get();
		if(count($order)>0)
			return Redirect::to('admin/product/recyclebin')->with(['message'=>'Sản phẩm "'.Input::get('title').'" đã có đơn đặt hàng. Bạn không thể xóa.']);
		$product=product::find(Input::get('id'));
		if($product->delete()){
			DB::table('detailproduct')->where('productID',Input::get('id'))->delete();
			return Redirect::to('admin/product/recyclebin')->with(['message'=>'Xóa thành công sản phẩm "'.Input::get('title').'"']);
		}else{
			return Redirect::to('admin/product/recyclebin')->with(['message'=>'Có lỗi xóa sản phẩm "'.Input::get('title').'" thất bại. Vui lòng thử lại.']);
		}
		
	}	
}

?>