<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOnTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('new_email')->after("verification_code")->nullable();
            $table->integer('email_verification_code')->after("new_email")->nullable();
            $table->string('new_password')->after("email_verification_code")->nullable();
            $table->integer('password_verification_code')->after("new_password")->nullable();
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
           $table->dropColumn(['new_email','email_verification_code','new_password','password_verification_code']);
        });
    }
}
