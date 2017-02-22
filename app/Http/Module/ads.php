<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class ads extends Model
	{		
		public $table = "ads";
		public $fillable=['name','image','url','type'];		
	}
 ?>