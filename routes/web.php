<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Auth\LoginController;


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


//Don't try directly called view through route please mentation view blade in frontend controller for frontend page
 
//User Dashboard Route Start
Route::get('/guest',[GuestController::class,'index'])->name('guest');
Route::get('/g_profile',[GuestController::class,'profile'])->name('g_profile');
Route::get('/g_profile_edit',[GuestController::class,'profile_edit'])->name('g_profile_edit');
Route::patch('/g_profile_update/{id}',[GuestController::class, 'update'])->name('g_profile_update');
Route::get('/g_appointment',[GuestController::class, 'appointment'])->name('g_appointment');
Route::get('/g_password',[GuestController::class, 'g_password'])->name('g_password');
Route::get('/g_message',[GuestController::class, 'g_message'])->name('g_message');
Route::post('/g_message_store', [GuestController::class,"g_message_store"])->name('g_message_store');
Route::post('/g_message_reply', [GuestController::class,"g_message_reply"])->name('g_message_reply');
Route::get('/g_message_sent', [GuestController::class,"g_message_sent"])->name('g_message_sent');
Route::post('/g_message_delete', [GuestController::class,"g_message_delete"]);
//User Dashboard Route End

// Frontend Route Start
Route::get('/',[App\Http\Controllers\FrontendController::class,'index']);
Route::get('/state', [HomeController::class, 'getStateList'])->name('state');
Route::get('/city_fetch', [HomeController::class, 'getCityList'])->name('city');
Route::post('/login_up', [LoginController::class, 'doLogin'])->name('login_up');

Route::get('lawyerprofile/{id}', [FrontendController::class, 'lawfirmsprofileShow']);
Route::post('/review', [FrontendController::class, 'writeReview'])->name('lawfirms.writeReview');
// Route::get('/search/{city_name}/{id?}/{id1?}', [FrontendController::class, 'search'])->name('search');
Route::get('/search/{city_name}/{id1?}', [FrontendController::class, 'search'])->name('search');

Route::get('/get_city_count/{state_code}', [FrontendController::class, 'getCityCount']);

Route::get('/booking', [FrontendController::class,"booking"]);
// Frontend Route End

// Booking Route Start
Route::post('/book_an_appointment',[BookingController::class, 'book_an_appointment'])->name('book_an_appointment');
Route::get('/bookingUpdate/{id}',[BookingController::class, 'bookingUpdate'])->name('bookingUpdate');
Route::get('/bookingCancelled/{id}',[BookingController::class, 'bookingCancelled'])->name('bookingCancelled');
// Booking Route End

// Message Route Start
Route::resource('/message', MessageController::class);
Route::post('/message', [MessageController::class,"store"])->name('message.store');
Route::post('/message/reply', [MessageController::class,"reply"])->name('message.reply');
Route::get('/sent_messages', [MessageController::class,"show_send"])->name('message.sent');
// Route::get('/delete/mess',[MessageController::class,"delete"])->name('message.delete');
Route::post('/delete-multiple-category', [MessageController::class,"delete"]);
Route::get('/trash_message','MessageController@trash')->name('message.trash');
// Message Route End

Route::get('/verify', [VerifyController::class,"getVerify"])->name('getverify');
Route::get('/resendVerifyCode', [VerifyController::class,"resendVerifyCode"])->name('resendVerifyCode');
Route::post('/verify', [VerifyController::class,"postVerfiy"])->name('verify');
Route::get('/verify/{token}', [VerifyController::class,"verifyUser"])->name('verifyUser');

// Route::get('/about',[App\Http\Controllers\FrontendController::class,'about']);

Route::get('/refresh_captcha', [App\Http\Controllers\FrontendController::class, 'refreshCaptcha']);
Route::post('/contactStore',[App\Http\Controllers\FrontendController::class,'contactStore'])->name('contactStore');

Auth::routes();

//Advocate Dashboard Route Start
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::post('/upload', [App\Http\Controllers\HomeController::class, 'uploadImage'])->name('upload');
Route::get('/contactList', [App\Http\Controllers\HomeController::class, 'contactList'])->name('contactList');

Route::get('/service_available',[ServiceController::class,'service'])->name('service_available');
Route::get('/subscribed-services',[ServiceController::class,'services']);

// User Panel Profile Manage Routes
Route::get('/profile',[App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit',[App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/update/{id}',[App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

Route::get('/specialization',[App\Http\Controllers\ProfileController::class, 'specialization'])->name('specialization');
Route::post('/specialization/store',[App\Http\Controllers\ProfileController::class, 'specialization_store'])->name('specialization.store');

Route::get('/practicing_court',[App\Http\Controllers\ProfileController::class, 'practicing_court'])->name('practicing_court');
Route::post('/practicing_court',[App\Http\Controllers\ProfileController::class, 'practicing_court_store'])->name('practicing_court.store');

Route::get('/state_court/{id}',[App\Http\Controllers\ProfileController::class, 'state_court'])->name('state_court');
Route::get('/user_court_list/{id}/{id1}',[App\Http\Controllers\ProfileController::class, 'user_court_list'])->name('user_court_list');


Route::get('/qualification',[App\Http\Controllers\ProfileController::class, 'qualification'])->name('qualification');
Route::post('/qualification/store',[App\Http\Controllers\ProfileController::class, 'qualification_store'])->name('qualification.store');
Route::get('/qualification/edit/{id}',[App\Http\Controllers\ProfileController::class, 'qualification_edit'])->name('qualification.edit');
Route::patch('/qualification/update/{id}',[App\Http\Controllers\ProfileController::class, 'qualification_update'])->name('qualification.update');

Route::resource('/appointment', AppointmentController::class);
Route::resource('referral', ReferralController::class);
Route::get('/referral/delete/{id}', [ReferralController::class, "delete"])->name('referral.delete');

Route::get('/review_status',[App\Http\Controllers\ProfileController::class, 'review_status']);
Route::get('/edit_review_status/{id}',[App\Http\Controllers\ProfileController::class, 'review_edit']);
Route::get('/delete_review_status/{id}',[App\Http\Controllers\ProfileController::class, 'review_delete'])->name('delete_review_status');
Route::get('/changeStatus',[App\Http\Controllers\ProfileController::class, 'changeStatus']);

Route::get('/password_change',[App\Http\Controllers\ProfileController::class, 'password_change']);
Route::get('/change-password',[App\Http\Controllers\ProfileController::class, 'changePassword']);
//Advocate Dashboard Route End

//Master Table data fetch Route Start
Route::get('/get_cities/{id}', [App\Http\Controllers\FrontendController::class, 'get_cities'])->name('get_cities');
Route::get('/get_qual/{id}', [App\Http\Controllers\FrontendController::class, 'get_qual'])->name('get_qual');
Route::get('/get_role_catgs/{id}', [App\Http\Controllers\FrontendController::class, 'get_role_catgs'])->name('get_role_catgs');
//Master Table data fetch Route End

//User Controller
Route::resource('/user',App\Http\Controllers\UserController::class);
Route::get('/userApproval/{id}', [App\Http\Controllers\UserController::class, 'userApproval'])->name('userApproval');
Route::get('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');

//Admin & User Panel Post Manage Route Start
Route::resource('/post',App\Http\Controllers\PostController::class);
Route::get('/post/delete/{id}',[App\Http\Controllers\PostController::class,'delete'])->name('post.delete');
Route::post('/post/filter',[App\Http\Controllers\PostController::class,'postFilter'])->name('post_filter');

Route::get('/domain',[App\Http\Controllers\DomainController::class,'index'])->name('domain.index');
Route::get('/domain/assgine/',[App\Http\Controllers\DomainController::class,'assigne'])->name('domain.assgine');

Route::post('/domain/assgine/',[App\Http\Controllers\DomainController::class,'assigne_store'])->name('domain.assigne_store');
Route::post('/domain-check',[App\Http\Controllers\DomainController::class,'domainCheck'])->name('domainCheck');
//Admin & User Panel Post Manage Route End


Route::get('/directory/{state_name}/{state_code}',[App\Http\Controllers\FrontendController::class,'directory_show'])->name('directory_show');
Route::get('/directory/{state_name}/{city_name}/{city_code}',[App\Http\Controllers\FrontendController::class,'directory_show'])->name('directory_show');

Route::get('/profile_show/{id}',[App\Http\Controllers\FrontendController::class,'profile_show'])->name('profile_show');

//Admin Panel Category Manage Route Start
Route::resource('/category',App\Http\Controllers\CategoryController::class);
Route::post('/categoriesPosition',[App\Http\Controllers\CategoryController::class,'categoriesPosition']);


Route::get('/{catg_name}/{sef_url}',[App\Http\Controllers\FrontendController::class,'post_show']);
Route::get('/{page_name}',[App\Http\Controllers\FrontendController::class,'page_show']);
//Admin Panel Category Manage Route End

