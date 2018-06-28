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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', 'Admin\AdminController@index');
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::resource('admin/users', 'Admin\UsersController');
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);



Route::resource('admin/barang', 'Admin\\BarangController');
Route::resource('admin/stok-keluar', 'Admin\\StokKeluarController');
Route::resource('admin/order', 'Admin\\OrderController');
Route::post('admin/order/{id}/transaksi', ['uses' => 'Admin\OrderController@orderTransaksi', 'as' => 'order.transaksi']);
Route::resource('admin/jenis-order', 'Admin\\JenisOrderController');
Route::resource('admin/transaksi', 'Admin\\TransaksiController');