<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('terms', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('user_id')->unsigned()->index();
      $table->bigInteger('old_id')->nullable();
      $table->string('langue')->length(50)->nullable();
      $table->string('forme')->length(50)->nullable();
      $table->tinyInteger('cross_dico')->default(0);
      $table->string('pre')->length(50)->nullable();
      $table->string('lang')->nullable();
      $table->string('suf')->length(50)->nullable();
      $table->string('genre')->length(50)->nullable();
      $table->string('nbr')->length(50)->nullable();
      $table->string('fra')->nullable();
      $table->string('pronon')->nullable();
      $table->string('dep')->nullable();
      $table->text('def')->nullable();
      $table->text('def_json')->nullable();
      $table->text('ex_json')->nullable();
      $table->text('web_def')->nullable();
      $table->text('conj')->nullable();
      $table->string('gram')->nullable();
      $table->string('level')->nullable();
      $table->timestamp('date')->nullable();
      $table->timestamp('modif')->nullable();
      $table->integer('note')->nullable();
      $table->integer('imp')->nullable();
      $table->string('mode')->nullable();
      $table->string('temps')->nullable();
      $table->integer('freq')->nullable();
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
    Schema::dropIfExists('terms');
  }
}
