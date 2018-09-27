<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteFacultyFromUserProfile extends Migration
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
            $table->dropColumn('faculty');
            $table->unsignedInteger('education_id')->after('educational_level')->nullable();
            $table->foreign('education_id')->references('id')->on('education')->onDelete('cascade');
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
            $table->string('faculty',20)->after('description');
            $table->dropForeign('education_id');
            $table->dropColumn('education_id');
        });
    }
}
