<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position', function (Blueprint $table) {
            $table->uuid(config('foundation.position.id'))->nullable(false)->primary();
            $table->char(config('foundation.position.name'), 100);
            $table->text(config('foundation.position.description'))->nullable();
            $table->uuid(config('foundation.position.entity_id'));
            $table->tinyInteger(config('foundation.position.is_active'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('position');
    }
}
