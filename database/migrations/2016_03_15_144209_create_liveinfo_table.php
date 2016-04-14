<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liveinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->unique();
            $table->integer('ctime')->index();
            $table->string('title');
            $table->string('description');
            $table->string('activityId');
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
        Schema::drop('liveinfo');
    }
}
