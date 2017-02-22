<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\category;
use Input;
use Session;
use Redirect;
use View;

class CategoryController extends Controller
{
	public static function getCategory()
	{
		return category::orderBy('id', 'desc')->get();
	}

	public static function getCategoryWhereID($id)
	{
		return category::where('id', '=',$id)->get();
	}
	public static function getCategoryWhereName($name)
	{
		$category = category::orderBy('id', 'desc')->get();
		$convert = new convertString();
		foreach($category as $values)
		{
			if($convert->convertString($values->name)==$name)
			{
				return $values->id;
			}
		}
		return 0;
	}
}

?>