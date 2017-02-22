<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class finishorder extends Model
	{		
		public $table = "finishorder";
		public $fillable=['name','idorder'];		
	}
 ?>