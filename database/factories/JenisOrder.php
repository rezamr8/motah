<?php

use Faker\Generator as Faker;

$factory->define(App\JenisOrder::class, function (Faker $faker) {
    return [
        'nama_order' => $faker->randomElement($array = array ('Blood','Mootley','ProShop')),
        'jenis' => $faker->randomElement($array = array ('Topi','Tas'))
    ];
});
