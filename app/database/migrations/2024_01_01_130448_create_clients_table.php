<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phoneNumber')->unique();
            $table->string('licenseRegistration')->nullable(); // Se licenseRegistration puder ser nulo
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('serviceName')->unique();
            $table->string('shortDescription');
            $table->string('specialty');
            $table->float('coast');
            $table->float('price');
            $table->string('items');
            $table->integer('averageTime');
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicleName');
            $table->integer('vehicleOwner');
            $table->string('vehicleModel')->nullable();
            $table->integer('vehicleYear')->nullable();
            $table->string('vehiclePlate')->unique(); // Se vehiclePlate puder ser nulo
            $table->timestamps();

            $table->foreign('vehicleOwner')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('services');
    }
}
