<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToManageAmcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manage_amcs', function (Blueprint $table) {
            $table->string('service_day')->nullable();
            $table->integer('no_of_service')->nullable();
            $table->integer('no_of_installment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manage_amcs', function (Blueprint $table) {
            $table->dropColumn('service_day');
            $table->dropColumn('no_of_service');
            $table->dropColumn('no_of_installment');
        });
    }
}
