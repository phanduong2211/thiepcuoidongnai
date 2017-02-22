<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\news;
use Input;
use Session;
use Redirect;
use View;

class NewsController extends Controller
{
	public static function getNews()
	{
		return news::orderBy('id','desc')->paginate(5);
	}
	public static function getNewsWhereID($id)
	{
		return news::orderBy('id', 'desc')->where('id','=',$id)->get();
	}
	public static function update($data,$id)
	{
		$news =new news();
		return $news->updateNews($data,$id);
	}
	public static function getNewsMaxView()
	{
		return news::orderBy('view','desc')->take(5)->get();
	}
	public static function getNewsReleasion($categoryNewsID,$id)
	{
		return news::where('categoryNewsID','=',$categoryNewsID)->where('id','!=',$id)->orderBy('view','desc')->take(5)->get();
	}
	public static function getNewsNew()
	{
		return news::orderBy('id','desc')->take(5)->get();
	}
}

?>