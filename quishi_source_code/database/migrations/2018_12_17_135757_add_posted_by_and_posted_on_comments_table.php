<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostedByAndPostedOnCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            //
            $table->unsignedInteger('posted_by')->after('type');
            $table->timestamp('posted_on')->nullable();
            $table->foreign('posted_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            //
            $table->dropForeign('[posted_by]');
            $table->dropColumn('posted_by');
            $table->dropColumn('posted_on');
        });
    }
}
