<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('expediente_id')->constrained('expedientes');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('area_origen_id');//->constrained('sub_areas');
            $table->unsignedBigInteger('area_destino_id');//->constrained('sub_areas');
            $table->integer('fojas');
            $table->date('fecha');
            $table->time('hora');
            $table->string('motivo')->nullable();
            $table->string('observacion')->nullable();
            $table->string('nombre_archivo')->nullable();
            $table->integer('estado');
            $table->integer('fojas_aux')->nullable();
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
        Schema::dropIfExists('historiales');
    }
}
