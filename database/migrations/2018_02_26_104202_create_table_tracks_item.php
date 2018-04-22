<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTracksItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('track_id');
            $table->integer('product_id');
            $table->float('product_price');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::drop('track_items');
    }
}
