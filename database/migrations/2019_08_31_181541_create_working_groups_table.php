<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->mediumText('description');
            $table->boolean('is_active');
            $table->timestamps();
        });

        Schema::create('user_working_group', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('working_group_id');
            $table->boolean('is_leader')->default(false);
            $table->longText('instructions');
            $table->unsignedInteger('assigner_id');
            $table->timestamps();

            $table->primary(['user_id', 'working_group_id']);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('assigner_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('working_group_id')->references('id')->on('working_groups')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_working_group');
        Schema::dropIfExists('working_groups');
    }
}
