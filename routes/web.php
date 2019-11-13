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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'FrontController@index')->name('home');
Route::get('/groups', 'HomeController@user_groups')->name('user_groups');
Route::get('/groups/{id}', 'HomeController@group')->name('group');
// Route::get('/groups/{id}', 'HomeController@group')->name('group');
Route::view('/email', 'emails.newuser');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['admin'])->group(function () {
    Route::get('admin', 'Admin\AdminController@dashboard')->name('admin_dashboard');
    Route::get('admin/profile', 'Admin\AdminController@admin_profile')->name('admin_profile');
    Route::post('admin/update-admin-profile', 'Admin\AdminController@update_admin_profile')->name('update_admin_profile');
    Route::get('admin/change-admin-password', 'Admin\AdminController@change_admin_password')->name('change_admin_password');
    Route::post('admin/update-admin-password', 'Admin\AdminController@update_admin_password')->name('update_admin_password');

    Route::get('admin/user-list', 'Admin\AdminController@user_list')->name('user_list');
    Route::get('admin/create-new-user', 'Admin\AdminController@create_new_user')->name('create_new_user');
    Route::post('admin/save-new-user', 'Admin\AdminController@save_new_user')->name('save_new_user');

    Route::get('admin/edit-user/{user}', 'Admin\AdminController@edit_user')->name('edit_user');
    Route::patch('admin/update-user/{user}', 'Admin\AdminController@update_user')->name('update_user');

    Route::get('admin/change-user-password/{user}', 'Admin\AdminController@change_user_password')->name('change_user_password');
    Route::patch('admin/update-user-password/{user}', 'Admin\AdminController@update_user_password')->name('update_user_password');

    Route::get('admin/delete-user/{user}', 'Admin\AdminController@delete_user')->name('delete_user');



    //Images Routes
    Route::get('admin/image/upload', 'Admin\AdminController@fileCreate')->name('admin_upload_image');
    Route::post('admin/image/upload/store', 'Admin\AdminController@fileStore')->name('admin_store_image');
    // Route::post('admin/image/delete','Admin\AdminController@fileDestroy')->name('admin_destroy_image');
    Route::get('admin/images', 'Admin\AdminController@images')->name('admin_images');


    //Image Group routes
    Route::get('admin/group-list', 'Admin\AdminController@group_list')->name('group_list');
    Route::get('admin/create-new-group', 'Admin\AdminController@create_new_group')->name('create_new_group');
    Route::post('admin/save-new-group', 'Admin\AdminController@save_new_group')->name('save_new_group');
    Route::get('admin/edit-group/{group}', 'Admin\AdminController@edit_group')->name('edit_group');
    Route::patch('admin/update-group/{group}', 'Admin\AdminController@update_group')->name('update_group');
    Route::get('admin/delete-group/{group}', 'Admin\AdminController@delete_group')->name('delete_group');
    Route::post('admin/delete_image', 'Admin\AdminController@delete_image')->name('delete_image');
    Route::get('admin/edit-image/{image}', 'Admin\AdminController@edit_image')->name('edit_image');
    Route::patch('admin/update-image/{image}', 'Admin\AdminController@update_image')->name('update_image');


    Route::get('admin/group-images/{group}', 'Admin\AdminController@group_images')->name('group_images');
    Route::post('admin/add-group-images', 'Admin\AdminController@add_group_images')->name('add_group_images');
    Route::post('admin/remove-group-images', 'Admin\AdminController@remove_group_images')->name('remove_group_images');
});
