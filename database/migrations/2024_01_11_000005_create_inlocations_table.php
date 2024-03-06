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
        Schema::create('inlocations', function (Blueprint $table) {
            $table->id();
            $table->string('loc_number');
            $table->string('sto_number');
            $table->integer('location_id');
            $table->timestamps();

            $table->foreign('sto_number')->references('sto_number')->on('outbounds');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inlocations');
    }
};
