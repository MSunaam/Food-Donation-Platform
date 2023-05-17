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
        Schema::create('food_items', function (Blueprint $table) {
                $table->id();
                $table->string('food_name');
                $table->enum('food_category', ['Produce', 'Grains', 'Dairy', 'Meat', 'Packaged', 'Beverages', 'Condiments', 'Frozen']);
                $table->date('expiration_date');
                $table->integer('quantity');
                $table->string('unit');
                $table->foreignId('foodBankId')->constrained(
                    table: 'users', indexName: 'id'
                )->onDelete('cascade');
                $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_items');
    }
};
