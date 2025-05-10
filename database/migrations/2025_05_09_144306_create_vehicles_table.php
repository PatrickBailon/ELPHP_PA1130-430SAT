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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('vehicles_id');
            $table->unsignedBigInteger('users_id'); // owner
            $table->string('vehicles_name');
            $table->string('plate_number')->unique();
            $table->string('model');
            $table->string('fuel_type');
            $table->decimal('price_per_day', 8, 2);
            $table->string('location');
            $table->timestamps();
        
            $table->foreign('users_id')->references('users_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
