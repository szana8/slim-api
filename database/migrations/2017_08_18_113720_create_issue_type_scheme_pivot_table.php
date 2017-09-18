<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueTypeSchemePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_type_scheme_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issue_type_scheme_id')->unsigned();
            $table->foreign('issue_type_scheme_id')->references('id')->on('issue_type_scheme')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('issue_type_id')->unsigned();
            $table->foreign('issue_type_id')->references('id')->on('issue_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('issue_type_scheme_pivot', function ($table) {
            $table->dropForeign('issue_type_scheme_pivot_issue_type_scheme_id_foreign');
            $table->dropForeign('issue_type_scheme_pivot_issue_type_id_foreign');
        });
        Schema::dropIfExists('issue_type_scheme_pivot');
    }
}
