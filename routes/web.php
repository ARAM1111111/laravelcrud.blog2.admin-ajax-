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
//     return view('blog.index');
// });

 Route::group(['middleware'=>['web']],function(){
 	Route::resource('admin','BlogController');
 });

Route::group(['middleware'=>['web']],function(){
	Route::resource('blog2','Blog2Controller');
	Route::post('/editItem','Blog2Controller@editItem');
	Route::post('/addItem','Blog2Controller@addItem');
	Route::post('/delItem','Blog2Controller@delItem');
});

