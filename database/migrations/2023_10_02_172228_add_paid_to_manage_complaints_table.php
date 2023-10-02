<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToManageComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manage_complaints', function (Blueprint $table) {
            $table->timestamp('service_date')->useCurrent();
            $table->tinyInteger('is_free');
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
            $table->dropColumn('service_date');
            $table->dropColumn('is_free');
        });
    }
}
