<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->index();
            $table->string('title');
            $table->text('content')->nullable();
            $table->unsignedInteger('user_id');
            $table->enum('type',[0,1])->default(0); // 0 for the page and 1 for the media
            $table->enum('status',['publish','draft','unpublish'])->default('publish');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // userid is created by
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
        Schema::dropIfExists('pages');
    }
}
