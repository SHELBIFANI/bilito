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
            $table->dateTime('flight_date');
            $table->time('departure');
            $table->time('arrival');
            $table->foreignId('airline_id')->constrained();
            $table->foreignId('from_id')->constrained('cities');
            $table->foreignId('to_id')->constrained('cities');
            $table->integer('capacity');
            $table->bigInteger('price');
            $table->string('airplane');
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
