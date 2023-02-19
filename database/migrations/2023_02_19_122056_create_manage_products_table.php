<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_products', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->string('brand',50)->nullable();
            $table->string('model',50)->nullable();
            $table->string('product_code',50)->nullable();
            $table->string('product_name',50)->nullable();
            $table->double('mrp',10,2)->default(0.00);
            $table->integer('min_qty')->default(0);
            $table->string('unit',30)->nullable();
            $table->integer('opening_qty')->default(0);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('manage_products');
    }
}
