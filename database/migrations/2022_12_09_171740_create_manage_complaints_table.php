<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_complaints', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('amc_no')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('complaint_by')->nullable();
            $table->string('comp_by_mobile_number')->nullable();
            $table->integer('complaint_id')->nullable();
            $table->text('description')->nullable();
            $table->string('priority')->nullable();
            $table->integer('handover')->default(0);
            $table->integer('handover_to')->nullable();
            $table->date('handover_date')->nullable();
            $table->time('handover_time')->nullable();
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
        Schema::dropIfExists('manage_complaints');
    }
}
