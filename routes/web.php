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

//Route::get('/', function () {
    //return view('welcome');
//});
Route::get('/', 'MainController@index');
Route::get('/test', function () {
    return view('test1');
});
Route::get('/welcome1', function () {
    return view('welcome1');
});
//Route::get('/track', function () {
    //return view('cart.track');
//});
Route::get('/track', 'TrackController@index');
//Route::get('/products', function () {
  //  return view('products.index');
//});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/product/new', 'ProductController@newProduct');
Route::get('/admin/products', 'ProductController@index');
Route::get('/admin/product/destroy/{id}', 'ProductController@destroy');
Route::post('/admin/product/save', 'ProductController@add');

Route::get('/addProduct/{productId}', 'CartController@addItem');
Route::get('/removeItem/{productId}', 'CartController@removeItem');
Route::get('/cart', 'CartController@showCart');
Route::get('/product/{product}', 'ProductController@productDetail');

Route::post('/track',  'TrackController@addItem');


Route::get('/track/{track}', 'TrackController@orderDetail');
Route::post('/product/rating/{product}', 'ProductController@comment');



//Admin
Route::get('/master-order', 'TrackController@masterOrder');
Route::get('/master-order/{track}', 'TrackController@masterOrderDetail');
Route::post('/master-order/state-save/{track}', 'TrackController@state');
//Route::get('/query', function () {
 //   return view('products.query');
//});
//Route::post('/query',  'ProductController@query');

//Route::post('/track',  function () {
    //dd(auth()->user()->cartItems);
//});