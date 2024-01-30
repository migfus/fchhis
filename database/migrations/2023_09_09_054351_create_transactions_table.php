<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('transactions', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('or')->unique()->nullable();
      $table->unsignedBigInteger('agent_id')->index();
      $table->unsignedBigInteger('staff_id')->index();
      $table->unsignedBigInteger('client_id')->index();
      $table->uuid('pay_type_id')->index();
      $table->uuid('plan_detail_id')->index();

      $table->decimal('amount', 15, 2);

      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('transactions');
  }
};
