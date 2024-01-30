<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('events', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->bigInteger('user_id')->unsigned();
      $table->uuid('event_category_id');
      $table->string('title');
      $table->dateTime('start');
      $table->dateTime('end');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('events');
  }
};
