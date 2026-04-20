<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // e.g. "Double Room with River View"
            $table->string('type');             // double, family, suite, single
            $table->decimal('price', 8, 2);     // price per night in MAD
            $table->text('description');
            $table->string('image')->nullable(); // image filename
            $table->integer('capacity')->default(2);
            $table->string('view')->nullable();  // river, garden, mountain, pool
            $table->boolean('has_balcony')->default(false);
            $table->boolean('has_ac')->default(true);
            $table->boolean('available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};