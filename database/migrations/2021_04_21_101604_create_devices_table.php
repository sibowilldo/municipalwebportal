<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_id');
            $table->string('os');
            $table->string('token')->nullable()->default(null);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::create('device_user', function(Blueprint $table){
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('device_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(false);

            $table->timestamps();
            $table->primary(['user_id', 'device_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_user');
        Schema::dropIfExists('devices');
    }
}
