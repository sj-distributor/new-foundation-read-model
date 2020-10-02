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
            $table->uuid(config('foundation.staff.id'));
            $table->uuid(config('foundation.staff.organisation_structure_id'));
            $table->uuid(config('foundation.staff.user_id'));
            $table->char(config('foundation.staff.username'), 120);
            $table->int(config('foundation.staff.residential_country'), 1);
            $table->char(config('foundation.staff.name_cn'), 20);
            $table->char(config('foundation.staff.name_en'), 120);
            $table->text(config('foundation.staff.cn_staff_info'));
            $table->text(config('foundation.staff.us_staff_info'));
            $table->text(config('foundation.staff.staff_positions'));
            $table->int(config('foundation.staff.gender'), 1);
            $table->primary(config('foundation.staff.id'));
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
