<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTermTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tag_term', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('tag_id')->unsigned()->index();
      $table->bigInteger('term_id')->unsigned()->index();
      $table->timestamps();

      $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
    Schema::dropIfExists('tag_term');
  }
}
