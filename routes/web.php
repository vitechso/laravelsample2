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


/**
 * Auth routes
 */
Route::group(['namespace' => 'Auth'], function () {

    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    if (config('auth.users.registration')) {
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');
    }

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');

    // Confirmation Routes...
    if (config('auth.users.confirm_email')) {
        Route::get('confirm/{user_by_code}', 'ConfirmController@confirm')->name('confirm');
        Route::get('confirm/resend/{user_by_email}', 'ConfirmController@sendEmail')->name('confirm.send');
    }

    // Social Authentication Routes...
    Route::get('social/redirect/{provider}', 'SocialLoginController@redirect')->name('social.redirect');
    Route::get('social/login/{provider}', 'SocialLoginController@login')->name('social.login');
});

/**
 * Backend routes
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    //Users
    Route::get('users', 'UserController@index')->name('users');
    Route::get('users/restore', 'UserController@restore')->name('users.restore');
    Route::get('users/{id}/restore', 'UserController@restoreUser')->name('users.restore-user');
    Route::get('users/{user}', 'UserController@show')->name('users.show');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::put('users/{user}', 'UserController@update')->name('users.update');
    Route::any('users/{id}/destroy', 'UserController@destroy')->name('users.destroy');
    Route::get('permissions', 'PermissionController@index')->name('permissions');
    Route::get('permissions/{user}/repeat', 'PermissionController@repeat')->name('permissions.repeat');
    Route::get('dashboard/log-chart', 'DashboardController@getLogChartData')->name('dashboard.log.chart');
    Route::get('dashboard/registration-chart', 'DashboardController@getRegistrationChartData')->name('dashboard.registration.chart');

    Route::get('keywords', 'DashboardController@keywords')->name('keywords');
    Route::post('keywords', 'DashboardController@keywords')->name('keywords');

    Route::get('edit_keyword/{id}', 'DashboardController@edit_keyword')->name('edit_keyword');
    Route::post('edit_keyword/{id}', 'DashboardController@edit_keyword')->name('edit_keyword');

    Route::get('delete_keyword/{id}', 'DashboardController@delete_keyword')->name('delete_keyword');
    Route::post('delete_keyword/{id}', 'DashboardController@delete_keyword')->name('delete_keyword');

    Route::get('posts', 'DashboardController@posts')->name('posts');
    Route::post('posts', 'DashboardController@posts')->name('posts');

    Route::get('comments', 'DashboardController@comments')->name('comments');
    Route::get('comments_delete/{id}', 'DashboardController@commentsdelete')->name('comments_delete');
    Route::get('all-pages', 'DashboardController@pageslist')->name('all-pages');
    Route::get('page-edit/{id}', 'DashboardController@page_edit')->name('page-edit');
    Route::post('page-update', 'DashboardController@page_update')->name('page-update');
});


Route::get('/','HomeController@index')->name('home');
// Route::get('/', function () {
//         return view('welcome');
//     });
//     Route::post('/', function () {
//         return view('welcome');
//     });
//Route::get('/', 'HomeController@index');
Route::post('searchautocomplete', 'HomeController@searchautocomplete')->name('searchautocomplete');
Route::get('new_to_crypto/{slug?}', 'HomeController@new_to_crypto')->name('new_to_crypto');
Route::post('new_to_crypto', 'HomeController@new_to_crypto')->name('new_to_crypto');
Route::get('beginner', 'HomeController@beginner');
Route::get('beginner/{search?}', 'HomeController@beginner');
Route::post('beginner', 'HomeController@beginner')->name('beginner');
Route::post('searchkeyword', 'HomeController@searchkeyword')->name('searchkeyword');
Route::post('uservoting-onpost', 'HomeController@uservoting_onpost')->name('uservoting-onpost')->middleware('auth');
Route::post('uservoting-oncomment', 'HomeController@uservoting_oncomment')->name('uservoting-oncomment')->middleware('auth');
Route::get('basic_email', 'HomeController@basic_email')->name('basic_email')->middleware('auth');

/******* 25-aug-2020 *******/
Route::get('alpha', 'HomeController@alpha')->name('alpha');
Route::get('glossary', 'HomeController@glossary')->name('glossary');
Route::get('glossary-search/{slug?}', 'HomeController@glossary')->name('glossary-search');
Route::post('post-comment', 'HomeController@comment_onpost')->name('post-comment');
Route::post('add-keywords', 'HomeController@add_keywords')->name('add-keywords');
Route::get('glossary/{slug?}', 'HomeController@glossary_keywords')->name('glossary');

/******* 2-sep-2020 *******/
Route::get('myprofile', 'HomeController@myprofile')->name('myprofile')->middleware('auth');

Route::get('page/{slug?}', 'PageController@getpage')->name('page');
Route::get('forums', 'HomeController@forumspost')->name('forums')->middleware('auth');
Route::post('forums', 'HomeController@forumspost')->name('forums')->middleware('auth');
Route::post('user-vote-onforums', 'HomeController@forumsvoting')->name('user-vote-onforums')->middleware('auth');




/**
 * Membership
 */
Route::group(['as' => 'protection.'], function () {
    Route::get('membership', 'MembershipController@index')->name('membership')->middleware('protection:' . config('protection.membership.product_module_number') . ',protection.membership.failed');
    Route::get('membership/access-denied', 'MembershipController@failed')->name('membership.failed');
    Route::get('membership/clear-cache/', 'MembershipController@clearValidationCache')->name('membership.clear_validation_cache');
});
