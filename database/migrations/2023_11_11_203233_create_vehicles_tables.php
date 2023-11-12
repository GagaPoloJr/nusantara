<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('core.vehicles', function (Blueprint $table) {
            $table->string('vehicle_id')->primary();
            $table->string('vehicle_name');
            $table->string('vehicle_code')->unique();
            $table->string('vehicle_number')->unique();
            $table->string('vehicle_category');
            $table->foreign('vehicle_category')
                ->references('category_code')
                ->on('core.vehicle_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->boolean('deleted')->nullable();
            $table->string('delete_by')->nullable();
            $table->timestamp('delete_date')->nullable();
            $table->string('delete_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core.vehicles');
    }
};
