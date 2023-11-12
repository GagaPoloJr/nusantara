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
        Schema::create('core.dictionary_data', function (Blueprint $table) {
            $table->id('dictionary_data_id');
            $table->string('dictionary_id');
            $table->string('value')->unique();
            $table->string('view');
            $table->boolean('default')->default(false);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->boolean('deleted')->nullable();
            $table->string('delete_by')->nullable();
            $table->timestamp('delete_date')->nullable();
            $table->string('delete_reason')->nullable();
            $table->foreign('dictionary_id')
                ->references('dictionary_id')
                ->on('core.dictionarys')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique( array('dictionary_id','value','view',) );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core.dictionary_data');
    }
};
