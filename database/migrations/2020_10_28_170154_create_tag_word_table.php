<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagWordTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tag_word', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('tag_id')->unsigned()->index();
      $table->bigInteger('word_id')->unsigned()->index();
      $table->timestamps();

      $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
    Schema::dropIfExists('tag_word');
  }
}
