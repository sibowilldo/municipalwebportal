<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('district')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->text('contact_number')->nullable()->default(null);
            $table->text('email')->default('');
            $table->text('alt_contact_number')->nullable()->default(null);
            $table->mediumText('address')->nullable()->default(null);
            $table->text('status_is')->default('active');

            $table->timestamps();
        });

        Schema::create('department_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('department_id')->unsigned();

            $table->timestamps();

            $table->primary(['user_id', 'department_id']);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            Schema::dropIfExists('department_user');
            Schema::dropIfExists('departments');
        });
    }
}
