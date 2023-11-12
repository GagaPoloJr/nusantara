<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('core.file_attachments', function (Blueprint $table) {
            $table->id('file_attachment_id');
            $table->string('object_id')->nullable();
            $table->string('object');
            $table->string('file_name');
            $table->string('file_type');
            $table->string('file_url');
            $table->string('status');
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
        Schema::dropIfExists('core.file_attachments');
    }

};
