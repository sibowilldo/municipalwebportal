<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dyrynda\Database\Support\GeneratesUuid;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->index();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('contactnumber');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('activation_token');
            $table->string('password');
            $table->unsignedInteger('status_id');
            $table->rememberToken();
            $table->boolean('is_online')->default(false);
            $table->timestamp('last_loggedin_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('users');
    }
}
