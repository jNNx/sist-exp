<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIniciadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iniciadores', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->foreignId('id_tipo_entidad')->constrained('tipos_entidad'); //TODO 
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->unsignedBigInteger('dni')->nullable();
            $table->unsignedBigInteger('cuil')->nullable();
            $table->unsignedBigInteger('cuit')->nullable();
            $table->unsignedBigInteger('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('direccion')->nullable();
            $table->string('area_reparticiones')->nullable();
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
        Schema::dropIfExists('iniciadores');
    }
}
