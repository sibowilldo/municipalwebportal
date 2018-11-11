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
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::create('category_type', function (Blueprint $table) {
            $table->integer('type_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->boolean('is_active')->default(false);

            $table->primary(['type_id', 'category_id']);
            $table->foreign('type_id')->references('id')->on('types')->onuUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onuUpdate('cascade');
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
