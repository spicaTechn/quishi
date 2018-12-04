<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOnUserProfileQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile_queries', function (Blueprint $table) {
            //

            $table->unsignedInteger('answer_id')->after('user_id');
            //add answer_id as the foregin key
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profile_queries', function (Blueprint $table) {
            //
            $table->dropForeign('[answer_id]');
            $table->dropColumn('answer_id');
        });
    }
}
