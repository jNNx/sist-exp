<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->unsignedBigInteger('persona_id');//->constrained('personas');
            $table->foreignId('persona_id')->constrained('personas');
            $table->foreignId('area_id')->constrained('areas');
            //$table->unsignedBigInt('area_id');
            $table->foreignId('tipo_user_id')->constrained('tipo_users');
            //$table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('cuil')->unique();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            //$table->text('profile_photo_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
