<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumQuestionAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_question_answer', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('forum_question_id');
            $table->unsignedInteger('user_id');
            $table->text('content');
            $table->unsignedInteger('parent');
            $table->timestamp('answered_on');
            $table->foreign('forum_question_id')->references('id')->on('forum_questions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('forum_question_answer');
    }
}
