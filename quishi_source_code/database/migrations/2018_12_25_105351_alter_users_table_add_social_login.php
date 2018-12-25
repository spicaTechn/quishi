<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableAddSocialLogin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('provider')->nullable()->after('logged_in_type');
            $table->string('provider_id')->nullable()->after('provider');
            $table->enum('sign_in_type',[0,1])->default(0)->after('provider_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('provider');
            $table->dropColumn('provider_id');
            $table->dropColumn('sign_in_type');
        });
    }
}
