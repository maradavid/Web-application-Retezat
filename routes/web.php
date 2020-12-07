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
/*Route::get('/users/{id}/{name}', function($id, $name){
    return 'Acesta este utilizatorul '.$name.' cu id-ul '.$id;
});
*/
/*Route::get('/', function () {
    return view('welcome');
});*/

//Route::get('/', 'PagesController@index' );

/*Route::get('/', function(){
    return view('pages.index');
});
*/
/*Route::get('/about', function(){ 
    return view('pages.about');
});

Route::get('/services', function(){
    return view('pages.services'); 
});  
Route::resource('posts', 'PostsController');
*/
 
Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/services','PagesController@services');
Route::resource('/posts', 'PostsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/trails', 'TrailsController');
Route::get('/retezat', 'PagesController@retezat');
Route::get('/retezatulmic', 'PagesController@retezatulmic');