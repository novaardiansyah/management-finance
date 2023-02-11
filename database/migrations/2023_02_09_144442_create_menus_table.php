<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('menus', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('icon')->default('fa-minus')->comment('Font Awesome Icon');
      $table->string('url')->default('/')->comment('URL');
      $table->tinyInteger('is_parent')->default(0);
      $table->tinyInteger('is_active')->default(0);
      $table->tinyInteger('is_deleted')->default(0);
      $table->foreignId('created_by')->default(1)->constrained('users');
      $table->foreignId('updated_by')->default(1)->constrained('users');
      $table->foreignId('deleted_by')->nullable()->constrained('users');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('menus');
  }
}
