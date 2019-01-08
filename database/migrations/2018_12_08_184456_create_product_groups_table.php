<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_groups', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->unsignedInteger('category_id');
          $table->text('description')->nullable();
          $table->string('image')->default('placeholder.png');
          $table->unsignedInteger('fromSuggestion')->default('0');
          $table->unsignedInteger('user_id');
          $table->string('suggestedBy')->nullable();
          $table->unsignedInteger('viewsCount')->default('0');
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_groups');
    }
}
