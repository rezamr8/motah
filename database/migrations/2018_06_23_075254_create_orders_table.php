<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('jenis_order_id')->nullable();
            $table->integer('jumlah')->nullable();
            $table->date('tgl_beres')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('no_order')->nullable();
            $table->double('modal')->nullable();
            $table->double('sisa')->nullable();
            $table->boolean('status')->default(0);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
