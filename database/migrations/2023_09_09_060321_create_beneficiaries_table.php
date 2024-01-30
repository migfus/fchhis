<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('beneficiaries', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->unsignedBigInteger('user_id')->index();
      $table->unsignedBigInteger('staff_id')->index();
      $table->string('name');
      $table->date('bday');
      $table->timestamps();
    });
  }

  public function down(): void{
    Schema::dropIfExists('beneficiaries');
  }
};
