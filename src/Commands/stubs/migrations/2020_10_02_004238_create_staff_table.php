<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            // 指定表存储引擎
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->uuid(config('foundation.staff.id'))->nullable(false)->primary();
            //$table->primary(config('foundation.staff.id'));
            $table->uuid(config('foundation.staff.organisation_structure_id'));
            $table->uuid(config('foundation.staff.user_id'))->nullable();
            $table->char(config('foundation.staff.username'), 120)->nullable();
            $table->tinyInteger(config('foundation.staff.residential_country'));
            $table->char(config('foundation.staff.name_cn'), 20)->nullable();
            $table->char(config('foundation.staff.name_en'), 120)->nullable();
            $table->text(config('foundation.staff.cn_staff_info'))->nullable();
            $table->dateTime(config('foundation.staff.brithday'))->nullable();
            $table->text(config('foundation.staff.us_staff_info'))->nullable();
            $table->text(config('foundation.staff.staff_positions'))->nullable();
            $table->tinyInteger(config('foundation.staff.gender'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
