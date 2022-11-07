<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_parties', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->string('party_name',50)->nullable();
            $table->string('contact_person_name',50)->nullable();
            $table->text('address')->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('pincode',50)->nullable();
            $table->string('mobile_no',30)->nullable();
            $table->string('phone_no',30)->nullable();
            $table->string('email',50)->nullable();
            $table->string('opening_balance',50)->nullable();
            $table->string('extf_1',50)->nullable();
            $table->string('extf_2',50)->nullable();
            $table->string('extf_3',50)->nullable();
            $table->string('extf_4',50)->nullable();
            $table->string('extf_5',50)->nullable();
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
        Schema::dropIfExists('manage_parties');
    }
}
