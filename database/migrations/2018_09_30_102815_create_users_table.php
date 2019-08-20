<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('activation_token');
            $table->string('password');
            $table->string('status_is');
            $table->rememberToken();
            $table->timestamp('last_loggedin_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
