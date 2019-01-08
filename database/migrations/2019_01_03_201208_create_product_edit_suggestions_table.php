<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductEditSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_edit_suggestions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('suggestedBy')->nullable();
            $table->string('proposerEmail')->nullable();
            $table->text('suggestion')->nullable();
            $table->unsignedInteger('product_id');
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
        Schema::dropIfExists('product_edit_suggestions');
    }
}
