<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\contact;
use Input;
use Session;
use Redirect;
use View;

class ContactController extends Controller
{
	public static function getContact()
	{		
		return contact::orderBy('id', 'desc')->get();
	}
	public static function insert($data)
	{		
			$contact =new contact();
			$contact->fill($data);
			$contact->save();			
	}
	
}

?>