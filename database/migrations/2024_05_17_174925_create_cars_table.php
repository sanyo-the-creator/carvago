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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('carModel');
            $table->string('tags');
            $table->boolean('available')->default(true);
            $table->text('description')->nullable();
            $table->decimal('rental_price_per_day', 8, 2);
            $table->timestamps();

            //realtion values
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
