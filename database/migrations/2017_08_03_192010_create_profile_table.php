<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->text('bio')->nullable();
            $table->date('birthday')->nullable();
            $table->string('location')->nullable();
            $table->string('telephone')->nullable();
            $table->string('salutation')->nullable();
            $table->integer('timezone')->nullable();
            $table->string('title')->nullable();

            $table->string('attribute1')->nullable();
            $table->string('attribute2')->nullable();
            $table->string('attribute3')->nullable();
            $table->string('attribute4')->nullable();
            $table->string('attribute5')->nullable();
            $table->string('attribute6')->nullable();
            $table->string('attribute7')->nullable();
            $table->string('attribute8')->nullable();
            $table->string('attribute9')->nullable();
            $table->string('attribute10')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function ($table) {
            $table->dropForeign('profiles_user_id_foreign');
        });

        Schema::dropIfExists('profiles');
    }
}
