<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstimasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimasis', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('order_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('barang_id')->nullable();
            $table->integer('jumlah')->nullable();
            $table->double('harga')->nullable();
            $table->double('total_harga')->nullable();
            $table->string('satuan')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estimasis');
    }
}
