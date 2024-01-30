<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('f_a_q_s', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('email')->nullable();
      $table->decimal('phone', 10, 0)->nullable();
      $table->bigInteger('answer_user_id')->unsigned();
      $table->bigInteger('approved_user_id')->unsigned()->nullable();
      $table->string('question');
      $table->string('answer');
      $table->integer('points')->default(0)->unsinged();
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('f_a_q_s');
  }
};
