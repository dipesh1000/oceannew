<?php

use App\Model\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
Route::get('/get-book',function(){
    $book = Book::find(39);
    $filename = storage_path('app/'.$book->book);
    $fildeData = Storage::get($book->book);
    return $fildeData;
});

Route::group(
    [
        'namespace' =>'Frontend',
    ],function () {
    Route::get('/', 'FrontpageController@index')->name('homepage');

    //packages
    Route::get('packages', 'PackageController@index')->name('package');
    Route::get('package/{slug}', 'PackageController@singlePackage')->name('package.single');
 
    //Category
    Route::get('categories', 'CategoryController@index')->name('categoryType');
    Route::get('category/{slug}', 'CategoryController@getBooksBySlug')->name('category.single'); 

    //books
    Route::get('books', 'BooksController@index')->name('getAllBooks');
    Route::get('book/{slug}', 'BooksController@getBooksBySlug')->name('book.single');

    //ajax for books and videos
    Route::get('bookByCat', 'CategoryController@bookByCat');
    Route::get('videoByCat', 'CategoryController@videoByCat');

    //vidoes
    Route::get('videos', 'VideoController@index')->name('getAllVideos');
    Route::get('video/{slug}', 'VideoController@getVideoBySlug')->name('video.single');

    //about
    Route::get('about-us', function () {
        return view('frontend/about/index');
    });

    //News and Events
    Route::get('newsAndEvents/{slug}', 'PosttypeController@newsAndEventGetBySlug')->name('newsAndEventSlug.single');

    //Authors
    Route::get('postType/{post_type}', 'PosttypeController@getPostType')->name('postType');
    Route::get('postType/{post_type}/{slug}', 'PosttypeController@getPostTypeDetails')->name('postTypeDetails');

    //searchable
    Route::get('search', 'FrontpageController@getSearch')->name('search');

    //Contact Page
    Route::get('contact', 'ContactController@getContactPage')->name('getContact');
    Route::Post('contact', 'ContactController@storeContact')->name('storeContact');

    //cart
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart', 'CartController@addToCart')->name('addToCart');
    Route::get( '/mini-cart', 'CartController@getMiniCart' )->name( 'cart.mini' );
    Route::delete('/remove-from-cart', 'CartController@remove');
    Route::get('/remove-cart-item/{id}','CartController@removeNonAjax');
});

//sad
Route::get('forgot-password', 'Auth\ResetPasswordController@getResetForm');
Route::post('forgot-password', 'Auth\ResetPasswordController@resetPassword');
Route::get('reset-password/{token}', 'Auth\ResetPasswordController@getResetPasswordForm');
Route::post('/reset-password', 'Auth\ResetPasswordController@updatePassword');
Route::post('/save-course-later', 'UserDashboard\SavedCourseController@savedCourse')->name('saveCourseLater.store');

Route::group([
    'namespace' => 'UserDashboard',
    'middleware' => 'sentinel'
],function() {
    Route::get('/userdashboard', 'DashboardController@index')->name('userDashboard');
    Route::get('/profile', 'ProfileController@userProfile')->name('userProfile');
    Route::get('my-orders','DashboardController@myOrders')->name('myOrders');
    Route::get('/profile/edit/{id}', 'ProfileController@userProfileEdit')->name('userProfileEdit');
    Route::patch('/profile/edit/{id}', 'ProfileController@updateProfile')->name('updateProfile');
    Route::get('/checkout', 'OrderController@getCheckout')->name('checkout.page');
    Route::post('/checkout', 'OrderController@store')->name('checkout.store');
    Route::any('/esewa/success', 'EsewaController@success');
    Route::any('/esewa/failure', 'EsewaController@failure');
    Route::any('/esewa/response', 'EsewaController@response');
    Route::get('/paymentHistory', 'DashboardController@paymentHistory')->name('paymentHistory');
    Route::get('/paymentHistory/{id}', 'DashboardController@viewSinglePaymentHistory')->name('viewInvoice');
    Route::get('/printInvioce/{id}', 'DashboardController@printSinglePaymentHistory')->name('printInvioce');
    Route::get('/dashboardNotification', 'DashboardController@dashboardNotication')->name('notification');
    //save course for later
    Route::get('/save-course-later', 'SavedCourseController@getSavedCourse')->name('saveCourseLater');
    Route::get('/save-course-later/delete/{id}', 'SavedCourseController@destroy')->name('saveCourseLater.delete');
    Route::get('/courses', 'CourseController@getAllCourses')->name('purchasedCourse');
    Route::get('/courses/video/{id}', 'CourseController@getSingleVideo')->name('purchasedCourseVideo');
    Route::get('/courses/book/{id}', 'CourseController@getSingleBook')->name('purchasedCourseBook');
    Route::get('/courses/package/{id}', 'CourseController@getSinglePackage');
    Route::post('/feedback', 'FeedbackController@store')->name('feedback.store');
    Route::post('/feedback/update', 'FeedbackController@update')->name('feedback.update');
    Route::get('/coursebook/pdf/{id}','CourseController@getSingleBookPdf')->name('pdf_viewer');
});

Route::get('/logout','Auth\LoginController@logout')->name('logout')->middleware('sentinel');

Route::group(
    [
        'namespace' =>'Auth',
    ],function () {

    Route::get('/register', 'RegistrationController@register')->name('register');
    Route::post('/register', 'RegistrationController@postRegister')->name('post.register');
    Route::get('/login', 'LoginController@login')->name('login');
    Route::post('/login', 'LoginController@postLogin')->name('post.login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::get('/admin/login', 'LoginController@adminLogin')->name('admin.login');
    Route::post('/admin/login', 'LoginController@adminLoginPost')->name('admin.login.Post');
    Route::get('/user/activate/{user_id}/{code}', 'LoginController@activate')->name('user.activate');
});

Route::group(
    [
        'prefix' =>'backend',
        'as' =>'admin.',
        'namespace' =>'Backend',
        'middleware'=>['checkrole','sentinel']

    ],function (){

    Route::get('/', 'DashboardController@index')->name('dashboard');


//    category
    Route::get('/category', 'CategoryController@index')->name('category');
    Route::get('/category/create', 'CategoryController@create')->name('category.create');
    Route::post('/category/store', 'CategoryController@store')->name('category.store');
    Route::get('/category/delete/{id}', 'CategoryController@destroy')->name('category.delete');
    Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('/category/update', 'CategoryController@update')->name('category.update');


//    video
    Route::get('/video', 'VideoController@index')->name('video');
    Route::get('/video/create', 'VideoController@create')->name('video.create');
    Route::post('/video/store', 'VideoController@store')->name('video.store');
    Route::get('/video/delete/{id}', 'VideoController@destroy')->name('video.delete');
    Route::get('/video/edit/{id}', 'VideoController@edit')->name('video.edit');
    Route::get('/video/show/{id}', 'VideoController@show')->name('video.show');
    Route::post('/video/update', 'VideoController@update')->name('video.update');
    Route::post('/video/upload', 'VideoController@uploadVideo')->name('video.upload');
    Route::post('/video/uploadcontent/delete/', 'VideoController@uploadContentDelete')->name('video.videocontent.delete');


//    Books
    Route::get('/book', 'BookController@index')->name('book');
    Route::get('/book/create', 'BookController@create')->name('book.create');
    Route::post('/book/store', 'BookController@store')->name('book.store');
    Route::get('/book/delete/{id}', 'BookController@destroy')->name('book.delete');
    Route::get('/book/edit/{id}', 'BookController@edit')->name('book.edit');
    Route::get('/book/show/{id}', 'BookController@show')->name('book.show');
    Route::post('/book/update', 'BookController@update')->name('book.update');
    Route::post('/book/upload', 'BookController@uploadVideo')->name('book.upload');




//    category
    Route::get('/package', 'PackageController@index')->name('package');
    Route::get('/package/create', 'PackageController@create')->name('package.create');
    Route::post('/package/store', 'PackageController@store')->name('package.store');
    Route::get('/package/delete/{id}', 'PackageController@destroy')->name('package.delete');
    Route::get('/package/edit/{id}', 'PackageController@edit')->name('package.edit');
    Route::post('/package/update', 'PackageController@update')->name('package.update');
    Route::get('/package/item', 'PackageController@packageItem')->name('package.item');
    Route::Post('/package/item/delete', 'PackageController@packageItemDelete')->name('package.item.delete');



//    post type
    Route::get('/post_type', 'PostTypeController@index')->name('post_type');
    Route::get('/post_type/create', 'PostTypeController@create')->name('post_type.create');
    Route::post('/post_type/store', 'PostTypeController@store')->name('post_type.store');
    Route::get('/post_type/delete/{slug}', 'PostTypeController@destroy')->name('post_type.delete');
    Route::get('/post_type/edit/{slug}', 'PostTypeController@edit')->name('post_type.edit');
    Route::post('/post_type/update', 'PostTypeController@update')->name('post_type.update');
    Route::get('/post_type/order', 'PostTypeController@ordering')->name('post_type.order');
    Route::post('/post_type/order/store', 'PostTypeController@orderStore')->name('post_type.order.store');

//    gobal post
    Route::get('/post/{post_type}', 'GobalController@index')->name('post');
    Route::get('/post/{post_type}/create', 'GobalController@create')->name('post.create');
    Route::post('/post/{post_type}/store', 'GobalController@store')->name('post.store');
    Route::get('/post/{post_type}/delete/{slug}', 'GobalController@destroy')->name('post.delete');
    Route::get('/post/{post_type}/edit/{slug}', 'GobalController@edit')->name('post.edit');
    Route::post('/post/{post_type}/update', 'GobalController@update')->name('post.update');
    Route::get('/post/{post_type}/order', 'GobalController@ordering')->name('post.order');
    Route::post('/post/{post_type}/order/store', 'GobalController@orderStore')->name('post.order.store');
    Route::post('/post/delete/field_file/{id}', 'GobalController@deleteFieldFile')->name('post.delete.field_file');
    Route::get('/post/{post_type}/trash', 'GobalController@getTrash')->name('post.trash');
    Route::get('/post/{post_type}/log', 'GobalController@log')->name('post.log');
    Route::get('/post/{post_type}/restore/{slug}', 'GobalController@getRestore')->name('post.restore');
    Route::get('/post/{post_type}/forcedelete/{slug}', 'GobalController@forceDelete')->name('post.forcedelete');





//    custom field
    Route::get('/custom_field', 'CustomFieldController@index')->name('custom_field');
    Route::get('/custom_field/create', 'CustomFieldController@create')->name('custom_field.create');
    Route::post('/custom_field/store', 'CustomFieldController@store')->name('custom_field.store');
    Route::get('/custom_field/delete/{slug}', 'CustomFieldController@destroy')->name('custom_field.delete');
    Route::get('/custom_field/edit/{slug}', 'CustomFieldController@edit')->name('custom_field.edit');
    Route::post('/custom_field/update', 'CustomFieldController@update')->name('custom_field.update');

    Route::get('/custom_field/field', 'CustomFieldController@getField')->name('custom_field.field');
    Route::get('/custom_field/field/delete,{id}', 'CustomFieldController@deleteField')->name('custom_field.field.delete');
    Route::get('/custom_field/{slug}/field_position', 'CustomFieldController@filedPosition')->name('custom_field.field_position');
    Route::post('/custom_field/filed/order/store', 'CustomFieldController@orderStore')->name('custom_field.field.order.store');


//    User role

        Route::get('/user/role', 'RoleController@userRole')->name('user.role');
        Route::post('/user/role', 'RoleController@userRoleStore')->name('user.role.store');
        Route::get('/user/role/edit/{id}', 'RoleController@userRoleEdit')->name('user.role.edit');
        Route::post('/user/role/update', 'RoleController@userRoleUpdate')->name('user.role.update');
    Route::get('/user/role/delete/{id}', 'RoleController@userRoleDelete')->name('user.role.delete');
    Route::get('/user/role/permission/{id}', 'RoleController@userRolePermission')->name('user.role.permission');
    Route::post('/user/role/permission', 'RoleController@userRolePermissionStore')->name('user.role.permission.store');


//    User role

        Route::get('/user/permission', 'PermissionController@userPermission')->name('user.permission');
        Route::post('/user/permission', 'PermissionController@userPermissionStore')->name('user.permission.store');
        Route::get('/user/permission/edit/{id}', 'PermissionController@userPermissionEdit')->name('user.permission.edit');
        Route::post('/user/permission/update', 'PermissionController@userPermissionUpdate')->name('user.permission.update');
        Route::get('/user/permission/delete/{id}', 'PermissionController@userPermissionDelete')->name('user.permission.delete');


    //    category
    Route::get('/user', 'UserController@index')->name('user');
    Route::get('/user/create', 'UserController@create')->name('user.create');
    Route::post('/user/store', 'UserController@store')->name('user.store');
    Route::get('/user/delete/{id}', 'UserController@destroy')->name('user.delete');
    Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::post('/user/update', 'UserController@update')->name('user.update');


    Route::get('site', 'SiteController@index')->name('site');
    Route::post('site', 'SiteController@update')->name('site.update');

    Route::get('analytic', 'AnalyticController@index')->name('analytic');
    Route::get('analytic/realtime', 'AnalyticController@getRealTimeVisitor')->name('analytic.realtime');

    });