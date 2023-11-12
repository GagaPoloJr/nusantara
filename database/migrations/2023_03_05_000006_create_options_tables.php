<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('core.options', function (Blueprint $table) {
            $table->string('option_id')->primary();
            $table->text('value');
            $table->string('description');
            $table->timestamps();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->boolean('deleted')->nullable();
            $table->string('delete_by')->nullable();
            $table->timestamp('delete_date')->nullable();
            $table->string('delete_reason')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('core.options');
    }
};
