<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('admin', 'Admin\AdminController@index');


 

Route::group(['middleware' => ['auth','roles'], 'roles'=>['staff','admin']], function () {
    Route::resource('admin/barang', 'Admin\\BarangController');
    Route::resource('admin/stok-keluar', 'Admin\\StokKeluarController');
    //datatable
    Route::get('admin/order/data',['uses'=>'Admin\OrderController@getMasterData', 'as' => 'order.data']);
    Route::get('admin/order/datadetail/{id}',['uses'=>'Admin\OrderController@getDetailsData', 'as' => 'order.detail']);
    Route::resource('admin/order', 'Admin\\OrderController');
    Route::post('admin/order/{id}/transaksi', ['uses' => 'Admin\OrderController@orderTransaksi', 'as' => 'order.transaksi']);
    Route::delete('admin/order/{idOrder}/transaksi/{idBarang}', ['uses' => 'Admin\OrderController@hapusOrderBarang', 'as' => 'order.hapusbarang']);


    Route::resource('admin/jenis-order', 'Admin\\JenisOrderController');
    Route::resource('admin/transaksi', 'Admin\\TransaksiController');
    Route::resource('admin/stok-masuk', 'Admin\\StokMasukController');
});




Route::group(['prefix' => 'admin', 'middleware' => ['auth','roles'], 'roles'=>'admin'], function () {
   
    Route::resource('roles', 'Admin\RolesController');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::resource('users', 'Admin\UsersController');
    Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
   
    
 });
