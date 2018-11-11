<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meta_id')->unsigned();
            $table->string('path');
            $table->string('filename');
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->foreign('meta_id')->references('id')->on('metas')->onUpdate('cascade');
        });

        Schema::create('attachment_incident', function (Blueprint $table) {
            $table->integer('incident_id')->unsigned();
            $table->integer('attachment_id')->unsigned();
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->primary(['incident_id', 'attachment_id']);
            $table->foreign('incident_id')->references('id')->on('incidents')->onUpdate('cascade');
            $table->foreign('attachment_id')->references('id')->on('attachments')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachment_incident');
        Schema::dropIfExists('attachments');
    }
}
