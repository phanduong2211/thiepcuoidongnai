<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class contact extends Model
	{		
		public $table = "contact";
		public $fillable=['subject','email','content'];
			
	}
 ?>