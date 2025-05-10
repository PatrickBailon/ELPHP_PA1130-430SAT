<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\select;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('bookings_id');
            $table->unsignedBigInteger('users_id'); // renter
            $table->unsignedBigInteger('vehicles_id');
            $table->date('pickup_date');
            $table->date('return_date');
            $table->decimal('total_price', 10, 2);
            $table->string('status');
            $table->timestamps();
        
            $table->foreign('users_id')->references('users_id')->on('users')->onDelete('cascade');
            $table->foreign('vehicles_id')->references('vehicles_id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
