<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use Input;
use Session;
use View;
use Redirect;
use App\Http\Module\menu;
use App\Http\Module\product;
use App\Http\Module\info;
use App\Http\Module\page;

class WebsiteController extends BaseController
{
	public function menu()
	{
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$data=menu::orderBy('id','desc')->get();	
		$page=page::select('name','url')->orderBy('id','desc')->get();
	
		return View::make("admin.website.menu",array('datap'=>$page,'data'=>$data));
	}	
	

	public function savemenu()
	{
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$menu= new menu();

		$url=trim(Input::get('url'));

		if($url!='')
			$url='pages/'.$url;

		$data=array(
			'name'=>str_replace("\"", "'", trim(Input::get('name'))),
			'root'=>Input::get('root'),
			'url'=>$url
		);

		if($data['root']==-1){
			return -1;
		}

		$menu->fill($data);
		if($menu->save()){
			if(Input::exists('json')){
				$data=array(
					'id'=>$menu->id,
					'name'=>$menu->name,
					'root'=>$menu->root,
					'url'=>str_replace("pages/","",$menu->url),
					'created_at'=>$menu->created_at,
					'updated_at'=>$menu->updated_at
				);
				return json_encode(array('result'=>1,'message'=>'Thêm thành công menu '.$data['name'],'data'=>$data));
			}
			
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Vui lòng thử lại'));
			}
			
		}
	}

	
	public function saveeditmenu()
	{
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$menu=menu::find(Input::get('idedit'));
		
		$url=trim(Input::get('url'));

		if($url!='')
			$url='pages/'.$url;

		$data=array(
			'name'=>str_replace("\"", "'", trim(Input::get('name'))),
			'root'=>Input::get('root'),
			'url'=>$url
		);
		if($data['root']==-1){
			return -1;
		}

		if($data['url']!='' && $menu->url==''){
			$product=product::where('menuID',Input::get('idedit'))->count();
			if($product>0){
				if(Input::exists('json')){
					return json_encode(array('result'=>-1,'message'=>'Menu này đã có sản phẩm. Không thể sửa url'));
				}
				
			}
		}

		$menu->fill($data);

		if($menu->update()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1,'message'=>'Cập nhật thành công'));
			}
			
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Cập nhật thất bại. Vui lòng thử lại'));
			}
			
		}
	}	

	public function deletemenu()
	{
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		if(Input::get("root")==="0"){
			$menu=menu::where('root',Input::get('id'))->get();
			if(count($menu)>0){
				if(Input::exists('json')){
					return json_encode(array('result'=>-1,'message'=>'Menu "'.Input::get('title').'" đã có menu con. Không thể xóa'));
				}
				
			}
		}
		if(Input::get("url2")==""){
			$product=product::where('menuID',Input::get('id'))->get();
			if(count($product)>0){
				if(Input::exists('json')){
					return json_encode(array('result'=>-1,'message'=>'Menu "'.Input::get('title').'" đã có sản phẩm. Không thể xóa'));
				}
			
			}
		}
		$menu=menu::find(Input::get('id'));
		if($menu->delete()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1));
			}
			
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Xóa thất bại'));
			}
			
		}
		
	}

	public function info(){
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$info=info::get();
		$data=array();
		foreach ($info as $key => $value) {
			$data[$value->name]=$value->contents;
		}
		
		return View::make("admin.website.info",array('data'=>$data));
	}	

	public function changelogo(){
		if(Input::file()) {
			$image = Input::file('logo');
			if($image->move(public_path('img/'),"logo.png")){
				return Redirect::to('admin/website/info')->with(['message'=>'Cập nhật thành công logo. Do cơ chế save cache của trình duyệt, có thể phải mất vài phút logo mới được cập nhật.']);
			}else{
				return Redirect::to('admin/website/info')->with(['message'=>'Cập nhật logo thất bại.']);
			}
		}
	}

	public function changefavicon(){
		if(Input::file()) {
			$image = Input::file('favicon');
			if($image->move(public_path('img/'),"favicon.png")){
				return Redirect::to('admin/website/info')->with(['message'=>'Cập nhật thành công favicon. Do cơ chế save cache của trình duyệt, có thể phải mất vài phút favicon mới được cập nhật.']);
			}else{
				return Redirect::to('admin/website/info')->with(['message'=>'Cập nhật favicon thất bại.']);
			}
		}
	}

	public function postinfoall(){
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$info=new info();
		$info->where('name','title')->update(array('contents'=>str_replace("\"", "'", trim(Input::get('title')))));
		$info->where('name','description')->update(array('contents'=>str_replace("\"", "'", trim(Input::get('description')))));
		$info->where('name','keyword')->update(array('contents'=>str_replace("\"", "'", trim(Input::get('keyword')))));
		$info->where('name','maps')->update(array('contents'=>Input::get('maps')));
		return Redirect::to('admin/website/info')->with(['message'=>'Cập nhật thành công thông tin chung.']);
	}

	public function postinfcontact(){
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$info=new info();
		$info->where('name','address')->update(array('contents'=>str_replace("\"", "'", trim(Input::get('address')))));
		$info->where('name','phone')->update(array('contents'=>Input::get('phone')));
		$info->where('name','email')->update(array('contents'=>Input::get('email')));
		$info->where('name','skype')->update(array('contents'=>Input::get('skype')));
		$info->where('name','facebook')->update(array('contents'=>Input::get('facebook')));
		$info->where('name','google')->update(array('contents'=>Input::get('google')));
		$info->where('name','twitter')->update(array('contents'=>Input::get('twitter')));
		return Redirect::to('admin/website/info')->with(['message'=>'Cập nhật thành công thông tin liên hệ.']);
	}

	public function changebrand(){
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$silebar_images="";
		if(Input::exists('silebar_images')){
		
			foreach (Input::get('silebar_images') as $key => $value) {
				if($value!=""){
					$silebar_images.=$value.",";
				}
			}
			if($silebar_images!=""){
				$length=strlen($silebar_images);
				$silebar_images=substr($silebar_images, 0,$length-1);
			}
		}
		
		$info=new info();
		$info->where('name','brand')->update(array('contents'=>$silebar_images));
		return Redirect::to('admin/website/info')->with(['message'=>'Cập nhật đối tác thành công.']);
	}

	public function note(){
		$data=info::select('contents')->where('name','note')->first();

		if($data==null){
			$data='';
		}else{
			$data=$data->contents;
		}

		return view('admin.website.note',array('data'=>$data));
	}

	public function postNote(){
		$info=new info();

		$data=info::select('contents')->where('name','note')->first();
		if($data==null){
			$info->insert(array('name'=>'note','contents'=>Input::get('note')));
			
		}else{
			$info->where('name','note')->update(array('contents'=>Input::get('note')));
		}
		return redirect('admin/website/note');
	}
	
}

?>