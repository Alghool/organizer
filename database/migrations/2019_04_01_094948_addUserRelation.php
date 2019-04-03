<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contexts', function (Blueprint $table) {
            $table->integer('user_id');
            $table->index('user_id');
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->integer('user_id');
            $table->index('user_id');
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('user_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contexts', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
