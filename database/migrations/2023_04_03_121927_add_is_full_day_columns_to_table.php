<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsFullDayColumnsToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leaves', function (Blueprint $table) {

            $table->enum('is_start_date_is_full_day', ['Yes', 'No'])->default('Yes');
            $table->enum('is_end_date_is_full_day', ['Yes', 'No'])->default('Yes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leaves', function (Blueprint $table) {
            $table->dropColumn('is_start_date_is_full_day');
            $table->dropColumn('is_end_date_is_full_day');
        });
    }
}