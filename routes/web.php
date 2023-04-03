<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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


Route::get('/admin', 'AdminController@index');
Route::post('/login', 'AdminController@adminLogin');
Route::middleware(['middleware' => 'prevent-back-history','checkLogin'])->group(function () {
Route::get('/admin/logout', 'AdminController@logout');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/instructor', 'AdminController@instructor');
Route::get('/admin/add_instruction', 'AdminController@add_instruction');
Route::post('/admin/insert_instructor', 'AdminController@insert_instructor');
Route::post('/admin/delete_instructor', 'AdminController@delete_instructor');
Route::post('/admin/update_instructor', 'AdminController@update_instructor');
Route::get('/admin/course', 'AdminController@course');
Route::get('/admin/add_course', 'AdminController@add_course');
Route::post('/admin/insert_course', 'AdminController@insert_course');
Route::post('/admin/update_course', 'AdminController@update_course');
Route::post('/admin/delete_course', 'AdminController@delete_course');
Route::get('/admin/curriculum', 'AdminController@curriculum');
Route::get('/admin/add_curriculum', 'AdminController@add_curriculum');
Route::post('/admin/insert_curriculum', 'AdminController@insert_curriculum');
Route::get('/admin/lecture_detail', 'AdminController@lecture_detail');
Route::get('/admin/detail', 'AdminController@detail');
Route::post('/admin/update_lecture', 'AdminController@update_lecture');
Route::post('/admin/delete_lecture', 'AdminController@delete_lecture');
Route::post('/admin/update_curriculum_heading', 'AdminController@update_curriculum_heading');
Route::get('/admin/about', 'AdminController@about');
Route::get('/admin/about_detail', 'AdminController@about_detail');
Route::get('/admin/update_about', 'AdminController@update_about');
Route::post('/admin/updateabout', 'AdminController@updateabout');
Route::get('/admin/testimonial', 'AdminController@testimonial');
Route::get('/admin/add_testimonial', 'AdminController@add_testimonial');
Route::post('/admin/delete_testimonial', 'AdminController@delete_testimonial');



Route::post('/admin/insert_testimonial', 'AdminController@insert_testimonial');
Route::post('/admin/update_testimonial', 'AdminController@update_testimonial');
Route::get('/admin/blog', 'AdminController@blog');
Route::get('/admin/add_blog', 'AdminController@add_blog');
Route::post('/admin/delete_blog', 'AdminController@delete_blog');
Route::post('/admin/insert_blog', 'AdminController@insert_blog');
Route::post('/admin/update_blog', 'AdminController@update_blog');
Route::get('/admin/blog_detail', 'AdminController@blog_detail');
Route::get('/admin/contact_page', 'AdminController@contact_page');
Route::get('/admin/update_contact', 'AdminController@update_contact');
Route::post('/admin/updatecontact', 'AdminController@updatecontact');
Route::post('/admin/delete_contact_list', 'AdminController@delete_contact_list');
Route::get('/admin/contact_list', 'AdminController@contact_list');
Route::get('/admin/slider', 'AdminController@slider');
Route::get('/admin/add_slider', 'AdminController@add_slider');
Route::post('/admin/insert_slider', 'AdminController@insert_slider');
Route::post('/admin/update_slider', 'AdminController@update_slider');
Route::get('/admin/section_one', 'AdminController@section_one');
Route::get('/admin/update_section', 'AdminController@update_section');
Route::post('/admin/updatesection', 'AdminController@updatesection');
Route::get('/admin/users_list', 'AdminController@users_list');
Route::post('/admin/change_user_status', 'AdminController@change_user_status');
Route::get('/admin/enroll_history', 'AdminController@enroll_history');
Route::post('/admin/delete_curriculum', 'AdminController@delete_curriculum');

Route::get('/admin/status-update/{id}', 'AdminController@active_inactive');

// Route::get('admin/status_update/{id}',[BlogController::class,'active_inactive']);   //is not working


// ==================================courses===============================================
// Route::get('/admin/beginner1',[AdminController::class, 'beginner']);
// Route::get('/admin/intermediate1',[AdminController::class, 'intermediate']);
// Route::get('/admin/advanced1',[AdminController::class, 'advanced']);







});

Route::get('/', 'HomeController@index');
Route::get('/about', 'HomeController@about');
Route::get('/create_account', 'HomeController@create_account');
Route::post('home/registration', 'HomeController@registration');
Route::get('/email_active', 'HomeController@email_active');
Route::get('/login', 'HomeController@login');
Route::get('/contact', 'HomeController@contact');
Route::get('/faq', 'HomeController@faq');
Route::get('/blog', 'HomeController@blog');
Route::get('/blog_detail', 'HomeController@blog_detail');
Route::get('/course', 'HomeController@course');
Route::get('/course_details', 'HomeController@course_details');
Route::post('home/insert_contact', 'HomeController@insert_contact');
Route::get('/how_it_work', 'HomeController@how_it_work');
Route::post('home/user_login', 'HomeController@user_login');
Route::get('/privacy_policy', 'HomeController@privacy_policy');
Route::get('/terms', 'HomeController@terms');
Route::get('/reset_password', 'HomeController@reset_password');
Route::get('/forgot_password', 'HomeController@forgot_password');

Route::post('home/userforgotpassword', 'HomeController@forgotpassword');
Route::get('home/usergetforgotpassword', 'HomeController@forgotpassword');
Route::get('/lectures', 'HomeController@lectures');
Route::post('/resetpassword', 'HomeController@resetpassword');
Route::get('/privacy_policy', 'HomeController@privacy_policy');

Route::get('/terms', 'HomeController@terms');

Route::middleware(['middleware' => 'prevent-back-history','checkuserLogin'])->group(function () {
	Route::get('/logout', 'HomeController@logout');
	/*Route::get('/product_detail', 'HomeController@product_detail');*/
	Route::post('home/add_to_cart', 'HomeController@add_to_cart');
	Route::get('/cart_list', 'HomeController@cart_list');
	Route::post('/delete_cart', 'HomeController@delete_cart');
	Route::get('/my_order', 'HomeController@my_order');
	Route::post('home/update_cart', 'HomeController@update_cart');
	Route::get('/check_out', 'HomeController@check_out');
	Route::post('/submit_address', 'HomeController@submit_address');
	Route::post('/stripePost', 'HomeController@stripePost');
	Route::get('/success_payment', 'HomeController@success_payment');
	Route::get('/profile', 'HomeController@profile');
	Route::post('/profile_edit', 'HomeController@profile_edit');
	Route::post('/change_password', 'HomeController@change_password');
	Route::post('/read_lecture', 'HomeController@read_lecture');



// ==============================courses add===========================================

















});


