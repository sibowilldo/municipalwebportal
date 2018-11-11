<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystemSettingsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('application');
            $table->string('version');
            $table->string('api_key');
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });

        Schema::create('application_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('configuration_id')->unsigned();
            $table->string('key');
            $table->longText('value');
            $table->longText('display');
            $table->boolean('is_mobile')->default(false);
            $table->boolean('is_web')->default(false);
            $table->boolean('is_active')->default(false);

            $table->timestamps();

            $table->foreign('configuration_id')->references('id')->on('configurations')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_settings');
        Schema::dropIfExists('configurations');
    }
}
