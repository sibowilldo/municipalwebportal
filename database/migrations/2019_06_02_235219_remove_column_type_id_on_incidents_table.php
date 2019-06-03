<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnTypeIdOnIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incidents', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['type_id']);
            $table->dropColumn(['type_id']);
            Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidents', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->integer('type_id')->unsigned()->after('suburb_id')->default(1);
            $table->foreign('type_id')->references('id')->on('types')->onUpdate('cascade');
            Schema::enableForeignKeyConstraints();
        });
    }
}
