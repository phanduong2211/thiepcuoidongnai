<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class slideshow extends Model
	{		
		public $table = "slideshow";
		public $fillable=['name','content','image','url','page'];		
	}
 ?>