<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            //
            $table->enum('profile_setup_status',array(1,0))->default(0); //to check whether the user setup profile or not
            $table->enum('profile_setup_steps',array(0,1,2,3))->default(0); //to check where the user has setup their profile they can be in the step 1 / 2 / 3
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            //
            $table->dropColumn('profile_setup_status');
            $table->dropColumn('profile_setup_steps');
        });
    }
}
