<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => ['auth','roles'], 'roles'=>['staff','admin']], function () {
    Route::get('admin', 'Admin\AdminController@index');
    Route::resource('admin/barang', 'Admin\\BarangController');
    Route::resource('admin/estimasi', 'Admin\\EstimasiController');
    Route::delete('admin/order/{idOrder}/estimasi/{idBarang}', ['uses' => 'Admin\EstimasiController@hapusEstimasiBarang', 'as' => 'estimasi.hapusbarang']);
    Route::get('admin/report/{estimasi}', ['uses' => 'Admin\EstimasiController@reportPdf', 'as' => 'estimasi.reportpdf'] );
    //Route::post('admin/report', ['uses' => 'Admin\EstimasiController@reportPdf', 'as' => 'estimasi.reportpdf'] );

    // Route::resource('admin/stok-keluar', 'Admin\\StokKeluarController');
    //datatable
    Route::get('admin/order/data',['uses'=>'Admin\OrderController@getMasterData', 'as' => 'order.data']);
    Route::get('admin/order/datadetail/{id}',['uses'=>'Admin\OrderController@getDetailsData', 'as' => 'order.detail']);
    Route::get('admin/order/data/selesai',['uses'=>'Admin\OrderController@orderSelesai', 'as' => 'order.data.selesai']);
    Route::get('admin/order/excel', 'Admin\OrderController@laporanexcel');
    Route::get('admin/order/selesai', ['uses' => 'Admin\OrderController@getOrderSelesai', 'as' => 'get.order.selesai']);
    Route::get('admin/order/harga', ['uses' => 'Admin\OrderController@ajaxHarga', 'as' => 'get.harga']);

    Route::resource('admin/order', 'Admin\\OrderController');
    Route::post('admin/order/{id}/transaksi', ['uses' => 'Admin\OrderController@orderTransaksi', 'as' => 'order.transaksi']);
    Route::post('admin/order/{id}/estimasi', ['uses' => 'Admin\EstimasiController@orderEstimasi', 'as' => 'order.estimasi']);
    Route::get('admin/order/detail/{id}',['uses' => 'Admin\OrderController@orderDetail', 'as' => 'order.detail']);
    
    Route::delete('admin/order/{idOrder}/transaksi/{idBarang}', ['uses' => 'Admin\OrderController@hapusOrderBarang', 'as' => 'order.hapusbarang']);
    Route::get('admin/order/selesai/{id}', ['uses' => 'Admin\OrderController@selesai', 'as' => 'order.selesai']);
    

    Route::resource('admin/jenis-order', 'Admin\\JenisOrderController');
    // Route::resource('admin/transaksi', 'Admin\\TransaksiController');
    Route::resource('admin/stok-masuk', 'Admin\\StokMasukController')->except(['edit']);

    Route::resource('admin/report-transaksi', 'Admin\\ReportController');
    Route::post('admin/report/gettanggal',['uses'=>'Admin\ReportController@getTanggal','as'=>'report.tanggal']);
    Route::get('admin/report/export/{type}', 'Admin\ReportController@exportOrder');
    
});




Route::group(['prefix' => 'admin', 'middleware' => ['auth','roles'], 'roles'=>'admin'], function () {
   
    Route::resource('roles', 'Admin\RolesController');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::resource('users', 'Admin\UsersController');
    Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
   
    
 });

