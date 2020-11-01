<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTermTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('category_term', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('category_id')->unsigned()->index();
      $table->bigInteger('term_id')->unsigned()->index();
      $table->timestamps();

      // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
      // $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('category_term');
  }
}
