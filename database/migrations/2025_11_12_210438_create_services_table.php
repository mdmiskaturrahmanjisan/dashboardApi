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
      Schema::create('services', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('duration');
    $table->string('duration_unit');
    $table->integer('required_servicemen');
    $table->integer('discount')->default(0);
    $table->decimal('price', 10, 2);
    $table->decimal('service_rate', 10, 2);
    $table->string('type')->default('fixed');
    $table->unsignedBigInteger('category_id')->nullable();
    $table->boolean('status')->default(1);
    $table->unsignedBigInteger('user_id')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
