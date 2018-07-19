<?php

use Faker\Generator as Faker;

// for($i = 0; $i < 3;$i++){
//     DB::table('barangs')->insert([
//         'nama_barang' => 'barang '.$i,
//         'jumlah' => 20,
//         'harga' => 1000,
//         'satuan' =>'pcs',
//         'created_at'=>now(),
//     ]);
// };
$factory->define(App\Barang::class, function (Faker $faker) {
    return [
        'nama_barang' => 'barang '.$faker->text(5),
        'jumlah' => 20,
        'harga' => 1000,
        'satuan' =>'pcs'
    ];
});
