<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('state_color_id');
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->foreign('state_color_id')->references('id')->on('state_colors');
        });

        Schema::create('category_type', function (Blueprint $table) {
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('category_id');
            $table->boolean('is_active')->default(false);

            $table->primary(['type_id', 'category_id']);
            $table->foreign('type_id')->references('id')->on('types')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_type');
        Schema::dropIfExists('types');

    }
}
