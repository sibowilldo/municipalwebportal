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
            $table->text('description')->nullable();
            $table->string('contact_number')->default('');
            $table->string('email')->default('');
            $table->mediumText('address')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('district_id');
            $table->unsignedInteger('status_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::create('department_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('department_id');

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
