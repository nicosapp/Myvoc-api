<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryWordTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('category_word', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('category_id')->unsigned()->index();
      $table->bigInteger('word_id')->unsigned()->index();
      $table->timestamps();

      // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
      // $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('category_word');
  }
}
