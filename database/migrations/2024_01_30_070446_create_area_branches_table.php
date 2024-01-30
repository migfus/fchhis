<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('area_branches', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('area_region_id')->index();
      $table->string('name')->unique();
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('area_branches');
  }
};