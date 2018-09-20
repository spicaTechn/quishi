<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEducationLevelToUserProfile extends Migration
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

            $table->string('educational_level',20)->nullable()->after('location');
            $table->string('faculty',20)->nullable()->after('educational_level');
            $table->string('salary_range',20)->nullable()->after('faculty');
            $table->string('job_experience',20)->nullable()->after('salary_range');
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
            $table->dropColumn('educational_level');
            $table->dropColumn('facult');
            $table->dropColumn('salary_range');
            $table->dropColumn('job_experience');
        });
    }
}
