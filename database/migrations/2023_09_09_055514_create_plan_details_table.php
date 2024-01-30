<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('plan_details', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->unsignedBigInteger('user_id')->index();
      $table->uuid('plan_id')->index();

      $table->tinyInteger('age_start');
      $table->tinyInteger('age_end');
      $table->text('desc')->nullable();

      $table->timestamps();
    });
  }


  public function down(): void {
    Schema::dropIfExists('plan_details');
  }
};
