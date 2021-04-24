<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('status_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->efficientUuid('uuid')->index();
            $table->string('reference');
            $table->string('account_number')->nullable()->default(null);
            $table->string('name');
            $table->text('description')->nullable();
            $table->mediumText('location_description')->nullable()->default(null);
            $table->decimal('latitude', 10, 8)->nullable()->default(null);
            $table->decimal('longitude', 11, 8)->nullable()->default(null);
            $table->integer('suburb_id')->nullable()->default(null);
            $table->boolean('is_public')->default(true);

            $table->softDeletes();
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
        Schema::dropIfExists('incidents');
    }
}
