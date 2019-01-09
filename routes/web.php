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
//User
// Route::get('/', function () {
//     return redirect()->route('index');
// });
//Page index
Route::get('/',['as'=>'index','uses'=>'HomeController@index']);
//Loại sản phẩm
Route::get('/the-loai/{alias}',['uses'=>'HomeController@product']);
//Load sản phẩm ajax
Route::get('/sap-xep-san-pham',['uses'=>'HomeController@productSort']);
//Chi tiết sản phẩm
Route::match(['get','post'],'/chi-tiet/{alias}',['uses'=>'HomeController@detailProduct']);
//Đăng nhập
Route::match(['get','post'],'/dang-nhap',['uses'=>'HomeController@login']);
Route::get('/dang-nhap/{social}','SocialLoginController@redirectToProvider');
Route::get('/dang-nhap/{social}/callback','SocialLoginController@handleProviderCallback');

//Đăng xuất
Route::get('/dang-xuat',['uses'=>'HomeController@logout']);
//Đăng ký
Route::match(['get','post'],'/dang-ky',['uses'=>'HomeController@register']);
//Thêm vào giỏ hàng
Route::get('/them-gio-hang/{id}',['uses'=>'ProductController@addCart']);
//Thêm vào giỏ hàng cộng số lượng sản phẩm
Route::post('/them-gio-hang-co-so-luong',['uses'=>'ProductController@addCartQty']);
//Giỏ hàng
Route::get('/gio-hang',['uses'=>'ProductController@viewCart']);
//Xóa 1 product giỏ hàng
Route::get('/xoa-gio-hang',['uses'=>'ProductController@deleteUnitCart']);
//Cập nhật 1 product giỏ hàng
Route::get('/cap-nhat-gio-hang',['uses'=>'ProductController@updateUnitCart']);
//nút thanh toán
Route::post('/nut-thanh-toan',['uses'=>'ProductController@btnPay']);
Route::get('/tin-tuc/{alias}',['uses'=>'NewsController@news']);
Route::match(['get','post'],'/quen-mat-khau',['uses'=>'HomeController@sendMailForgotPassword']);
Route::match(['get','post'],'/khoi-phuc-mat-khau',['uses'=>'HomeController@resetPassword']);
Route::group(['middleware' => 'checkUser'], function() {
    //Đổi mật khẩu
	Route::match(['get','post'],'/doi-mat-khau',['uses'=>'HomeController@changePass']);
	//Route::post('/chi-tiet/{alias}',['uses'=>'HomeController@detailProduct']);
	//Quản lý bình luận
	Route::get('/nhan-xet-cua-toi',['uses'=>'CommentController@myComment']);
	Route::get('/xoa-binh-luan',['uses'=>'CommentController@deleteMyComment']);
	Route::match(['get','post'],'/chi-tiet-nhan-xet/{id}',['uses'=>'CommentController@viewMyComment']);

	//đặt hàng
	Route::match(['get','post'],'/dat-hang',['uses'=>'TransactionController@order']);
	Route::get('/xac-nhan-dat-hang/{id}',['as'=>'xacnhan','uses'=>'TransactionController@confirmOrder']);
	Route::get('/don-hang-cua-toi',['uses'=>'TransactionController@myOrder']);
	Route::get('/chi-tiet-don-hang/{id}',['uses'=>'TransactionController@detailOrder']);
	Route::get('/huy-don-hang/{id}',['uses'=>'TransactionController@cancellationOrder']);
	Route::match(['get','post'],'/xac-nhan-huy',['uses'=>'TransactionController@confirmCancellation']);
});
//404 page
// Route::get('404',['uses'=>'HomeController@handler404']);
// Route::fallback(function(){
//     return response()->view('errors.404', [], 404);
// });
//Tìm kiếm
Route::get('/tim-kiem',['uses'=>'HomeController@getSearch']);
//captcha
Route::get('createcaptcha', 'CaptchaController@create');
//Route::post('captcha', 'CaptchaController@captchaValidate');
Route::get('refreshcaptcha', 'CaptchaController@refreshCaptcha');
//Admin
Route::match(['get','post'],'/admin',['as'=>'login','uses'=>'AdminController@login']);
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'checkAdmin'],function(){
	Route::get('/admin/autoload',['uses'=>'ReportAutoLoadController@index']);
	Route::get('/admin/index',['uses'=>'AdminController@index']);
	Route::get('/admin/settings',['uses'=>'AdminController@settings']);
	Route::get('/admin/check-pwd',['uses'=>'AdminController@checkPass']);
	Route::match(['get', 'post'], '/admin/update-pwd',['uses'=>'AdminController@updatePassword']);
	//Danh mục
	Route::match(['get','post'],'/admin/add-category',['uses'=>'CategoryController@addCategory']);
	Route::get('/admin/view-categories',['uses'=>'CategoryController@viewCategories']);
	Route::match(['get','post'],'/admin/edit-categories/{id}',['uses'=>'CategoryController@editCategories']);
	Route::get('/admin/delete-categories/{id}',['uses'=>'CategoryController@deleteCategories']);
	//User
	Route::get('/admin/view-users',['uses'=>'AdminController@viewUser']);
	Route::match(['get','post'],'/admin/add-user',['uses'=>'AdminController@addUser']);
	Route::match(['get','post'],'/admin/edit-user/{id}',['uses'=>'AdminController@editUser']);
	Route::get('/admin/delete-user/{id}',['uses'=>'AdminController@deleteUser']);
	//publisher
	Route::match(['get', 'post'], '/admin/add-publisher',['uses'=>'PublisherController@addPubliser']);
	Route::get('/admin/view-publishers',['uses'=>'PublisherController@viewPublishers']);
	Route::match(['get', 'post'], '/admin/edit-publisher/{id}',['uses'=>'PublisherController@editPublisher']);
	Route::get('/admin/delete-publisher/{id}',['uses'=>'PublisherController@deletePublisher']);
	//author
	Route::match(['get', 'post'], '/admin/add-author',['uses'=>'AuthorController@addAuthor']);
	Route::get('/admin/view-authors',['uses'=>'AuthorController@viewAuthors']);
	Route::match(['get', 'post'], '/admin/edit-author/{id}',['uses'=>'AuthorController@editAuthor']);
	Route::get('/admin/delete-author/{id}',['uses'=>'AuthorController@deleteAuthor']);
	//Product - book
	Route::match(['get', 'post'], '/admin/add-product',['uses'=>'ProductController@addProduct']);
	Route::get('/admin/view-products',['uses'=>'ProductController@viewProducts']);
	Route::get('/admin/out-of-stock',['uses'=>'ProductController@outOfStock']);
	Route::match(['get', 'post'], '/admin/edit-product/{id}',['uses'=>'ProductController@editProduct']);
	Route::get('/admin/delete-product/{id}',['uses'=>'ProductController@deleteProduct']);
	//News - Bài viết
	Route::match(['get', 'post'], '/admin/add-news',['uses'=>'NewsController@addNews']);
	Route::get('/admin/view-news',['uses'=>'NewsController@viewNews']);
	Route::match(['get', 'post'], '/admin/edit-news/{id}',['uses'=>'NewsController@editNews']);
	Route::get('/admin/delete-news/{id}',['uses'=>'NewsController@deleteNews']);
	//Slider
	Route::match(['get', 'post'], '/admin/add-slider',['uses'=>'SliderController@addSlider']);
	Route::get('/admin/view-sliders',['uses'=>'SliderController@viewSlider']);
	Route::match(['get', 'post'], '/admin/edit-slider/{id}',['uses'=>'SliderController@editSlider']);
	Route::get('/admin/delete-slider/{id}',['uses'=>'SliderController@deleteSlider']);
	//Banner
	Route::match(['get', 'post'], '/admin/add-banner',['uses'=>'BannerController@addBanner']);
	Route::get('/admin/view-banners',['uses'=>'BannerController@viewBanner']);
	Route::match(['get', 'post'], '/admin/edit-banner/{id}',['uses'=>'BannerController@editBanner']);
	Route::get('/admin/delete-banner/{id}',['uses'=>'BannerController@deleteBanner']);
	//Comment
	Route::get('/admin/view-comments',['uses'=>'CommentController@viewComment']);
	Route::get('/admin/delete-comment/{id}',['uses'=>'CommentController@deleteComment']);
	Route::get('/admin/new-comments',['uses'=>'CommentController@newComment']);
	//Phê duyệt bình luận
	Route::get('/admin/approval-comment',['uses'=>'CommentController@approvalComment']);
	//Đơn hàng mới của đơn hàng trả trước
	Route::get('/admin/new-order',['uses'=>'TransactionController@newOrder']);
	//Danh sách đơn hàng trả trước
	Route::get('/admin/view-order',['uses'=>'TransactionController@viewOrder']);
	//Duyệt đơn hàng mới
	Route::get('/admin/approval-order/{id}',['uses'=>'TransactionController@approvalOrder']);
	//Đơn hàng mới của đơn hàng trả sau
	Route::get('/admin/new-order-cod',['uses'=>'TransactionController@newOrderCOD']);
	//Danh sách đơn hàng trả sau
	Route::get('/admin/view-order-cod',['uses'=>'TransactionController@viewOrderCOD']);

	//Đơn hàng bị hủy
	Route::get('/admin/cancellation-order',['uses'=>'TransactionController@canOrder']);
	//Xóa đơn hàng
	Route::get('/admin/delete-order/{id}',['uses'=>'TransactionController@deleteOrder']);
	//Sửa đơn hàng
	Route::post('/admin/edit-order',['uses'=>'TransactionController@editOrder']);
	Route::get('/admin/cancellation/{id}',['uses'=>'TransactionController@cancellation']);
	//in hóa đơn
	Route::get('/admin/invoice/{id}',['uses'=>'TransactionController@printInvoice']);
	//Thống kê doanh thu cụ thể
	//Thống kê theo năm
	Route::get('/admin/report-year/{year}',['uses'=>'ReportController@reportYear']);
	//Thống kê theo tháng
	Route::get('/admin/report-month/{id}',['uses'=>'ReportController@reportMonth']);
	//Giảm giá Coupon
	Route::match(['get','post'],'/admin/add-coupon',['uses'=>'CouponController@addCoupon']);
	Route::get('/admin/view-coupon',['uses'=>'CouponController@viewCoupon']);
	Route::get('/admin/delete-coupon/{id}',['uses'=>'CouponController@deleteCoupon']);
	Route::match(['get','post'],'/admin/edit-coupon/{id}',['uses'=>'CouponController@editCoupon']);
	Route::get('/admin/ajax-coupon',['uses'=>'CouponController@ajaxCoupon']);

});
Route::get('/admin/logout',['uses'=>'AdminController@logout']);


