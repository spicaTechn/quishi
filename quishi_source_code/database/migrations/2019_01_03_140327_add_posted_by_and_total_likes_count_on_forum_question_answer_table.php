<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostedByAndTotalLikesCountOnForumQuestionAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_question_answer', function (Blueprint $table) {
            //
            $table->unsignedInteger('posted_by')->after('type');
            $table->integer('total_like_counts')->default(0)->after('content');

            //add foreign key
            $table->foreign('posted_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_question_answer', function (Blueprint $table) {
            //
            $table->dropForeign('[posted_by]');
            $table->dropColumn('posted_by');
            $table->dropColumn('total_like_counts');
        });
    }
}
