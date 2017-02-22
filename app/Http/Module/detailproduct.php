<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class detailproduct extends Model
	{		
		public $table = "detailproduct";
		public $fillable=['images','silebar_images','infomation','size','color','comment','data_sheet','productID'];
		
	}
 ?>
