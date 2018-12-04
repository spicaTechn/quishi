<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToForumQuestionAnswerTable extends Migration
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
            $table->enum('type',[0,1])->default(0)->after('answered_on');  // 0 for the show name 1 for the anonymous username
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
            $table->dropColumn('type');
        });
    }
}
