<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('leave_subject');
            $table->text('description')->nullable();
            $table->dateTime('leave_start_date');
            $table->dateTime('leave_end_date');
            $table->enum('is_full_day', ['Yes', 'No'])->default('Yes');
            $table->integer('leave_balance')->default(0);
            $table->text('leave_reason')->nullable();
            $table->string('work_reliever')->nullable();
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
        Schema::dropIfExists('leaves');
    }
}