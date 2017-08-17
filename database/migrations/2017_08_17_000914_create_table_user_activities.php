<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('user_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('session_date');
            $table->integer('intervention_type')->nullable();
            $table->integer('rate_before')->nullable();
            $table->integer('rate_after')->nullable();
            $table->text('comment')->nullable();
            $table->text('professional_comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activities');
    }
}
