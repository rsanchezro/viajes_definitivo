<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTourTable extends Migration
{
    public function up()
    {
        Schema::create('customer_tour', function (Blueprint $table) {
            $table->bigIncrements('id');
            /** Los campos de fechas */
            $table->integer('customer_id')->unsigned();
            $table->integer('tour_id')->unsigned();
            /** La declaración de las claves foráneas en los campos necesarios. */
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('tour_id')->references('id')->on('tours');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_tour');
    }
}
