<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('expediente_id')->constrained('expedientes');
            $table->string('nro');
            $table->integer('tipo');
            $table->integer('estado')->nullable();//TODO preguntar tipo estado y que datos se van a almacenar en pagos
            $table->double('monto', 10, 2);
            $table->date('fecha');
            $table->string('titular')->nullable();
            $table->string('banco')->nullable();
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
        Schema::dropIfExists('pagos');
    }
}
