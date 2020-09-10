<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operators', function (Blueprint $table) {
            // Creamos un campo autoincrementable como clave primaria
            $table->bigIncrements('id');
            /* Creamos un campo de tipo string. El segundo argumento indica el máximo de caracteres. */
            $table->string('nombre', 60);
            $table->string('ciudad', 60);
            /* Creamos un campo de tipo string. Al no haber segundo argumento, el máximo de caracteres es 255. */
            $table->string('direccion');
            $table->string('telefono');
            /* Creamos el rango como un campo de dos caracteres */
            $table->char('rango', 2);
            /* Los campos created_at y updated_at */
            $table->timestamps();
            /* El campo deleted_at */
            $table->softDeletes();
            /** Creamos un índice tal que la combinación de los campos especificados
             * en la matriz debe ser única, es decir, en la misma ciudad no podrá haber
             * dos operadores con el mismo rango. */
            $table->unique(['ciudad', 'rango']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operators');
    }
}
