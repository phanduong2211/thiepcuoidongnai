<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class user extends Model
	{		
		public $table = "users";
		public $fillable=['name','sex','date','email','phone','address','password','remember_token','active'];
		public static function check_user($email)
		{
			$data=DB::table("users")->where('email','=',$email)->get();
			if(count($data)>0)
				return false;
			return true;
		}
		public static function check_login($email,$password)
		{
			$data=DB::table("users")->where('email','=',$email)->get();
			if(count($data)>0)
			{
				if($data[0]->password==$password)
				{
					Session::put('login_name',$data[0]->name);
					Session::put('login_userID',$data[0]->id);
					return true;
				}
			}
			return false;
		}

		public static function get_user($email,$password)
		{
			$data=DB::table("users")->select('id','name')->where('email',$email)->where('password',md5($password))->first();
			return $data;
		}

	}
 ?>