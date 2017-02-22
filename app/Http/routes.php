<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.




*/
//Admin
Route::get("admin/login","Admin\LoginAdminController@index");
Route::post("admin/login","Admin\LoginAdminController@login");
Route::get("admin/logout","Admin\LoginAdminController@logout");
Route::group(["middleware"=>'checklogin','prefix'=>'admin'],function(){
    Route::get("/","Admin\IndexController@index");
    Route::get("website/menu","Admin\WebsiteController@menu");
    Route::post("website/menu/add","Admin\WebsiteController@savemenu");
    Route::post("website/menu/edit","Admin\WebsiteController@saveeditmenu");
    Route::post("website/menu/delete","Admin\WebsiteController@deletemenu");
    Route::get("website/info","Admin\WebsiteController@info");
    Route::post("info/changelogo","Admin\WebsiteController@changelogo");
    Route::post("info/changefavicon","Admin\WebsiteController@changefavicon");
    Route::post("info/postinfoall","Admin\WebsiteController@postinfoall");
    Route::post("info/postinfcontact","Admin\WebsiteController@postinfcontact");
    Route::post("info/changebrand","Admin\WebsiteController@changebrand");
    Route::get("website/note","Admin\WebsiteController@note");
    Route::post("website/note","Admin\WebsiteController@postNote");

    Route::get("category","Admin\CategoryAdminController@index");
    Route::post("category/add","Admin\CategoryAdminController@save");
    Route::post("category/edit","Admin\CategoryAdminController@saveedit");
    Route::post("category/delete","Admin\CategoryAdminController@delete");

    Route::get("tab","Admin\TabController@index");
    Route::post("tab/add","Admin\TabController@save");
    Route::post("tab/edit","Admin\TabController@saveedit");
    Route::post("tab/delete","Admin\TabController@delete");

    Route::get("product","Admin\ProductController@index");
    Route::get("product/add","Admin\ProductController@add");
    Route::post("product/add","Admin\ProductController@save");
    Route::get("product/edit","Admin\ProductController@edit");
    Route::post("product/edit","Admin\ProductController@saveedit");
    Route::get("product/recyclebin","Admin\ProductController@recyclebin");
    Route::post("product/addbin","Admin\ProductController@addbin");
    Route::post("product/restore","Admin\ProductController@restore");
    Route::post("product/delete","Admin\ProductController@delete");
    Route::post("product/hidden","Admin\ProductController@hidden");
    Route::post("product/detail","Admin\ProductController@detail");
    
    Route::get("uploadimage","Admin\UploadController@upload");
    Route::post("uploadimage","Admin\UploadController@upload");
    Route::post("ajax/loadfolder","Admin\UploadController@loadfolder");
    Route::post("upload/checkfile","Admin\UploadController@checkfile");
    Route::post("ajax/removeimg","Admin\UploadController@removeimg");
    Route::post("ajax/removefolder","Admin\UploadController@removefolder");
    Route::post("ajax/count","Admin\IndexController@count");
    Route::post("ajax/createfolder","Admin\UploadController@createfolder");
    Route::post("ajax/loadonlyfolder","Admin\UploadController@loadonlyfolder");

    Route::controller("slide","Admin\SlideController");
    Route::controller("news","Admin\NewsController");
    Route::controller("ad","Admin\AdminController");
    Route::controller("user","Admin\UserController");
    Route::controller("info","Admin\InfoController");
    Route::controller("page","Admin\PageController");
    Route::controller("ads","Admin\AdsController");
    Route::controller("contact","Admin\ContactController");
    Route::controller("order","Admin\OrderController");
});

Route::get("nojavascript.html",function(){
    return view('admin.noscript');
});

//Admin//
  

/////////////////////////////////////////////////////////view
Route::get('/',"ViewController@index");
Route::get('tat-ca-san-pham.html',"ViewController@allproducts");


Route::get('products/{id}/{name}.html','ViewController@productDetail');
Route::get("tin-tuc/{id}/{name}.html",'ViewController@detailnews');
Route::get("tin-tuc",'ViewController@news');
Route::get("san-pham/gird/{category}",'ViewController@productsgird');
Route::get("san-pham/list/{category}",'ViewController@productslist');
Route::post("add-cart","ViewController@addcart");
Route::post("delete-cart","ViewController@deletecart");
Route::get("tim-kiem","ViewController@search"); ///tìm kiếm sản phẩm
Route::get("danh-muc/{category}","ViewController@category");
Route::get("tag/{tag}","ViewController@tag");
Route::get("signout","ViewController@signout");

Route::get('cart.html',"ViewController@cart");

Route::get('checkout-signin.html',"ViewController@checksignin");

Route::get('checkout-address.html',"ViewController@checkaddress");

Route::get("dat-hang-thanh-cong.html","ViewController@orderSuccess");
Route::get('checkout-shipping.html',"ViewController@checkoutshipping");
Route::get("pages/{name}","ViewController@pages");
Route::get('checkout.html',"ViewController@payment");
Route::get("Lien-he","ViewController@contact");
Route::get('my-account.html',"ViewController@myacount");
Route::get('registration.html','ViewController@registration');
Route::post("changepass","UserController@updatePass");
Route::post("order","ViewController@order");
Route::get("order","ViewController@orderget");
Route::get("info-account.html","ViewController@infoaccount");
Route::get("info-order.html","ViewController@infoorder");
Route::get('wishlist.html',"ViewController@wishlist");
Route::get('wishlist',"ViewController@postwishlist");
Route::post('deletewishlist',"ViewController@deletewishlist");
Route::post('signinCreate',"UserController@login");
Route::post('AccountCreate',"UserController@register");
Route::post("insertcontact","ViewController@Sendcontact");
Route::post("AccountUpdate","UserController@updateUser");

Route::get("{menu}","ViewController@getMenu");
Route::get("{menu1}/{menu2}","ViewController@getMenuSecond");
Route::get("{menu1}/{menu2}/{menu3}","ViewController@getMenuThree");

Route::get('about-us.html', function () {
    return view('about-us');
});
Route::get('my-cart-step-2-info.html', function () {
    return view('my-cart-step-2-info');
});
Route::get("test","ViewController@test");
/*Route::get("test1",function(){
    return Session::get("name_test");
});*/
