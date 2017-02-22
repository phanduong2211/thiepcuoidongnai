<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Http\Module\order;
use App\Http\Module\detailorder;
use App\Http\Module\finishorder;
use App\Http\Module\product;
use Input;
use DB;
class OrderController extends Controller
{
	public function getIndex(){

		$ordercl="order.id";
		$ordertype="desc";
		if(!Input::exists('id')){
			if(Input::exists('s')){
				switch (Input::get('s')) {
					case '2':
						$ordertype="asc";
						break;
					case '3':
						$ordercl="tongtien";
						$ordertype="desc";
						break;
					case '4':
						$ordercl="sp";
						$ordertype="desc";
						break;
				}
			}

			$data=order::select('order.id','order.address','order.created_at','order.status',
				DB::raw('(select count(id) from detailorder where orderid=order.id) as sp'),
				DB::raw('(select sum(product.promotion_price*detailorder.quantity) from detailorder inner join product on detailorder.productID=product.id where detailorder.orderid=order.id) as tongtien'))->orderBy($ordercl,$ordertype);

			if(Input::exists('f')){
				switch (Input::get('f')) {
					case '1':
						$data=$data->where('order.status',0);
						break;
					case '2':
						$data=$data->where('order.status',1);
						break;
					
				}
			}

			if(Input::exists('q')){
				$query=trim(Input::get('q'));
				if($query!=""){
					$data=$data->where(function($q) use ($query){
							
							$tien=preg_replace("/(\.|-| |\,)*/", "",$query);
							$q->where('order.id',$tien);
							$q->orWhere(DB::raw('(select sum(promotion_price) from product where product.id in (select productID from detailorder where detailorder.orderid=order.id))'),$tien);
							$q->orWhere(DB::raw('(select count(id) from detailorder where orderid=order.id)'),$tien);
							$q->orWhere('order.address','like','%'.$query.'%');
						});
				}
			}

			$data=$data->paginate(15);
		}else{
			$data=order::select('order.id','order.address','order.created_at','order.status',
				DB::raw('(select count(id) from detailorder where orderid=order.id) as sp'),
				DB::raw('(select sum(product.promotion_price*detailorder.quantity) from detailorder inner join product on detailorder.productID=product.id where detailorder.orderid=order.id) as tongtien'))->orderBy($ordercl,$ordertype)->where('order.id',Input::get('id'))->paginate(2);
		}

		$arrid=array();
		foreach ($data as $value) {
			if($value->status==1)
			$arrid[]=$value->id;
		}

		$datafinish=finishorder::select('name','idorder','created_at')->whereIn('idorder',$arrid)->get();

		return view("admin.order.index",array('data'=>$data,'fi'=>$datafinish));
	}

	public function postDetail(){
		$data=detailorder::select(DB::raw('detailorder.id as detailid'),
			'detailorder.quantity','detailorder.size','detailorder.color',
			'product.name','product.promotion_price','product.image')->join('product','detailorder.productID','=','product.id')->where('detailorder.orderid',Input::get('id'))->get();

		return json_encode($data);
	}

	public function postFinish(){
		$order=order::find(Input::get('id'));
		$order->status=1;
		if($order->update()){
			$finish=new finishorder();

			$data=array(
				'name'=>Input::get('name'),
				'idorder'=>Input::get('id')
			);

			$finish->fill($data);

			if($finish->save()){

				$detailorder=detailorder::select('productID','quantity')->where('orderid',Input::get('id'))->get();

				foreach ($detailorder as $value) {
					$producto=product::find($value->productID);

					$producto->quantity=$producto->quantity-$value->quantity;

					$producto->update();
				}

				return 1;
			}
			$order->status=0;
			$order->update();

			return -1;
		}

		return -1;
	}

	public function postRemovesp(){
		$order=detailorder::find(Input::get('iddetail'));
	
		if($order->delete()){
			return json_encode(array('result'=>1));
		}

		return json_encode(array('result'=>-1,'message'=>'Có lỗi. Xóa thất bại'));
	}

	public function postChangeq(){
		$order=detailorder::find(Input::get('iddetail'));
		$order->quantity=Input::get('sl');
		if($order->update()){
			return 1;
		}

		return -1;
	}

	public function postDelete(){
		$order=order::find(Input::get('id'));
		if($order->delete()){
			$orderdetail=detailorder::where('orderid',Input::get('id'))->delete();
			return json_encode(array('result'=>1));
		}
		return json_encode(array('result'=>-1,'message'=>'Có lỗi. Xóa thất bại'));
		
	}

	
}

?>