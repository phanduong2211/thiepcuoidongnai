<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Input;
use DB;
use Carbon\Carbon;

class IndexController extends Controller
{
	public function index()
	{ 
		$data=array();
		$data['thongke']=DB::table('admin')->select(
			DB::raw('(select count(id) from product) sp'),
			DB::raw('(select count(id) from news) tt'),
			DB::raw('(select count(id) from `order`) dh'),
			DB::raw('(select count(id) from ads) qc'),
			DB::raw('(select count(id) from users) nd'),
			DB::raw('(select count(id) from contact) lh'),
			DB::raw('(select count(id) from slideshow) sl'),
			DB::raw('(select sum(promotion_price) from product where id in(select productID from detailorder inner join `order` on detailorder.orderid=order.id where order.status=1)) tongtien'))->first();
		$year=Carbon::now()->year;

		$data['current_year']=$year;

		if(Input::exists('y')){
			$year=(int)Input::get('y');
		}

		$data['year']=$year;

		$data['chart']=DB::table('product')->select(DB::raw('sum(product.price) as s'),DB::raw('month(detailorder.created_at) as t'),DB::raw('year(detailorder.created_at) as y'))->join('detailorder','product.id','=','detailorder.productID')->join('order','detailorder.orderid','=','order.id')->where('order.status',1)->where(DB::raw('year(detailorder.created_at)'),$year)->groupBy('t','y')->get();

		$data['product_o']=DB::table('product')->select('id','name','promotion_price','quantity')->where('quantity','<',10)->where('bin',0)->skip(0)->take(5)->get();

		$data['product_p']=DB::table('product')->select('id','name','promotion_price','price')->where('promotion_price','<>',DB::raw('price'))->where('bin',0)->skip(0)->take(5)->get();
		
		return view("admin.index",$data);
	}	

	public function count()
	{
		$mytime = Carbon::now()->toDateString();
		$data=array();
		$data['contact']=DB::table('contact')->select('id','subject','email','content','created_at')->where(DB::raw('DATE(created_at)'),$mytime)->get();

		$data['user']=DB::table('users')->select('id','sex','name','created_at')->where(DB::raw('DATE(created_at)'),$mytime)->get();

		$data['order']=DB::table('order')->select('id','address','created_at')->where('status',0)->get();

		$data['note']=DB::table('info')->select('contents')->where('name','note')->first();


		return json_encode($data);
	}	
	
}

?>