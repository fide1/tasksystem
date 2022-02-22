<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register'=>false]);

Route::get('user/login','FrontendController@login')->name('login.form');
Route::post('user/login','FrontendController@loginSubmit')->name('login.submit');
Route::get('user/logout','FrontendController@logout')->name('user.logout');

Route::get('user/register','FrontendController@register')->name('register.form');
Route::post('user/register','FrontendController@registerSubmit')->name('register.submit');
// Reset password
Route::post('password-reset', 'FrontendController@showResetForm')->name('password.reset'); 
// Socialite 
Route::get('login/{provider}/', 'Auth\LoginController@redirect')->name('login.redirect');
Route::get('login/{provider}/callback/', 'Auth\LoginController@Callback')->name('login.callback');

Route::get('/','FrontendController@login')->name('home');

// Backend section start

Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/','AdminController@index')->name('admin');
    // user route
    Route::resource('users','UsersController');
    // Task
    Route::get('/admintask', 'TaskController@index')->name('admintask.index');
    Route::post('/admintask/assign/{id}', 'TaskController@assign')->name('admintask.assign');
    Route::get('/admintask/create', 'TaskController@create')->name('admintask.create');
    Route::post('/admintask/store', 'TaskController@store')->name('admintask.store');
    Route::post('/admintask/destroy/{id}', 'TaskController@destroy')->name('admintask.destroy');
    Route::get('/admintask/edit/{id}', 'TaskController@edit')->name('admintask.edit');
    Route::post('/admintask/update/{id}', 'TaskController@update')->name('admintask.update');
    //Userboard
    Route::get('/userboard', 'TaskController@userboard')->name('admin.userboard');
    Route::get('/userboard/detail/{name}', 'TaskController@userboardDetail')->name('admin.userboardDetail');
    // Profile
    Route::get('/profile','AdminController@profile')->name('admin-profile');
    Route::post('/profile/{id}','AdminController@profileUpdate')->name('profile-update');
    // Message
    Route::resource('/message','MessageController');
    Route::get('/message/five','MessageController@messageFive')->name('messages.five');

    // Notification
    Route::get('/notification/{id}','NotificationController@show')->name('admin.notification');
    Route::get('/notifications','NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete');
    // Password Change
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password');
});

// User section start
Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    Route::get('/','HomeController@index')->name('user');
    // Task
    Route::get('/task', 'UserTaskController@index')->name('task');
    Route::post('/task/assign/{id}', 'UserTaskController@assign')->name('task.assign');
    Route::get('/task/create', 'UserTaskController@create')->name('task.create');
    Route::post('/task/store', 'UserTaskController@store')->name('task.store');
    Route::post('/task/destroy/{id}', 'UserTaskController@destroy')->name('task.destroy');
    Route::post('/task/edit/{id}', 'UserTaskController@edit')->name('task.edit');
    Route::post('/task/update/{id}', 'UserTaskController@update')->name('task.update');
    Route::get('/task/assignedTasks', 'UserTaskController@assignedTasks')->name('task.assignedTasks');
    Route::get('/task/completedTasks', 'UserTaskController@completedTasks')->name('task.completedTasks');
    Route::get('/task/pendingTasks', 'UserTaskController@pendingTasks')->name('task.pendingTasks');
    Route::get('/task/overDueTasks', 'UserTaskController@overDueTasks')->name('task.overDueTasks');
    Route::get('/task/getAssignedTasks', 'UserTaskController@getAssignedTasks')->name('task.getAssignedTasks');
    //Userboard
    Route::get('/userboard', 'UserTaskController@userboard')->name('user.userboard');
    Route::get('/userboard/detail/{name}', 'UserTaskController@userboardDetail')->name('user.userboardDetail');
    // Profile
    Route::get('/profile','HomeController@profile')->name('user-profile');
    Route::post('/profile/{id}','HomeController@profileUpdate')->name('user-profile-update');
    
    // Password Change
    Route::get('change-password', 'HomeController@changePassword')->name('user.change.password.form');
    Route::post('change-password', 'HomeController@changPasswordStore')->name('change.password');

});