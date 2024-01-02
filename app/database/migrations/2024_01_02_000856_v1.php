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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('age');
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->integer('clientId');
            $table->timestamps();

            $table->foreign('clientId')->references('id')->on('clients');
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('clientId');
            $table->integer('vehicleId');
            $table->timestamps();
            $table->foreign('clientId')->references('id')->on('clients');
            $table->foreign('vehicleId')->references('id')->on('vehicles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('reviews');
    }
};
