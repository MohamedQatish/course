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
        Schema::create('pharmacist_favorite_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacist_id')->constrained('pharmacists');
            $table->foreignId('medicine_id')->constrained('medicines');
            // $table->string('scientific_name');
            // $table->string('commercial_name');
            // $table->string('category');
            // $table->string('the_manufacture_company');
            // $table->integer('quantity');
            // $table->date('expire_date'); 
            // $table->decimal('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacist_favorite_medicines');
    }
};
