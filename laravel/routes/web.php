<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('frontend.homepage.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Route cho administrator
 */
Route::prefix('admin')->group(function (){
    //Gom nhóm các route cho phần admin
    /**
     * ---------Route admin authentication-------------
     * --------------------------------------------
     * --------------------------------------------
     */

    /**
     * URL : authen.com/admin
     * Route mặc định của admin
     */
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    /**
     * URL : authen.com/admin/dashboard
     * Route đăng nhập thành công
     */
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    /**
     * URL : authen.com/admin/register
     * Route trả về view dùng để đăng ký tài khoản admin
     */
    Route::get('register', 'AdminController@create')->name('admin.register');

    /**
     * URL : authen.com/admin/register
     * Phương thức là POST
     * Route dùng để đăng ký 1 admin từ form POST
     */
    Route::post('register', 'AdminController@store')->name('admin.register.store');

    /**
     * URL : authen.com/admin/login
     * METOD: GET
     * Route trả về khi đăng nhập admin
     */
    Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');

    /**
     * URL : authen.com/admin/login
     * METHOD: POST
     * Route xử lý quá trình đăng nhập admin
     */
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');

    /**
     * URL : authen.com/admin/logout
     * Route dùng để đăng xuất
     * METHOD: POST
     */
    Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');


    /**
     * ---------Route admin shopping-------------
     * --------------------------------------------
     * --------------------------------------------
     */
    //Trả về view
    Route::get('shop/category', 'Admin\ShopCategoryController@index');
    Route::get('shop/category/create', 'Admin\ShopCategoryController@create');
    Route::get('shop/category/{id}/edit', 'Admin\ShopCategoryController@edit');
    Route::get('shop/category/{id}/delete', 'Admin\ShopCategoryController@delete');


    //Xử lý khi các form được post đi
    Route::post('shop/category', 'Admin\ShopCategoryController@store');
    Route::post('shop/category/{id}', 'Admin\ShopCategoryController@update');
    Route::post('shop/category/{id}/delete', 'Admin\ShopCategoryController@destroy');


    Route::get('shop/product', function (){
        return view('admin.content.shop.product.index');
    });

    Route::get('shop/order', function (){
        return view('admin.content.shop.order.index');
    });

    Route::get('shop/review', function (){
        return view('admin.content.shop.review.index');
    });

    Route::get('shop/customer', function (){
        return view('admin.content.shop.customer.index');
    });

    Route::get('shop/brand', function (){
        return view('admin.content.shop.brand.index');
    });

    Route::get('shop/statistic', function (){
        return view('admin.content.shop.statistic.index');
    });

    /**
     * ---------Route admin shopping-------------
     * --------------------------------------------
     * --------------------------------------------
     */
    Route::get('shop/product/order', function (){
        return view('admin.content.shop.adminorder.index');
    });

    /**
     * ---------Route admin nội dung-------------
     * --------------------------------------------
     * --------------------------------------------
     */
    Route::get('content/category', function (){
        return view('admin.content.content.category.index');
    });

    Route::get('content/post', function (){
        return view('admin.content.content.post.index');
    });

    Route::get('content/page', function (){
        return view('admin.content.content.page.index');
    });

    Route::get('content/tag', function (){
        return view('admin.content.content.tag.index');
    });

    /**
     * ---------Route admin nội dung-------------
     * --------------------------------------------
     * --------------------------------------------
     */
    Route::get('menu', function (){
        return view('admin.content.menu.index');
    });

    Route::get('menuitems', function (){
        return view('admin.content.menuitems.index');
    });


    /**
     * ---------Route admin users-------------
     * --------------------------------------------
     * --------------------------------------------
     */
    Route::get('users', function (){
        return view('admin.content.users.index');
    });

    /**
     * ---------Route admin media-------------
     * --------------------------------------------
     * --------------------------------------------
     */
    Route::get('media', function (){
        return view('admin.content.media.index');
    });

    /**
     * ---------Route admin config-------------
     * --------------------------------------------
     * --------------------------------------------
     */
    Route::get('config', function (){
        return view('admin.content.config.index');
    });

    /**
     * ---------Route admin newletters-------------
     * --------------------------------------------
     * --------------------------------------------
     */
    Route::get('newletters', function (){
        return view('admin.content.newletters.index');
    });

    /**
     * ---------Route admin banners-------------
     * --------------------------------------------
     * --------------------------------------------
     */
    Route::get('banners', function (){
        return view('admin.content.banners.index');
    });

    /**
     * ---------Route admin contacts-------------
     * --------------------------------------------
     * --------------------------------------------
     */
    Route::get('contacts', function (){
        return view('admin.content.contacts.index');
    });

    /**
     * ---------Route admin email-------------
     * --------------------------------------------
     * --------------------------------------------
     */
    Route::get('email/inbox', function (){
        return view('admin.content.email.index');
    });

    Route::get('email/draft', function (){
        return view('admin.content.email.draft');
    });

    Route::get('email/send', function (){
        return view('admin.content.email.send');
    });






});

/**
 * Route cho các nhà cung cấp sản phẩm (seller)
 */
Route::prefix('seller')->group(function (){
    //Gom nhóm các route cho phần seller
    /**
     * URL : authen.com/seller
     * Route mặc định của seller
     */
    Route::get('/', 'SellerController@index')->name('seller.dashboard');

    /**
     * URL : authen.com/seller/dashboard
     * Route đăng nhập thành công
     */
    Route::get('/dashboard', 'SellerController@index')->name('seller.dashboard');


    /**
     * URL : authen.com/seller/register
     * Route trả về view dùng để đăng ký tài khoản seller
     */
    Route::get('register', 'SellerController@create')->name('seller.register');

    /**
     * URL : authen.com/admin/register
     * Phương thức là POST
     * Route dùng để đăng ký 1 admin từ form POST
     */
    Route::post('register', 'SellerController@store')->name('seller.register.store');


    /**
     * URL : authen.com/seller/login
     * METOD: GET
     * Route trả về khi đăng nhập seller
     */
    Route::get('login', 'Auth\Seller\LoginController@login')->name('seller.auth.login');

    /**
     * URL : authen.com/seller/login
     * METHOD: POST
     * Route xử lý quá trình đăng nhập seller
     */
    Route::post('login', 'Auth\Seller\LoginController@loginSeller')->name('seller.auth.loginSeller');

    /**
     * URL : authen.com/seller/logout
     * Route dùng để đăng xuất
     * METHOD: POST
     */
    Route::post('logout', 'Auth\Seller\LoginController@logout')->name('seller.auth.logout');

});

/**
 * Route dành cho các nhà vận chuyển (shipper)
 */
Route::prefix('shipper')->group(function (){
    //Gom nhóm các route cho phần seller
    /**
     * URL : authen.com/shipper
     * Route mặc định của shipper
     */
    Route::get('/', 'ShipperController@index')->name('shipper.dashboard');

    /**
     * URL : authen.com/shipper/dashboard
     * Route đăng nhập thành công
     */
    Route::get('/dashboard', 'ShipperController@index')->name('shipper.dashboard');


    /**
     * URL : authen.com/shipper/register
     * Route trả về view dùng để đăng ký tài khoản shipper
     */
    Route::get('register', 'ShipperController@create')->name('shipper.register');

    /**
     * URL : authen.com/shipper/register
     * Phương thức là POST
     * Route dùng để đăng ký 1 shipper từ form POST
     */
    Route::post('register', 'ShipperController@store')->name('shipper.register.store');


    /**
     * URL : authen.com/shipper/login
     * METOD: GET
     * Route trả về khi đăng nhập shipper
     */
    Route::get('login', 'Auth\Shipper\LoginController@login')->name('shipper.auth.login');

    /**
     * URL : authen.com/shipper/login
     * METHOD: POST
     * Route xử lý quá trình đăng nhập shipper
     */
    Route::post('login', 'Auth\Shipper\LoginController@loginShipper')->name('shipper.auth.loginShipper');

    /**
     * URL : authen.com/shipper/logout
     * Route dùng để đăng xuất
     * METHOD: POST
     */
    Route::post('logout', 'Auth\Shipper\LoginController@logout')->name('shipper.auth.logout');

});
