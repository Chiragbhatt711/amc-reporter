<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToManageComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manage_complaints', function (Blueprint $table) {
            $table->date('update_date')->nullable();
            $table->string('status')->nullable();
            $table->integer('attend_by')->nullable();
            $table->integer('solution_id')->nullable();
            $table->text('call_description')->nullable();
            $table->text('call_remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manage_complaints', function (Blueprint $table) {
            $table->dropColumn('update_date');
            $table->dropColumn('status');
            $table->dropColumn('attend_by');
            $table->dropColumn('solution_id');
            $table->dropColumn('call_description');
            $table->dropColumn('call_remark');
        });
    }
}
