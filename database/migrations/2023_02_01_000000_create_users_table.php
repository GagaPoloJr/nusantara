<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authenticate.users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nik')->nullable();
            $table->string('user_name');
            $table->string('email');
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->string('gender');
            $table->string('no_hp');
            $table->string('image')->nullable();
            $table->boolean('cross_company')->default('f');
            $table->string('description')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamp('delete_at')->nullable();
            $table->string('delete_by')->nullable();
            $table->string('delete_reason')->nullable();
            $table->unique( array('nik','email') );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authenticate.users');
    }
};
