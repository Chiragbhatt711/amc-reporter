<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageComplaintTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_complaint_templates', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->string('title',50)->nullable();
            $table->text('description')->nullable();
            $table->string('priority',50)->nullable();
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
        Schema::dropIfExists('manage_complaint_templates');
    }
}
