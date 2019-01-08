<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('Glavna Reklama' . rand(1,100));
            $table->string('link')->nullable();
            $table->integer('active')->default('0');
            $table->integer('intervalInSeconds')->default('0');
            $table->string('popupImage')->nullable();
            $table->string('downImage')->nullable();
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
        Schema::dropIfExists('main_ads');
    }
}
