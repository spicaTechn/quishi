<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsApprovedOnEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('education', function (Blueprint $table) {
            //
            $table->enum('is_approved',[0,1])->default(1)->after('parent'); // 1 for the superadmin added content and 0 for the customer added major
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education', function (Blueprint $table) {
            //
            $table->dropColumn('is_approved');
        });
    }
}
