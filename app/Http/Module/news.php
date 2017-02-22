<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class news extends Model
	{		
		public $table = "news";
		public $fillable=['name','image','description','content','user','view','categoryNewsID','display'];
		public function updateNews($data,$id)
		{
			DB::table("news")->where('id','=',$id)->update(array("view"=>$data[0]->view));
		}
	}
 ?>