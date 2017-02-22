<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Http\Module\news;
use App\Http\Module\categorynews;
use Input;
use Session;
class NewsController extends Controller
{
	public function getIndex(){

		$ordercl="news.id";
		$ordertype="desc";

		if(Input::exists('s')){
			switch (Input::get('s')) {
				case '2':
					$ordertype="asc";
					break;
				case '3':
					$ordercl="news.name";
					$ordertype="asc";
					break;
				case '4':
					$ordercl="view";
					$ordertype="desc";
					break;
				case '5':
					$ordertype="admin.name";
					$ordertype="asc";
					break;
				case '6':
					$ordertype="categorynews.name";
					$ordertype="asc";
					break;
				case '7':
					$ordertype="news.created_at";
					$ordertype="desc";
					break;
				case '8':
					$ordertype="news.updated_at";
					$ordertype="desc";
					break;
			}
		}

		$data=news::select('news.*','admin.name as nameuser','categorynews.name as namec')->join('admin','news.user','=','admin.id')->join('categorynews','news.categoryNewsID','=','categorynews.id')->orderBy($ordercl,$ordertype);

		if(Input::exists('f')){
			switch (Input::get('f')) {
				case '1':
					$data=$data->where('admin.id',Session::get('logininfo')->id);
					break;
				case '2':
					$data=$data->where('view',0);
					break;
				case '3':
					$data=$data->where('display',1);
					break;
				case '4':
					$data=$data->where('display',0);
					break;
				
			}
		}

		if(Input::exists('q')){
			$query=trim(Input::get('q'));
			if($query!=""){
				$data=$data->where(function($q) use ($query){
						$q->where('news.name','like','%'.$query.'%');
						$q->orWhere('admin.name',$query);
						$q->orWhere('categorynews.name','like','%'.$query.'%');
						$q->orWhere('news.description','like','%'.$query.'%');
					});
			}
		}

		$data=$data->paginate(15);
		return view("admin.news.index",array('data'=>$data));
	}

	public function getAdd(){
		$data=categorynews::select('id','name')->get();
		return view('admin.news.add',array('data'=>$data));
	}

	public function postAdd(){
		$slide=new news();
		$data=array(
			'name'=>str_replace("\"", "'", trim(Input::get('name'))),
			'image'=>trim(Input::get('image')),
			'description'=>str_replace("\"", "'", trim(Input::get('description'))),
			'content'=>Input::get('content'),
			'view'=>0,
			'user'=>Session::get('logininfo')->id,
			'categoryNewsID'=>Input::get('categoryNewsId'),
			'display'=>1
		);
		$slide->fill($data);
		if($slide->save()){
			return redirect('admin/news/add')->with(['message'=>'Thêm thành công tin tức '.Input::get('name')]);
		}else{
			return view('admin.news.add')->with(['message'=>'Thêm thất bại. Vui lòng thử lại']);
		}
	}

	public function getEdit(){
		if(!Input::exists('id'))
			return redirect('admin/news')->with(['message'=>'Vui lòng chọn 1 tin tức để sửa.']);
		$news=new news();
		$data=$news->where('id',Input::get('id'))->first();
		if($data==null)
			return redirect('admin/news')->with(['message'=>'Tin Tức không tồn tại.']);
		$datac=categorynews::select('id','name')->get();
		return view("admin.news.edit",array('data'=>$data,'datac'=>$datac));
	}

	public function postEdit(){
		$news=news::find(Input::get('idedit'));
		
		$data=array(
			'name'=>str_replace("\"", "'", trim(Input::get('name'))),
			'image'=>trim(Input::get('image')),
			'description'=>str_replace("\"", "'", trim(Input::get('description'))),
			'content'=>Input::get('content'),
			'categoryNewsID'=>Input::get('categoryNewsId')
		);
		$news->fill($data);

		if($news->update()){
			return redirect('admin/news')->with(['message'=>'Cập nhật thành công tin tức "'.Input::get('name').'"']);
		}else{
			return redirect('admin/news/edit?id='.Input::get('idedit'))->with(['message'=>'Cập nhật thất bại. Vui lòng thử lại.']);
		}
	}

	public function postDelete(){
		$news=news::find(Input::get('id'));
		if($news->delete()){
			return redirect('admin/news')->with(['message'=>'Xóa thành công tin tức "'.Input::get('title').'"']);
		}else{
			return redirect('admin/news')->with(['message'=>'Xóa tin tức "'.Input::get('title').'" thất bại. Vui lòng thử lại.']);
		}
	}

	public function postHidden(){
		$news=news::find(Input::get('id'));
		$news->display=(int)Input::get('flag');
		if($news->update()){
			return 1;
		}else{
			return -1;
		}
	}

	public function getCategory(){
		$data=categorynews::orderBy('id','desc')->get();	

		return view("admin.news.category",array('data'=>$data));
	}



	public function postAddCategory(){
		$category= new categorynews();
		$category->fill(Input::get());
		if($category->save()){
			if(Input::exists('json')){
				$data=array(
					'id'=>$category->id,
					'name'=>$category->name,
					'created_at'=>$category->created_at,
					'updated_at'=>$category->updated_at
				);
				return json_encode(array('result'=>1,'message'=>'Thêm thành công loại tin tức '.Input::get('name'),'data'=>$data));
			}
			return redirect('admin/news/category')->with(['message'=>'Thêm thành công loại tin tức '.Input::get('name')]);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Vui lòng thử lại'));
			}
			return redirect('admin/news/add-category')->with(['message'=>'Có lỗi. Vui lòng thử lại']);
		}
	}

	public function postEditCategory()
	{
		$category=categorynews::find(Input::get('idedit'));
		$category->fill(Input::get());

		if($category->update()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1,'message'=>'Cập nhật thành công'));
			}
			return redirect('admin/news/category')->with(['message'=>'Cập nhật thành công loại tin tức '.Input::get('name')]);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Cập nhật thất bại. Vui lòng thử lại'));
			}
			return redirect('admin/news/edit-category?id='.Input::get('idedit'))->with(['message'=>'Cập nhật thất bại. Vui lòng thử lại.']);
		}
	}	
	
	public function postDeleteCategory()
	{
		$news=news::where('categoryNewsID',Input::get('id'))->get();
		if(count($news)>0){
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Loại tin tức "'.Input::get('title').'" đã có tin tức. Không thể xóa'));
			}
			return redirect('admin/news/category')->with(['message'=>'Loại tin tức "'.Input::get('title').'" đã có tin tức. Không thể xóa']);
		}
		$category=categorynews::find(Input::get('id'));


		if($category->delete()){
			if(Input::exists('json')){
				return json_encode(array('result'=>1));
			}
			return redirect('admin/news/category')->with(['message'=>'Xóa thành công loại tin tức "'.Input::get('title').'"']);
		}else{
			if(Input::exists('json')){
				return json_encode(array('result'=>-1,'message'=>'Có lỗi. Xóa thất bại'));
			}
			return redirect('admin/news/category')->with(['message'=>'Xóa thất bại. Vui lòng thử lại']);
		}
		
	}	
}

?>