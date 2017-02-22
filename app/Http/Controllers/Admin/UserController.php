<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Http\Module\user;
use App\Http\Module\order;
use Input;
use DB;
use Carbon\Carbon;
use Session;
class UserController extends Controller
{
	public function getIndex(){
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		if(!Input::exists('id')){
			$sortf="users.id";
			$sorttype="desc";

			if(Input::exists('s')){
				switch (Input::get('s')) {
					case '2':
						$sorttype="asc";
						break;
					case '3':
						$sortf="users.name";
						$sorttype="asc";
						break;
					case '4':
						$sortf="address";
						$sorttype="desc";
						break;
					case '5':
						$sortf="date";
						$sorttype="desc";
						break;
					
					case '6':
						$sortf="users.created_at";
						$sorttype="desc";
						break;
					case '7':
						$sortf="users.updated_at";
						$sorttype="desc";
						break;
				}
			}

			$data=user::select('users.*',DB::raw("(select count(id) from `order` where `order`.userID=users.id) as dh"))->orderBy($sortf,$sorttype);
			
			if(Input::exists('f')){
				switch (Input::get('f')) {
					case '1':
						$data=$data->where(DB::raw('(select count(id) from `order` where `order`.userID=users.id)'),0);
						break;
					case '2':
						$data=$data->where(DB::raw('(select count(id) from `order` where `order`.userID=users.id)'),'>',0);
						break;
					case '3':
						$mytime = Carbon::now();
						$data=$data->where(DB::raw('day(date)'),$mytime->day)->where(DB::raw('month(date)'),$mytime->month)->where(DB::raw('year(date)'),$mytime->year);
						break;
					case '4':
						$data=$data->where('active',0);
						break;
					case '5':
						$data=$data->where('active',1);
						break;
				}
			}

			if(Input::exists('q')){
				$query=trim(Input::get('q'));
				if($query!=""){
					$data=$data->where(function($q) use ($query){
							$q->where('users.name','like','%'.$query.'%');
							$q->orWhere('users.email','like','%'.$query.'%');
							$q->orWhere('users.phone','like','%'.$query.'%');
							$q->orWhere('users.address','like','%'.$query.'%');
							
							if(strtolower($query)=='nam')
								$q->orWhere('users.sex',1);
							if(strtolower($query)=='nu' || strtolower($query)=='nữ')
								$q->orWhere('users.sex',0);
						});
				}
			}

			$data=$data->paginate(15);
		}else{
			$data=user::select('users.*',DB::raw("(select count(id) from `order` where `order`.userID=users.id) as dh"))->where('id',Input::get('id'))->paginate(1);
		}
		return view("admin.user.index",array('data'=>$data));
	}

	public function postActive(){
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$user=user::find(Input::get('id'));
		$user->active=Input::get('loai');
		if($user->update()){
			return 1;
		}
		return -1;
	}

	public function postDelete(){
		if(Session::get('logininfo')->level==3){
			return view('admin.error');
		}
		$order=order::where('userID',Input::get('id'))->get();
		if(count($order)>0){
			return 2;
		}
		

		$user=user::find(Input::get('id'));
		if($user->delete()){
			return 1;
		}else{
			return -1;
		}
	}

	
}

?>