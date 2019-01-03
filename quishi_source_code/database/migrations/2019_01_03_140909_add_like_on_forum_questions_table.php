<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLikeOnForumQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_questions', function (Blueprint $table) {
            //
            $table->integer('like')->default(0)->after('total_publish_answer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_questions', function (Blueprint $table) {
            //
            $table->dropColumn('like');
        });
    }
}
