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
        Schema::create('outbounds', function (Blueprint $table) {
            $table->id();
            $table->string('sto_number')->unique();
            $table->string('name');
            $table->unsignedBigInteger('location_id');
            $table->integer('category_statuses_id');
            $table->unsignedBigInteger('conditions_id');
            $table->string('pic');
            $table->string('approval_status')->default('Pending');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('approval_by')->nullable();
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('divisions');
            $table->foreign('conditions_id')->references('id')->on('conditions');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('approval_by')->references('id')->on('users')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outbounds');
    }
};
