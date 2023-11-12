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
        Schema::create('core.notification_rule', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('model');
            $table->string('notified_to');
            $table->string('type');
            $table->string('description');
            $table->string('jenis');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->boolean('deleted')->nullable();
            $table->string('delete_by')->nullable();
            $table->timestamp('delete_date')->nullable();
            $table->string('delete_reason')->nullable();
            $table->unique( array('status','model','notified_to','type','jenis') );
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core.notification_rule');
    }
};
