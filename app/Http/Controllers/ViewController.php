<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Input;
use Session;
use Redirect;
use View;
class ViewController extends Controller
{

	public function index()
	{
		$ads = AdsController::getAds();
		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$convert = new convertString();		
		$slideshow = SlideShowController::getSlideShow(0);
		$product = ProductController::getProductWhereStatus("new");
		$tab_category = Tab_categoryController::getTab_category();
		$news = NewsController::getNews();
		$categorys = CategoryController::getCategory();
		$wishlist =array();		
		$header = array("title"=>"","keyword"=>"","description"=>"");
		foreach($info as $values)
		{
			if($values->name == "keyword" && $values->contents!="")
				$header["keyword"] = $values->contents;
			if($values->name == "description" && $values->contents!="")
				$header["description"] = $values->contents;
			if($values->name == "title" && $values->contents!="")
				$header["title"] = $values->contents;
		}	
		/*if(count($product)>0)
		{
			$wishlist = WishlistController::getWishlist();
			foreach($product as $values_product)
			{
				$values_product["wishlist"] = false;
				foreach($wishlist as $values_wishlist)
				{
					if($values_product->id == $values_wishlist->productID)
					{
						$values_product["wishlist"] = true;
					}
				}
			}
		}*/
		//return $product;
		/*if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		else
		{
			$menu = array();
		}*/
	
		return View::make("fontend.mainbody.index",array("menu"=>$menu,"slideshow"=>$slideshow,"product"=>$product,"news"=>$news,"tab_category"=>$tab_category,
			"convert"=>$convert,"ads"=>$ads,"categorys"=>$categorys,"info"=>$info,"header"=>$header));
	}

	public function allproducts()
	{
		$ads = AdsController::getAds();
		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$convert = new convertString();		
		$slideshow = SlideShowController::getSlideShow(0);
		$product = ProductController::getProduct();
		$tab_category = Tab_categoryController::getTab_category();
		$news = NewsController::getNews();
		$categorys = CategoryController::getCategory();
		$wishlist =array();		
		$header = array("title"=>"","keyword"=>"","description"=>"");
		foreach($info as $values)
		{
			if($values->name == "keyword" && $values->contents!="")
				$header["keyword"] = $values->contents;
			if($values->name == "description" && $values->contents!="")
				$header["description"] = $values->contents;
			if($values->name == "title" && $values->contents!="")
				$header["title"] = $values->contents;
		}	
		/*if(count($product)>0)
		{
			$wishlist = WishlistController::getWishlist();
			foreach($product as $values_product)
			{
				$values_product["wishlist"] = false;
				foreach($wishlist as $values_wishlist)
				{
					if($values_product->id == $values_wishlist->productID)
					{
						$values_product["wishlist"] = true;
					}
				}
			}
		}*/
		//return $product;
		/*if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		else
		{
			$menu = array();
		}*/
	
		return View::make("fontend.mainbody.all-product",array("menu"=>$menu,"slideshow"=>$slideshow,"product"=>$product,"news"=>$news,"tab_category"=>$tab_category,
			"convert"=>$convert,"ads"=>$ads,"categorys"=>$categorys,"info"=>$info,"header"=>$header));
	}	


	public function ConvertMenuToArray($menu)
	{
			$first=$menu[0]->root;
			$root_menu=array();		
			$second_menu=array();
			$three_menu=array();
			$root=$menu[0]->root;
			$second=0;
			$three=0;
			/// lấy ra menu cấp 1
			foreach ($menu as $value) {
				if($value->root == $root)
				{
					$data=array("id"=>$value->id,"name"=>$value->name,
						"url"=>$value->url,"root"=>$value->root);
					$root_menu[]=$data;
				}
			}
			/// lấy ra menu cấp 2
			foreach ($root_menu as $value_root) {
				foreach ($menu as $value) {
					if($value->root == $value_root["id"])
					{
						$data=array("id"=>$value->id,"name"=>$value->name,
						"url"=>$value->url,"root"=>$value->root);
						$second_menu[]=$data;
					}
				}
			}
			/// lấy ra menu cấp 3
			foreach ($second_menu as $value_second) {
				foreach ($menu as $value) {
					if($value->root == $value_second["id"])
					{
						$data=array("id"=>$value->id,"name"=>$value->name,
						"url"=>$value->url,"root"=>$value->root);
						$three_menu[]=$data;
					}
				}
			}			
			$menu=array("root_menu"=>$root_menu,"second_menu"=>$second_menu,"three_menu"=>$three_menu);
			return $menu;
	}
	public function productDetail($id,$name)
	{		
		$product = ProductController::getProductWhereID($id);
		//return $product;
		$productMaxView = ProductController::getproductMaxView();
		$info = InfoController::getInfo();
		$product[0]->view +=1;
		$data[0] = $product[0];
		$tag = TagController::getTag();
		//$data =array("id","name","promotion_price","price","image","quantity","status","icon_status","user","view","categoryID","menuID","tab_categoryID","created_at");		
		ProductController::update($data,$id); /////update view
		$detailproduct = DetailProductController::getDetailProduct($id);
		$slideshow = SlideShowController::getSlideShow(0);
		$ads = AdsController::getAdsWhereType(1);
		$menu = MenuController::getMenu();
		$categorys = CategoryController::getCategory();
		$header = array("title"=>$product[0]->name,"keyword"=>$product[0]->name,"description"=>$product[0]->name);
		

		/*if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		else
		{
			$menu = array();
		}*/
		if(count($product)>0 && count($detailproduct)>0)
		{
			
			$category = $categorys[0];
			foreach($categorys as $values)
			{
				if($values->id==$product[0]->categoryID)
				{
					$category = $values;
					break;
				}
			}
			//return $category['name'];
			$relatedproducts = ProductController::getProductWhereCategoryID($product[0]->categoryID,$product[0]->id);
			$convert = new convertString();

			return view('fontend.product.detail-product',array("menu"=>$menu,"product"=>$product,"slideshow"=>$slideshow,"detailproduct"=>$detailproduct,
				"relatedproducts"=>$relatedproducts,"convert"=>$convert,"category"=>$category,"categorys"=>$categorys,"ads"=>$ads,"info"=>$info,
				"productMaxView"=>$productMaxView,"header"=>$header,"tag"=>$tag));
		}
		else{
			$header["title"]= "Không tìm thấy sản phẩm";
			return view('product.error',array("menu"=>$menu,"categorys"=>$categorys,"info"=>$info,"header"=>$header,"tag"=>$tag));
		}
	}
	public function myacount()
	{
		if(Session::has("login_userID"))
		{
			$menu = MenuController::getMenu();
			$categorys = CategoryController::getCategory();
			$info = InfoController::getInfo();
			$header = array("title"=>"Thông tin tài khoản","keyword"=>"","description"=>"");
			$convert = new convertString();
			foreach($info as $values)
			{
				if($values->name == "keyword" && $values->contents!="")
					$header["keyword"] = $values->contents;
				if($values->name == "description" && $values->contents!="")
					$header["description"] = $values->contents;
			}
			if(count($menu)>0)
			{
				$menu = $this->ConvertMenuToArray($menu);
			}
			else
			{
				$menu = array();
			}
			return view::make('my-account',array("menu"=>$menu,"categorys"=>$categorys,"info"=>$info,"convert"=>$convert,"header"=>$header));
		}
        else 
            return Redirect::to("registration.html");
	}
	public function news()
	{
		$news = NewsController::getNews();
		$menu = MenuController::getMenu();
		$info = InfoController::getInfo();
		$categorys = CategoryController::getCategory();
		$newsnews = NewsController::getNewsNew(); // lấy ra tin mới nhất
		$newMaxView = NewsController::getNewsMaxView(); // lấy ra 5 tin tức có lượt view nhiều nhất
		$header = array("title"=>"Tin tức","keyword","description");
		foreach($info as $values)
		{
			if($values->name == "keyword" && $values->contents!="")
				$header["keyword"] = $values->contents;
			if($values->name == "description" && $values->contents!="")
				$header["description"] = $values->contents;
		}
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		else
		{
			$menu = array();
		}
		if(count($news)>0){
			$convert = new convertString();
			return view('news.news',array('menu'=>$menu,'news'=>$news,"convert"=>$convert,"categorys"=>$categorys,"info"=>$info,"header"=>$header,
				"newMaxView"=>$newMaxView,"newsnews"=>$newsnews));
		}
		else
			return view('product.error',array("menu"=>$menu,"categorys"=>$categorys,"info"=>$info
				,"header"=>$header));
	}
	public function detailnews($id,$name)
	{
		$news = NewsController::getNewsWhereID($id);
		$menu = MenuController::getMenu();
		$categorys = CategoryController::getCategory();
		$convert = new convertString();
		$info = InfoController::getInfo();
		$newsnews = NewsController::getNewsNew(); // lấy ra tin mới nhất
		$newsRelesion = NewsController::getNewsReleasion($news[0]->categoryNewsID,$news[0]->id); // lấy ra tin tức liên quan
		$newMaxView = NewsController::getNewsMaxView(); // lấy ra 5 tin tức có lượt view nhiều nhất
		$news[0]->view +=1;
		$data[0] = $news[0];
		NewsController::update($data,$id); /////update view
		$header = array("title"=>$news[0]->name,"keyword"=>$news[0]->name,"description"=>$news[0]->name);
		
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		if(count($news)>0)
		{
			
			return view('news.detailnews',array('menu'=>$menu,'news'=>$news,"categorys"=>$categorys,"info"=>$info,"convert"=>$convert,
				"newMaxView"=>$newMaxView,"newsRelesion"=>$newsRelesion,"header"=>$header,"newsnews"=>$newsnews));
		}
		else
			return view('product.error',array("menu"=>$menu,"categorys"=>$categorys,"info"=>$info,"header"=>$header,
				"newsnews"=>$newsnews));
		
	}
	public function productsgird($category)
	{
		$menu = MenuController::getMenu();
		$categorys = CategoryController::getCategory();
		$info = InfoController::getInfo();
		$header = array("title"=>"Tin tức","keyword","description");
		foreach($info as $values)
		{
			if($values->name == "keyword" && $values->contents!="")
				$header["keyword"] = $values->contents;
			if($values->name == "description" && $values->contents!="")
				$header["description"] = $values->contents;
		}
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		return view('product.products-gird',array('menu'=>$menu,"categorys"=>$categorys,"info"=>$info,"header"=>$header));
	}
	public function productslist($category)
	{
		$menu = MenuController::getMenu();
		$categorys = CategoryController::getCategory();
		$info = InfoController::getInfo();
		$header = array("title"=>$category,"keyword","description");
		foreach($info as $values)
		{
			if($values->name == "keyword" && $values->contents!="")
				$header["keyword"] = $values->contents;
			if($values->name == "description" && $values->contents!="")
				$header["description"] = $values->contents;
		}
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		return view('product.products-list',array('menu'=>$menu,"categorys"=>$categorys,"info"=>$info,"header"=>$header));
	}
	public function registration()
	{
		$menu = MenuController::getMenu();
		$categorys = CategoryController::getCategory();
		$info = InfoController::getInfo();
		$convert = new convertString();
		$header = array("title"=>"Đăng ký hoặc đăng nhập","keyword"=>"Đăng ký-Công ty TNHH MTV Nguyễn Tiến Hùng","description"=>"Đăng ký-Công ty TNHH MTV Nguyễn Tiến Hùng");
		foreach($info as $values)
		{
			if($values->name == "keyword" && $values->contents!="")
				$header["keyword"] = $values->contents;
			if($values->name == "description" && $values->contents!="")
				$header["description"] = $values->contents;
		}
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		return view::make("registration",array('menu'=>$menu,"categorys"=>$categorys,"info"=>$info,"convert"=>$convert
			,"header"=>$header));
	}
	public function cart()
	{

		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$categorys = CategoryController::getCategory();
		$convert = new convertString();
		$header = array("title"=>"Giỏ hàng","keyword"=>"","description"=>"");
		$user = UserController::getuser(Session::get("login_userID"));
		foreach($info as $values)
		{
			if($values->name == "keyword" && $values->contents!="")
				$header["keyword"] = $values->contents;
			if($values->name == "description" && $values->contents!="")
				$header["description"] = $values->contents;
		}
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		$product = array();

		if(Session::has("cart"))
		{
			
			$cart = Session::get("cart");
			//return $cart;
			//$product[] = ProductController::getProductWhereID($cart[0][0]["id"]);
			for($i=1;$i< count($cart);$i++)
			{				
				$product[] =  ProductController::getProductWhereID($cart[$i][0]["id"]);
			}

		//Session::forget("cart");
		}		
		return View::make("cart",array('menu'=>$menu,"categorys"=>$categorys,"product"=>$product,"convert"=>$convert,"info"=>$info
			,"header"=>$header,"user"=>$user));
	}
	public function wishlist()
	{
		if(UserController::isLogin())
		{
			$wishlist = WishlistController::getWishlistWhereUserID(Session::get('login_userID'));
			//return $wishlist;
			if(count($wishlist)>0)
			{
				$info = InfoController::getInfo();
				$product=array();
				$wishlistID=array();
				$header = array("title"=>"Sản phẩm yêu thích","keyword","description");
				$tag = TagController::getTag();
				foreach($info as $values)
				{
					if($values->name == "keyword" && $values->contents!="")
						$header["keyword"] = $values->contents;
					if($values->name == "description" && $values->contents!="")
						$header["description"] = $values->contents;
				}
				foreach ($wishlist as $values) {
					$product[]=ProductController::getProductWhereID($values->productID);
					$wishlistID[]=$values->id;
					//$product[]["wishlistID"] = $values->id;
				}
			
			//return $wishlistID;
				$convert = new convertString();		
				$menu = MenuController::getMenu();
				$categorys = CategoryController::getCategory();
				if(count($menu)>0)
				{
					$menu = $this->ConvertMenuToArray($menu);
				}
				return View::make("wishlist",array('menu'=>$menu,"categorys"=>$categorys,"product"=>$product,
					"convert"=>$convert,"wishlistID"=>$wishlistID,"info"=>$info,"header"=>$header,"tag"=>$tag));
			}
		}
		else
			return $this->registration();
	}
	public function postwishlist()
	{
		if(UserController::isLogin())
		{
			if(WishlistController::insertwishlist(Session::get('login_userID'),$_GET['id'])==0)
				return 2;
			return 1;
		}
		else
			return 0;
	}
	public function deletewishlist()
	{
			WishlistController::deletewishlist($_POST['contents']);
			return $_POST['contents'];		
	}
	public function deletecart()
	{

		$cart = Session::get("cart");

		if(count($cart)==2){
			Session::forget("cart");
			return 2;
		}
		$id = $_POST["contents"];

		$index=-1;
		
		$cart = Session::get("cart");
			for($i=1;$i< count($cart);$i++)
			{
				if($cart[$i][0]["id"] == $id){
					$index=$i;
					break;
				}
			}

		if($index==-1)
			return -1;
		unset($cart[$index]);
		$cart = array_values($cart);
		Session::put("cart",$cart);
		return 2;
	}
	public function addcart()
	{
		$cartinfo[] = array("id"=>$_POST['contents']);
		if(!Session::has("cart"))
		{
			$cartinfo[] = array(array("id"=>$_POST['contents']));	
			Session::put("cart",$cartinfo);
			//return true;
		}
		else
		{
			//$cartinfo[] = array("id"=>$_POST['contents']);
			$cart = Session::get("cart");
			for($i=1;$i< count($cart);$i++)
			{
				if($cart[$i][0]["id"] == $_POST['contents'])
					return -1;
			}
			//if($flag)
			Session::push("cart",$cartinfo);
			
		}
		return 1;
	}
	public function search()
	{
		$categoryID = Input::get("category");
		$productName = Input::get("name");
		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$categorys = CategoryController::getCategory();
		$header = array("title"=>$productName,"keyword","description");
		$tag = TagController::getTag();
		foreach($info as $values)
		{
			if($values->name == "keyword" && $values->contents!="")
				$header["keyword"] = $values->contents;
			if($values->name == "description" && $values->contents!="")
				$header["description"] = $values->contents;
		}
		$convert = new convertString();
		$product =array();

		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		if($categoryID == "all")
		{
			$product = ProductController::getProductWhereName($productName);
		}
		else
		{
			$product = ProductController::getProductWhereNameAndCate($productName,$categoryID);
		}
		$product->appends(['category' => $categoryID,"name"=>$productName])->render();
		return View::make("product.search-product",array('menu'=>$menu,"categorys"=>$categorys,"product"=>$product,
					"convert"=>$convert,"info"=>$info,"header"=>$header,"tag"=>$tag));
	}
	public function category($name)
	{
		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$convert = new convertString();
		$slideshow = SlideShowController::getSlideShow(0);
		$categorys = CategoryController::getCategory();
		$categoryID = 0;
		$categoryName ="";
		foreach($categorys as $values)
		{
			if($convert->convertString($values->name)==$name)
			{
				$categoryID = $values->id;
				$categoryName = $values->name;
				break;
			}
		}
		$header = array("title"=>$categoryName." - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>$categoryName,"description"=>$categoryName);
		
		$product = ProductController::getAllProductWhereCategoryID($categoryID);
		$tag = TagController::getTag();
		/*if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}*/
		if(count($product)>0)
			return View::make("fontend.mainbody.category",array('menu'=>$menu,"categorys"=>$categorys,"slideshow"=>$slideshow,"convert"=>$convert,"info"=>$info,"header"=>$header,"product"=>$product
				,"tag"=>$tag,"Name"=>$categoryName));
		else 
			return View::make("errors.404");
	}
	public function tag($name)
	{
		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$convert = new convertString();
		$categorys = CategoryController::getCategory();
		$ID = 0;
		$Name ="";
		$tag = TagController::getTag();
		foreach($tag as $values)
		{
			if($convert->convertString($values->name)==$name)
			{
				$ID = $values->id;
				$Name = $values->name;
				break;
			}
		}
		$header = array("title"=>$Name." - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>$Name,"description"=>$Name);
		
		$product = ProductController::getAllProductWhereTagID($ID);		
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		if(count($product)>0)
			return View::make("product.products-gird",array('menu'=>$menu,"categorys"=>$categorys,"convert"=>$convert,"info"=>$info,"header"=>$header,"product"=>$product
				,"tag"=>$tag,"Name"=>$Name));
		else 
			return View::make("errors.404");
	}
	public function signout()
	{
		Session::forget('login_userID');
		Session::forget("login_name");
		Session::forget('login');
		return Redirect::to("/");
	}
	public function getMenu($name)
	{
		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$convert = new convertString();
		$categorys = CategoryController::getCategory();
		$ID = 0;
		$Name ="";
		$tag = TagController::getTag();
		foreach($menu as $values)
		{
			if($convert->convertString($values->name)==$name)
			{
				$ID = $values->id;
				$Name = $values->name;
				break;
			}
		}
		$header = array("title"=>$Name." - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>$Name,"description"=>$Name);
		
		$product = ProductController::getAllProductWhereMenuID($ID);		
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		if(count($product)>0)
			return View::make("product.products-gird",array('menu'=>$menu,"categorys"=>$categorys,"convert"=>$convert,"info"=>$info,"header"=>$header,"product"=>$product
				,"tag"=>$tag,"Name"=>$Name));
		else 
			return View::make("errors.404");
	}
	public function getMenuSecond($name,$name2) /////////////làm tiếp
	{
		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$convert = new convertString();
		$categorys = CategoryController::getCategory();
		$ID = 0;
		$Name = array("name1"=>"","name2"=>"");
		$tag = TagController::getTag();
		foreach($menu as $values)
		{
			if($convert->convertString($values->name)==$name2)
			{
				$ID = $values->id;
				$Name["name2"] = $values->name;
			}
			if($convert->convertString($values->name)==$name)
			{
				$Name["name1"] = $values->name;
			}
		}
		$header = array("title"=>$Name["name2"]." - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>$Name["name2"],"description"=>$Name["name2"]);
		//return $Name["name1"];
		$product = ProductController::getAllProductWhereMenuID($ID);		
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		if(count($product)>0)
			return View::make("product.menuproductSecond",array('menu'=>$menu,"categorys"=>$categorys,"convert"=>$convert,"info"=>$info,"header"=>$header,"product"=>$product
				,"tag"=>$tag,"Name"=>$Name));
		else 
			return View::make("errors.404");
	}
	public function getMenuThree($name,$name1,$name2)
	{
		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$convert = new convertString();
		$categorys = CategoryController::getCategory();
		$ID = 0;
		$Name =array("name"=>"","name1"=>"","name2"=>"");
		$tag = TagController::getTag();
		foreach($menu as $values)
		{
			if($convert->convertString($values->name)==$name)
			{
				//$ID = $values->id;
				$Name["name"] = $values->name;
			}
			if($convert->convertString($values->name)==$name1)
			{
				//$ID = $values->id;
				$Name["name1"] = $values->name;
			}
			if($convert->convertString($values->name)==$name2)
			{
				$ID = $values->id;
				$Name["name2"] = $values->name;
			}
		}
		$header = array("title"=>$Name["name2"]." - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>$Name["name2"],"description"=>$Name["name2"]);
		
		$product = ProductController::getAllProductWhereMenuID($ID);		
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}
		if(count($product)>0)
		{
			
			return View::make("product.menuproductThree",array('menu'=>$menu,"categorys"=>$categorys,"convert"=>$convert,"info"=>$info,"header"=>$header,"product"=>$product
				,"tag"=>$tag,"Name"=>$Name));
		}
		else 
			return View::make("errors.404");
	}
	public function checksignin()
	{
		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$convert = new convertString();
		$categorys = CategoryController::getCategory();
		$header = array("title"=>""." - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>"","description"=>"");
		
		//$product = ProductController::getAllProductWhereTagID($ID);		
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}			
		return view::make("checkout-signin",array('menu'=>$menu,"categorys"=>$categorys,"convert"=>$convert,"info"=>$info,"header"=>$header));
	}

	public function checkaddress()
	{
		if(Session::has("login_name") && Session::has("login_userID"))
			return "thành công";
		else
		{
			$info = InfoController::getInfo();
			$menu = MenuController::getMenu();
			$convert = new convertString();
			$categorys = CategoryController::getCategory();
			$header = array("title"=>""." - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>"","description"=>"");
			

			//$product = ProductController::getAllProductWhereTagID($ID);		
			if(count($menu)>0)
			{
				$menu = $this->ConvertMenuToArray($menu);
			}			
			return view::make("checkout-address",array('menu'=>$menu,"categorys"=>$categorys,"convert"=>$convert,"info"=>$info,"header"=>$header));
		}
	}

	public function checkoutshipping()
	{
		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$convert = new convertString();
		$categorys = CategoryController::getCategory();
		$header = array("title"=>""." - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>"","description"=>"");
		
		//$product = ProductController::getAllProductWhereTagID($ID);		
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}			
		return view::make("checkout-shipping",array('menu'=>$menu,"categorys"=>$categorys,"convert"=>$convert,"info"=>$info,"header"=>$header));
	}
public function payment()
	{
		$info = InfoController::getInfo();
		$menu = MenuController::getMenu();
		$convert = new convertString();
		$categorys = CategoryController::getCategory();
		$header = array("title"=>""." - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>"","description"=>"");
		
		//$product = ProductController::getAllProductWhereTagID($ID);		
		if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}			
		return view::make("checkout",array('menu'=>$menu,"categorys"=>$categorys,"convert"=>$convert,"info"=>$info,"header"=>$header));
	}
	public function order()
	{
		$userID=0;
		$productID=0;
		$color="";
		$size="";
		//$address="";
		Session::forget("address");

		$quantity=0;
		$address = Input::all();
		if(isset($address["email"]))
		{
			Session::put("name",$address["name"]);
			$address = serialize($address);
			Session::put("address",$address);

		}
		else
			Session::put("order",$_POST["contents"]);
		if(Session::has("cart") && Session::has("order"))
		{
			$cartArr = Session::get("cart");
			$infoProductArr = Session::get("order");

			if(Session::has("login_name") && Session::has("login_userID"))
			{
				$userID  = Session::get("login_userID");
				$address ="";
			}
			else
			{
				if(Session::has("address"))
				{
					$address=Session::get("address");

				}
				else
					return 	-3;
			}

			$order = array("userID"=>$userID,"address"=>$address);
			$orderid=OrderController::insert($order);
			for($i=1;$i< count($cartArr);$i++)
				{
					$quantity = $infoProductArr["2"][($i-1)];
					$size = $infoProductArr["0"][($i-1)];
					$color = $infoProductArr["1"][($i-1)];
					$productID = $cartArr[$i][0]['id'];
					$detailproduct = array("userID"=>$userID,"productID"=>$productID,"quantity"=>$quantity,"color"=>$color,"size"=>$size,"orderid"=>$orderid);
					DetailOrderController::insert($detailproduct);
				}
				if(Session::has("address"))
					return $this->orderSuccess();
				$userID=0;
				$productID=0;
				$color="";
				$size="";
				//$address="";
				Session::forget("address");
				Session::forget("cart");
				Session::forget("order");
				$quantity=0;
				return 3;
		}
		return -2;
	}
	public function orderSuccess()
	{
		$info = InfoController::getInfo();
			$menu = MenuController::getMenu();
			$convert = new convertString();
			$categorys = CategoryController::getCategory();
			$header = array("title"=>"Đặt hàng thành công"." - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>"Công ty TNHH MTV Nguyễn Tiến Hùng","description"=>"Công ty TNHH MTV Nguyễn Tiến Hùng");
			

			//$product = ProductController::getAllProductWhereTagID($ID);		
			if(count($menu)>0)
			{
				$menu = $this->ConvertMenuToArray($menu);
			}			
			return view::make("ordersuccess",array('menu'=>$menu,"categorys"=>$categorys,"convert"=>$convert,"info"=>$info,"header"=>$header));
	}
	public function orderget()
	{
		$cartArr = Session::get("cart");
		$infoProductArr = Session::get("order");
		for($i=1;$i< count($cartArr);$i++)
		{
			//return $infoProductArr[2][0];
			echo $cartArr[$i][0]['id'].$infoProductArr["2"][($i-1)];
		}
		//return Session::get("cart");
	}
	public function infoaccount()
	{
		if(Session::has("login_userID"))
		{
			$menu = MenuController::getMenu();
			$categorys = CategoryController::getCategory();
			$info = InfoController::getInfo();
			$convert = new convertString();
			//if(Session::has("login_userID")){
				//Session::get("login_userID")
				$user = UserController::getuser(Session::get("login_userID"));
				$header = array("title"=>"Thông tin tài khoản - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>"Thông tin tài khoản-Công ty TNHH MTV Nguyễn Tiến Hùng","description"=>"Thông tin tài khoản-Công ty TNHH MTV Nguyễn Tiến Hùng");
				foreach($info as $values)
				{
					if($values->name == "keyword" && $values->contents!="")
						$header["keyword"] = $values->contents;
					if($values->name == "description" && $values->contents!="")
						$header["description"] = $values->contents;
				}
				if(count($menu)>0)
				{
					$menu = $this->ConvertMenuToArray($menu);
				}
				return view::make("info-account",array('menu'=>$menu,"categorys"=>$categorys,"info"=>$info,"convert"=>$convert
					,"header"=>$header,"user"=>$user));
		}
		else 
			return Redirect::to("registration.html");
		//}
		//else
			//return $this->registration();
	}
	public function infoorder()
	{

	}
	public function Sendcontact()
	{
		ContactController::insert(Input::all());
		Session::put("contactSend","true");
		return Redirect::to("Lien-he");
	}
	public function contact()
	{
		$menu = MenuController::getMenu();
		$categorys = CategoryController::getCategory();
		$info = InfoController::getInfo();
		$convert = new convertString();
		$slideshow = SlideShowController::getSlideShow(0);
		$header = array("title"=>"Liên hệ - Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>"Liên hệ-Công ty TNHH MTV Nguyễn Tiến Hùng","description"=>"Liên hệ-Công ty TNHH MTV Nguyễn Tiến Hùng");
		foreach($info as $values)
		{
		if($values->name == "keyword" && $values->contents!="")
		$header["keyword"] = $values->contents;
		if($values->name == "description" && $values->contents!="")
		$header["description"] = $values->contents;
		}
		/*if(count($menu)>0)
		{
		$menu = $this->ConvertMenuToArray($menu);
		}*/
		return view::make("fontend.contact.contact-us",array('menu'=>$menu,"categorys"=>$categorys,"slideshow"=>$slideshow,"info"=>$info,"convert"=>$convert
		,"header"=>$header));
	}

	public function pages($url)
	{
		$menu = MenuController::getMenu();
		$categorys = CategoryController::getCategory();
		$info = InfoController::getInfo();
		$slideshow = SlideShowController::getSlideShow(0);
		$convert = new convertString();
		$pages = PageController::getPageWhereUrl($url);
		if(count($pages)==0)
			return View::make("errors.404");
		$header = array("title"=>$pages[0]->name."- Công ty TNHH MTV Nguyễn Tiến Hùng","keyword"=>"Liên hệ-Công ty TNHH MTV Nguyễn Tiến Hùng","description"=>"Liên hệ-Công ty TNHH MTV Nguyễn Tiến Hùng");
		foreach($info as $values)
		{
		if($values->name == "keyword" && $values->contents!="")
			$header["keyword"] = $values->contents;
		if($values->name == "description" && $values->contents!="")
			$header["description"] = $values->contents;
		}
		/*if(count($menu)>0)
		{
			$menu = $this->ConvertMenuToArray($menu);
		}*/
		return view::make("fontend.pages.page",array('menu'=>$menu,"categorys"=>$categorys,"slideshow"=>$slideshow,"info"=>$info,"convert"=>$convert
		,"header"=>$header,"pages"=>$pages));

	}
	public function test()
	{
	    //Session::forget("cart");
		$abc = Session::get("cart");
		return $abc;
		//return$abc[0]["id"];
		//return ($abc[0]->id);
		for($i=0;$i< count($abc);$i++)
		{
			if($i==0)
				echo $abc[0]["id"];
			else
			echo  $abc[$i][0]["id"];
		}
		//return Session::get("cart");
	}
	
}
?>