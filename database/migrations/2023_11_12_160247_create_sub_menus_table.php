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
        Schema::create('core.sub_menus', function (Blueprint $table) {
            $table->id('sub_menu_id');
            $table->string('sub_menu_name')->unique();
            $table->string('url')->nullable()->unique();
            $table->string('sort')->default(0);
            $table->integer('menu_id');
            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('core.menus')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
     */
    public function down(): void
    {
        Schema::dropIfExists('core.sub_menus');
    }
};
