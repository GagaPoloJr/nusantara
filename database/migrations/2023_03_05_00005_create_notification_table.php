<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('core.notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->string('ticket_id');
            $table->string('type');
            $table->text('content');
            $table->bigInteger('send_to');
            $table->text('action');
            $table->string('status')->nullable();
            $table->foreign('send_to')
                ->references('user_id')
                ->on('authenticate.users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('core.notifications');
    }
};
