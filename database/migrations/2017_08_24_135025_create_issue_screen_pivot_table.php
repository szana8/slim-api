<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueScreenPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_screen_pivot', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('issue_screen_id')->unsigned();
            $table->foreign('issue_screen_id')->references('id')->on('issue_screens')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('custom_field_id')->unsigned();
            $table->foreign('custom_field_id')->references('id')->on('custom_fields')->onUpdate('cascade')->onDelete('cascade');

            $table->string('tab')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('issue_screen_pivot', function ($table) {
            $table->dropForeign('issue_screen_pivot_issue_screen_id_foreign');
            $table->dropForeign('issue_screen_pivot_custom_field_id_foreign');
        });

        Schema::dropIfExists('issue_screen_pivot');
    }
}
