<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToForumQuestionsTable extends Migration
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
            //$table->text('title')->change();
            $table->text('slug')->after('title');
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
            //$table->string('title',161)->change();
            $table->dropColumn('slug');
        });
    }
}
