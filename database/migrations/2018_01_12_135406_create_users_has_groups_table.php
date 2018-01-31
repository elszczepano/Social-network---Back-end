<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersHasGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_has_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('users_has_groups', function (Blueprint $table) {
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
        });
        Schema::table('users_has_groups', function (Blueprint $table) {
            $table->foreign('group_id')
            ->references('id')
            ->on('groups');
        });
        Schema::table('users_has_groups', function (Blueprint $table) {
            $table->foreign('role_id')
            ->references('id')
            ->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_has_groups');
    }
}