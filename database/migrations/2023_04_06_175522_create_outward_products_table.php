<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutwardProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outward_products', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->integer('outward_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('qty')->nullable();
            $table->double('rate',10,2)->default(0);
            $table->double('amount',10,2)->default(0);
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
        Schema::dropIfExists('outward_products');
    }
}
