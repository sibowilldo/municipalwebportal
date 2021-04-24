<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('application');
            $table->string('version');
            $table->string('api_key');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        Schema::create('application_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('configuration_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('key');
            $table->longText('value');
            $table->longText('display');
            $table->boolean('is_mobile')->default(false);
            $table->boolean('is_web')->default(false);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_configurations');
        Schema::dropIfExists('configurations');
    }
}
