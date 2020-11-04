<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyMetasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('taxonomy_metas', function (Blueprint $table) {
      $table->id();
      $table->string('meta_key');
      $table->text('meta_value')->nullable();
      $table->bigInteger('taxonomy_id')->unsigned()->index();

      $table->foreign('taxonomy_id')->references('id')->on('taxonomies')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('taxonomy_metas');
  }
}
