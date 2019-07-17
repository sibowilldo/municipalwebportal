<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->index();
            $table->string('reference');
            $table->string('name');
            $table->text('description')->nullable();
            $table->mediumText('location_description')->nullable()->default(null);
            $table->decimal('latitude', 10, 8)->nullable()->default(null);
            $table->decimal('longitude', 11, 8)->nullable()->default(null);
            $table->integer('suburb_id')->nullable()->default(null);
            $table->boolean('is_public')->default(true);
            $table->integer('type_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->softDeletes();

            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onUpdate('cascade');
        });

        Schema::create('incident_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('incident_id');
            $table->boolean('has_location')->default(false);
            $table->boolean('has_attachment')->default(false);
            $table->integer('source_id')->default(0);

            $table->timestamps();

            $table->primary(['user_id', 'incident_id']);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('incident_id')->references('id')->on('incidents')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_user');
        Schema::dropIfExists('incidents');
    }
}
