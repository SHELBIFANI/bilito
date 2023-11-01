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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->dateTime('departure');
            $table->dateTime('arrival');
            $table->foreignId('airline_id')->constrained();
            $table->foreignId('origin_id')->constrained('cities');
            $table->foreignId('destination_id')->constrained('cities');
            $table->integer('capacity');
            $table->bigInteger('price');
            $table->string('plane');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
