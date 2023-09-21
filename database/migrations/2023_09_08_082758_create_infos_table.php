<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('staff_id')->index();
            $table->unsignedBigInteger('agent_id')->index();
            $table->unsignedBigInteger('plan_detail_id')->index();
            $table->unsignedBigInteger('pay_type_id')->index();

            $table->string('bday')->nullable();
            $table->unsignedBigInteger('bplace_id')->nullable();
            $table->boolean('sex')->default(1);
            $table->string('address')->nullable();
            $table->string('address_id')->index();
            $table->date('due_at')->nullable();
            $table->date('fulfilled_at')->nullable();
            $table->string('or')->nullable();
            $table->decimal('cell', 10, 0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infos');
    }
};
