<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('image_url')->nullable();
            $table->string('type')->nullable();
            $table->text('description');
            $table->integer('beds');
            $table->integer('bedrooms');
            $table->double('price');
            $table->double('discountPrice')->nullable();
            $table->double('totalPrice');
            $table->string('address')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();

            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('houses');
    }
}
