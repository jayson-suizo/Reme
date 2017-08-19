<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCodeGenerator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('code_generator', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('professional_user_id');
            $table->integer('user_id');
            $table->string('device_id')->nullable();
            $table->string('code_validity')->nullable();
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
        Schema::dropIfExists('code_generator');
    }
}
