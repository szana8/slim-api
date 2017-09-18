<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing Menus
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->string('display_name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create table for storing menu items
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('menu_id');
            $table->string('name', 100)->unique();
            $table->string('link')->nullable()->default(null);
            $table->text('description')->nullable();
            $table->integer('parent_id')->nullable()->default(null);
            $table->integer('sequence')->nullable()->default(-1);
            $table->enum('enabled', ['Y', 'N'])->default('Y');
            $table->enum('type', ['DEF', 'BTN', 'DIV', 'SEA', 'ICO'])->default('DEF');

            $table->foreign('menu_id')->references('id')->on('menus')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menus');
    }
}
