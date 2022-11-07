<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_taxes', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->string('profile_name',50)->nullable();
            $table->string('tax_lable_name',50)->nullable();
            $table->string('tax_caption_1',50)->nullable();
            $table->decimal('tax_percentage_1',10,2)->nullable()->default(0);
            $table->string('tax_caption_2',50)->nullable();
            $table->decimal('tax_percentage_2',10,2)->nullable()->default(0);
            $table->string('tax_caption_3',50)->nullable();
            $table->decimal('tax_percentage_3',10,2)->nullable()->default(0);
            $table->string('tax_caption_4',50)->nullable();
            $table->decimal('tax_percentage_4',10,2)->nullable()->default(0);
            $table->string('tax_caption_5',50)->nullable();
            $table->decimal('tax_percentage_5',10,2)->nullable()->default(0);
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
        Schema::dropIfExists('manage_taxes');
    }
}
