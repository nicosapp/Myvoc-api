<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyTermTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('taxonomy_term', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('taxonomy_id')->unsigned()->index();
      $table->bigInteger('term_id')->unsigned()->index();
      $table->timestamps();

      $table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onDelete('cascade');
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
    Schema::dropIfExists('taxonomy_term');
  }
}
