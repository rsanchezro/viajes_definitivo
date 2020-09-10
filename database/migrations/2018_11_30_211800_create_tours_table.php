<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('operator_id')->unsigned();
            $table->string('destino', 100);
            $table->date('inicio_fecha');
            $table->time('inicio_hora');
            $table->date('final_fecha');
            $table->time('final_hora');
            $table->integer('duracion')->unsigned();
            $table->float('precio', 8, 2)->unsigned();
            $table->text('detalles')->nullable();
            $table->timestamps();
            /* El campo deleted_at */
            $table->softDeletes();
            /** La clave foránea para relacionar esta tabla con operators. */
            $table->foreign('operator_id')->references('id')->on('operators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
}
