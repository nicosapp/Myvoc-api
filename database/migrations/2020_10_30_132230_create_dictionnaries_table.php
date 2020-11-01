<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionnariesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('dictionnaries', function (Blueprint $table) {
      $table->id();
      $table->string('slug')->unique()->index();
      $table->string('name');
      $table->string('color');
      $table->integer('order');
      $table->bigInteger('user_id')->unsigned()->index();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('dictionnaries');
  }
}
