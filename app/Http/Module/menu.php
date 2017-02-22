<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class menu extends Model
	{		
		public $table = "menu";
		public $fillable=['name','root','url'];
		
	}
 ?>