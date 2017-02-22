<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class product extends Model
	{		
		public $table = "product";
		public $fillable=['name','price','promotion_price','image','quantity','status','view','user','categoryID','content','menuID','tab_categoryID','display','bin','original_price','tagID'];
		public function updateProduct($data,$id)
		{
			//$product =array("id","name","promotion_price","price","image","quantity",
				//"status","icon_status","user","view","categoryID","menuID","tab_categoryID");

			DB::table("product")->where('id','=',$id)->update(array("view"=>$data[0]->view));
		}
		public function searchName($name)
		{
			//return 
		}
	}
 ?>