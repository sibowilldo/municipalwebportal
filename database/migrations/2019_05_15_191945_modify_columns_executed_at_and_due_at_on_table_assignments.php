<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnsExecutedAtAndDueAtOnTableAssignments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assignments', function (Blueprint $table) {
            //
            $table->dateTime('executed_at')->nullable()->change();
            $table->dateTime('due_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignments', function (Blueprint $table) {
            //
            $table->date('executed_at')->nullable()->change();
            $table->date('due_at')->nullable()->change();
        });
    }
}
