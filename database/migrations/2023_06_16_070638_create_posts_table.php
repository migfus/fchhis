<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('posts', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('post_category_id');
      $table->bigInteger('user_id')->unsigned();
      $table->boolean('active')->default(0);
      $table->string('title');
      $table->string('content');
      $table->string('cover');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('posts');
  }
};
