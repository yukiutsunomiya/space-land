<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->string('img1')->nullable()->comment('imagMain');
            $table->string('img2')->nullable()->comment('imagSub');
            $table->string('description')->nullable();
            $table->integer('releaseYear')->nullable();
            $table->integer('releaseMonth')->nullable();
            $table->integer('releaseDate')->nullable();
            $table->integer('order')->nullable();
            $table->string('situation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
