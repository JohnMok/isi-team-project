<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('publisher');
            $table->string('category');
            $table->float('price');
            $table->integer('isbn');
            $table->string('imageurl');
            $table->string('file_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('products');
    }
}