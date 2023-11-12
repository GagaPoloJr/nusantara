<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service.projects', function (Blueprint $table) {
            $table->string('project_id')->primary();
            $table->string('project_name');
            $table->integer('dictionary_data_id');
            $table->string('parent')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->boolean('deleted')->nullable();
            $table->string('delete_by')->nullable();
            $table->timestamp('delete_date')->nullable();
            $table->string('delete_reason')->nullable();
            $table->foreign('dictionary_data_id')
                ->references('dictionary_data_id')
                ->on('core.dictionary_data')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service.projects');
    }
};
