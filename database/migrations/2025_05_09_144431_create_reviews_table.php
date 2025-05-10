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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('reviews_id');
            $table->unsignedBigInteger('users_id'); // renter
            $table->unsignedBigInteger('vehicles_id');
            $table->tinyInteger('rating');
            $table->text('comment');
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
        Schema::dropIfExists('reviews');
    }
};
