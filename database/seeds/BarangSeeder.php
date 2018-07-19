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
        //factory(App\Barang::class,10)->create();
        $data = [['nama_barang' => 'cordura hitam',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],
        
        ['nama_barang' => 'cordura putih',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'polif foam 8ml',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'polif foam 5ml',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'torin 210 viu',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'daun sleting',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'kepala ykk biasa',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'pcs'],

        ['nama_barang' => 'kepala ykk terbalik',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'pcs'],

        ['nama_barang' => 'Double Mesh',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'jala',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'meter'],
        
        ['nama_barang' => 'tali webbing 25',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'tali webbing 38',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'slot bck',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'lusin'],

        ['nama_barang' => 'pcr 22',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'pita 1000',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'benang nilon',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'pcs'],

        ['nama_barang' => 'benang katun',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'pcs'],

        ['nama_barang' => 'Cordura 600 x 600',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Cordura 600 x 900',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Cordura 1000',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Cordura Nilon 750 x 800',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Cordura Nilon 800 x 800',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Cordura Nilon 1000',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Mery Mesh Hitam',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Double Mesh Tipis',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Double Mesh Tebal',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Torin Urex',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Torin PU',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Daun Sleting Gajah Hitam',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Daun Sleting Gajah Warna',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Daun Sleting Emco Hitam',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Daun Sleting Emco Warna',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Tali Webbing FA 20MM',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard'],

        ['nama_barang' => 'Tali Webbing FA 25MM',
        'jumlah' => 0,  
        'harga' => 0,
        'satuan' =>'yard']];
        DB::table('barangs')->insert($data);          
        
    }
}
