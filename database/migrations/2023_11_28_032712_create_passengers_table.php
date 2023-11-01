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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('gender');
            $table->string('national_code');
            $table->dateTime('birthdate');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        Schema::create('passenger_order', function (Blueprint $table) {
            $table->foreignId('passenger_id')->constrained();
            $table->foreignId('order_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
