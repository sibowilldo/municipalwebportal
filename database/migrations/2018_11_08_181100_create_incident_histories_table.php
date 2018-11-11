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
            $table->integer('incident_id')->unsigned();
            $table->integer('previous_status')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->string('account_number');
            $table->mediumText('update_reason')->nullable();

            $table->timestamps();

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
