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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donor_id');
            $table->unsignedBigInteger('receiver_id');
            $table->string('food_name');
            $table->enum('food_category', ['Produce', 'Grains', 'Dairy', 'Meat', 'Packaged', 'Beverages', 'Condiments', 'Frozen']);
            $table->enum('status', ['scheduled', 'picked_up', 'cancelled', 'completed']);
            $table->dateTime('scheduled_pickup_time');
            $table->dateTime('actual_pickup_time')->nullable();
            $table->timestamps();

            $table->foreign('donor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation');
    }
};
