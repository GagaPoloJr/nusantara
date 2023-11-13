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
        Schema::create('core.vehicles_checklists', function (Blueprint $table) {
            $table->id('checklist_id');
            $table->string('vehicle_code');
            $table->foreign('vehicle_code')
                ->references('vehicle_code')
                ->on('core.vehicles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('form_id');
            $table->foreign('form_id')
                ->references('form_id')
                ->on('core.form_checks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('status')->nullable();
            $table->integer('is_good')->nullable();
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
        Schema::dropIfExists('core.vehicles_checklists');
    }
};
