<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTranslations extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('translations', function (Blueprint $table) {
      $table->string('langue')->nullable();
      $table->string('type')->nullable();
      $table->integer('position_native')->default(1);
      $table->integer('position_translation')->default(1);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('translations', function (Blueprint $table) {
      $table->dropColumn('langue');
      $table->dropColumn('type');
      $table->dropColumn('position_native');
      $table->dropColumn('position_translation');
    });
  }
}
