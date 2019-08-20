<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('previous_status');
            $table->unsignedInteger('status_id');
            $table->string('account_number');
            $table->mediumText('update_reason')->nullable();

            $table->timestamps();

            $table->foreign('incident_id')->references('id')->on('incidents');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('previous_status')->references('id')->on('statuses');
            $table->foreign('status_id')->references('id')->on('statuses');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_histories');
    }
}
