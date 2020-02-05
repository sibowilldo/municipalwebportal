<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('incident_id');
            $table->longText('instructions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_group')->default(false);
            $table->unsignedInteger('assigner_id');
            $table->morphs('assignable');
            $table->timestamp('executed_at')->nullable();
            $table->timestamp('declined_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('due_at')->nullable();

            $table->timestamps();

            $table->foreign('incident_id')
                ->references('id')->on('incidents')
                ->onUpdate('cascade');
            $table->foreign('assigner_id')
                ->references('id')->on('users')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
