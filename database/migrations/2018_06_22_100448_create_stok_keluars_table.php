<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStokKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_keluars', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('barang_id')->nullable();
            $table->integer('jumlah')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stok_keluars');
    }
}
