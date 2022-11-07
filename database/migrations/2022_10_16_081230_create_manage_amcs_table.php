<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageAmcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_amcs', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('party_id')->nullable();
            $table->string('amc_type',30)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('qty')->nullable();
            $table->text('note')->nullable();
            $table->double('contract_amount')->nullable();
            $table->string('tax',30)->nullable();
            $table->string('extf1',100)->nullable();
            $table->string('extf2',100)->nullable();
            $table->string('extf3',100)->nullable();
            $table->string('extf4',100)->nullable();
            $table->string('extf5',100)->nullable();
            $table->string('extf6',100)->nullable();
            $table->string('extf7',100)->nullable();
            $table->string('extf8',100)->nullable();
            $table->string('extf9',100)->nullable();
            $table->string('extf10',100)->nullable();
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
        Schema::dropIfExists('manage_amcs');
    }
}
