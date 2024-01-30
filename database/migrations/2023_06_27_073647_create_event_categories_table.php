<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('event_categories', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->bigInteger('user_id')->unsigned();
      $table->string('name');
      $table->string('bg_color');
      $table->string('text_color');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('event_categories');
  }
};
