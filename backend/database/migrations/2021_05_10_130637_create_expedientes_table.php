<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('area_actual_id')->constrained('areas');
            $table->foreignId('estado_expediente_id')->constrained('estado_expedientes');
            $table->foreignId('tipo_expediente')->constrained('tipo_expedientes');
            $table->foreignId('prioridad_id')->constrained('prioridad_expedientes');
            $table->string('expediente_id')->nullable();
            $table->string('nro_expediente')->unique();
            $table->string('nro_expediente_ext')->nullable();
            $table->unsignedInteger('fojas');
            $table->date('fecha');
            $table->double('monto',10,2)->nullable();
            $table->string('archivos')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expedientes');
    }
}
