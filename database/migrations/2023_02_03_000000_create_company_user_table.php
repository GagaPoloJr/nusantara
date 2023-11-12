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
        Schema::create('core.company_user', function (Blueprint $table) {
            $table->id('company_user_id');
            $table->integer('user_id');
            $table->string('company_id')->nullable();
            $table->boolean('as_owner')->default(false);
            $table->timestamps();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->boolean('deleted')->nullable();
            $table->string('delete_by')->nullable();
            $table->timestamp('delete_date')->nullable();
            $table->string('delete_reason')->nullable();
            $table->foreign('user_id')
                ->references('user_id')
                ->on('authenticate.users')
                ->onDelete('cascade');
            $table->foreign('company_id')
                ->references('company_id')
                ->on('core.companys')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core.company_user');
    }
};
