<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('logs', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id')->index();
      $table->unsignedBigInteger('log_category_id')->index();
      $table->string('content');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('logs');
  }
};
