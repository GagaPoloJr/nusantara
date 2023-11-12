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
        Schema::create('core.menus', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('menu_name')->unique();
            $table->string('url')->nullable()->unique();
            $table->string('icon')->nullable();
            $table->bigInteger('main_menu')->nullable();
            $table->string('sort')->default(0);
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
        Schema::dropIfExists('core.menu');
    }
};
