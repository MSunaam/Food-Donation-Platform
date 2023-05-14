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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('user_type', ['restaurant', 'groceryStore', 'foodBank']);
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('address');
            $table->string('city')->nullable()->default('');
            $table->string('state')->nullable()->default('');
            $table->string('zip_code')->nullable()->default('');
            $table->string('country')->nullable()->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
