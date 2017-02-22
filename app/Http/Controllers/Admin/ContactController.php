<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Http\Module\contact;
use Input;
use Carbon\Carbon;
use DB;
class ContactController extends Controller
{
	public function getIndex(){

		if(!Input::exists('id')){
			$sortf="id";
			$sorttype="desc";

			if(Input::exists('s')){
				switch (Input::get('s')) {
					case '2':
						$sorttype="asc";
						break;
					case '3':
						$sortf="email";
						$sorttype="asc";
						break;
					
				}
			}

			$data=contact::orderBy($sortf,$sorttype);

			if(Input::exists('f')){
				switch (Input::get('f')) {
					case '1':
						$mytime = Carbon::now();
						$data=$data->where(DB::raw('day(created_at)'),$mytime->day)->where(DB::raw('month(created_at)'),$mytime->month)->where(DB::raw('year(created_at)'),$mytime->year);
						break;
					case '2':
						$mytime = Carbon::now()->subDay();
					
						$data=$data->where(DB::raw('day(created_at)'),$mytime->day)->where(DB::raw('month(created_at)'),$mytime->month)->where(DB::raw('year(created_at)'),$mytime->year);
						break;
					case '3':
						$mytime = Carbon::now();
						$data=$data->where(DB::raw('month(created_at)'),$mytime->month)->where(DB::raw('year(created_at)'),$mytime->year);
						break;
					
					
				}
			}

			
			if(Input::exists('q')){
				$query=trim(Input::get('q'));
				if($query!=""){
					$data=$data->where(function($q) use ($query){
							$arr=explode('/', $query);

							if(count($arr)==3){
								$ngay=(int)$arr[0];
								$thang=(int)$arr[1];
								$nam=(int)$arr[2];
								if($ngay!=0 && $thang!=0 && $nam!=0){

									$q->where(DB::raw('day(created_at)'),$ngay);
									$q->where(DB::raw('month(created_at)'),$thang);
									$q->where(DB::raw('year(created_at)'),$nam);
									return;
								}
								
							}

							if(count($arr)==2){
								$thang=(int)$arr[0];
								$nam=(int)$arr[1];
								if($thang!=0 && $nam!=0){
								
									$q->where(DB::raw('month(created_at)'),$thang);
									$q->where(DB::raw('year(created_at)'),$nam);
									return;
								}
								
							}

							$q->where('email','like','%'.$query.'%');
							$q->orWhere('subject','like','%'.$query.'%');
							$q->orWhere('content','like','%'.$query.'%');
							

						});
				}
			}
			$data=$data->paginate(15);
		}else{
			$data=contact::where('id',Input::get('id'))->paginate(1);
		}

		return view("admin.contact.index",array('data'=>$data));
	}



	public function postDelete(){
		$contact=contact::find(Input::get('id'));
		if($contact->delete()){
			return 1;
		}else{
			return -1;
		}
	}
}

?>