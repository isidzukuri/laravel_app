<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/one', 'OneController@one');

// Route::get('one', [
//     'as' => 'one', 'uses' => 'OneController@one'
// ]);
// die;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

DB::connection()->enableQueryLog();

Route::group(['middleware' => ['web']], function () {

    

	// Route::get('/one', 'OneController@index');
	// Route::get('/one/create', 'OneController@create');
	// Route::get('/one/{id}', 'OneController@show');
	// Route::post('/one', 'OneController@store');
	
	
	
	// Route::get('/one/all_json', 'OneController@all_json');
	Route::resource('one','OneController');

// Route::controllers(array(
// 			'one' => 'OneController'
// 		));

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['web','role:admin']], function () {
    Route::get('/', 'AdminController@index');
    Route::resource('pages','PageController');
});
// dd(DB::getQueryLog());	