<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaratulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caratulas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('expediente_id')->constrained('expedientes');
            $table->foreignId('iniciador_id')->constrained('iniciadores');
            $table->foreignId('extracto_id')->constrained('extractos');
            $table->string('observacion', 150)->nullable();
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
        Schema::dropIfExists('caratulas');
    }
}
