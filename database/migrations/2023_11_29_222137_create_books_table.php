<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Add columns for booking details
            $table->unsignedBigInteger('service_provider_id'); // Foreign key referencing the service provider
            $table->foreign('service_provider_id')->references('id')->on('service_providers');

            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('service_type'); // Plumbing, Pest Control, Home Cleaning, Carpentry, Painting, Electrical, Beauty Services, etc.
            $table->string('service_location');
            $table->dateTime('booking_datetime');
            $table->text('additional_notes')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'completed'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};