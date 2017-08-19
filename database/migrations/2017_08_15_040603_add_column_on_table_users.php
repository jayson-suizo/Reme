<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOnTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 255)->after('password')->nullable();
            $table->string('last_name', 255)->after('first_name')->nullable();
            $table->integer('user_type')->after('last_name')->nullable();
            $table->string('gender',255)->after("user_type")->nullable();
            $table->integer('age')->after("gender")->nullable();
            $table->integer('profession_type')->after("age")->nullable();
            $table->integer('group_type')->after("profession_type")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
           $table->dropColumn(['first_name','last_name','user_type','gender','age','profession_type','group_type']);
        });
    }
}
