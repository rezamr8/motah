<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 3;$i++){
            DB::table('barangs')->insert([
                'nama_barang' => 'barang '.$i,
                'jumlah' => 20,
                'harga' => 1000,
                'satuan' =>'pcs',
                'created_at'=>now(),
            ]);
        };

       

        
    }
}