<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Legalables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('legalables', function (Blueprint $table) {
        $table->integer('legality_id');
        $table->integer('legalable_id');
        $table->string('legalable_type');
        $table->primary(['legality_id', 'legalable_id', 'legalable_type']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('legalables');

    }
}
