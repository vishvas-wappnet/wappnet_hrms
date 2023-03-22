<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leaves', function (Blueprint $table) {
            // Update user_id column
            $table->unsignedBigInteger('user_id')->change();

            // Add foreign key reference to users table id column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
            // Drop foreign key reference
            $table->dropForeign(['user_id']);

            // Revert user_id column to previous data type
            $table->integer('user_id')->change();
        });
    }
}
