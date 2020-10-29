<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrammarWordTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('grammar_word', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('grammar_id')->unsigned()->index();
      $table->bigInteger('word_id')->unsigned()->index();
      $table->timestamps();

      $table->foreign('grammar_id')->references('id')->on('grammars')->onDelete('cascade');
      $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('grammar_word');
  }
}
