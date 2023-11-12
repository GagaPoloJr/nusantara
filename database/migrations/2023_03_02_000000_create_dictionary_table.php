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
        Schema::create('core.dictionarys', function (Blueprint $table) {
            $table->string('dictionary_id')->primary();
            $table->string('name')->unique();
            $table->string('key')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->boolean('deleted')->nullable();
            $table->string('delete_by')->nullable();
            $table->timestamp('delete_date')->nullable();
            $table->string('delete_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core.dictionarys');
    }
};
