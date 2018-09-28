<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->enum('status',[1,0])->default(0)->index();
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->integer('profile_views')->unsigned()->default(0);
            $table->integer('total_likes')->unsigned()->default(0);
            $table->string('image_path')->nullable();
            $table->char('age_group',1)->default(0)->index();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('registered_date');
            $table->foreign('user_id')->references('id')
                                      ->on('users')
                                      ->onDelete('cascade');
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
        Schema::dropIfExists('user_profile');
    }
}
