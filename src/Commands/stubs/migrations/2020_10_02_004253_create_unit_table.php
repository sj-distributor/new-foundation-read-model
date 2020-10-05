<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit', function (Blueprint $table) {

            // 指定表存储引擎
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->uuid(config('foundation.unit.id'))->nullable(false)->primary();
            $table->char(config('foundation.unit.name'), 100);
            $table->text(config('foundation.unit.leader_ids'));
            $table->char(config('foundation.unit.type_desc'), 255)->nullable();
            $table->tinyInteger(config('foundation.unit.type'));
            $table->longText(config('foundation.unit.children'))->nullable();
            $table->uuid(config('foundation.unit.parent_id'));
            $table->text(config('foundation.unit.positions'))->nullable();
            $table->tinyInteger(config('foundation.unit.country_code'));
            $table->tinyInteger(config('foundation.unit.is_active'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit');
    }
}
