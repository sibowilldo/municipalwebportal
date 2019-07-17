<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('device_id');
            $table->string('os');
            $table->string('token');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::create('device_user', function(Blueprint $table){
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('device_id');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(false);

            $table->timestamps();
            $table->primary(['user_id', 'device_id']);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('device_id')->references('id')->on('devices')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_user');
        Schema::dropIfExists('devices');
    }
}
