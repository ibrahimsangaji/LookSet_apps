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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_number');
            $table->string('asset_number')->nullable();
            $table->string('sto_number')->nullable();
            $table->string('name');
            $table->integer('device_id');
            $table->integer('software_id')->nullable();
            $table->integer('rack_id')->nullable();
            $table->integer('category_statuses_id');
            $table->integer('conditions_id');
            $table->integer('locations_id')->nullable();
            $table->integer('created_by');
            $table->integer('approval_by');
            $table->text('explanation');
            $table->string('pic')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
