<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubscriptionCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('client_subscription', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('client_id');
            $table->dateTime('purchased_date');
            $table->dateTime('date_expired');
            $table->enum('status', ['active', 'expired', 'unassigned']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_subscription');
    }
}
