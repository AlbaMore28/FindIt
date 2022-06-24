<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetos_buscados_busca', function (Blueprint $table) {
            $table->timestamps();

            $table->unsignedBigInteger('objeto_id')->primary();
            $table->unsignedBigInteger('user_id');

            $table->foreign('objeto_id')
                  ->references('id')
                  ->on('objetos')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objetos_buscados');
    }
};