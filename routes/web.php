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

Route::get('/', 'HomeController@index')->name('/');
Route::get('inventarios', 'HomeController@inventarios')->name('inventarios');
Route::get('ventas', 'HomeController@ventas')->name('ventas');
Route::post('create_inventario', 'HomeController@create_inventario');
Route::post('delete_inventario/{id}', 'HomeController@delete_inventario');
Route::post('edit_inventario', 'HomeController@edit_inventario');
Route::post('search_producto', 'HomeController@search_producto');
Route::post('create_venta', 'HomeController@create_venta');

