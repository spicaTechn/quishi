<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeOnForumQuestionsTable extends Migration
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
            $table->enum('type',[0,1])->default(0)->after('posted_on');  // 0 for show name and 1 for hide name
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
            $table->dropColumn('type');
        });
    }
}
