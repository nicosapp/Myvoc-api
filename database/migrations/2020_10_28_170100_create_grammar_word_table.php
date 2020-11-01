<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrammarTermTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('grammar_term', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('grammar_id')->unsigned()->index();
      $table->bigInteger('term_id')->unsigned()->index();
      $table->timestamps();

      $table->foreign('grammar_id')->references('id')->on('grammars')->onDelete('cascade');
      $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('grammar_term');
  }
}
