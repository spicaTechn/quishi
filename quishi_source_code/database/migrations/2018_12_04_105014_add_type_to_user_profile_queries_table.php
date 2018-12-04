<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToUserProfileQueriesTable extends Migration
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

            $table->enum('type',[0,1])->default(0)->after('posted_on'); //0 for the logged and 1 for the anonymous queries type
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
            $table->dropColumn('type');
        });
    }
}
