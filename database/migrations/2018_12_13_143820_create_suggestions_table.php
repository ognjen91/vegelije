<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestions', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('manufacturer')->nullable();
          $table->unsignedInteger('legality'); //ovdje ide samo broj jer se svejedno pretvara kad se pravi proizvod
          $table->text('description')->nullable();
          $table->string('tags')->nullable(); //takodje neobradjeni, tj forma implodovanog array-a, separator je ","
          $table->integer('accepted')->default('0');
          $table->string('suggestedBy')->nullable();
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
        Schema::dropIfExists('suggestions');
    }
}
