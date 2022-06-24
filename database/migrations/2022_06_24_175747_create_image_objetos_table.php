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
        Schema::create('image_objetos', function (Blueprint $table) {
            $table->unsignedBigInteger('image_id')->primary();
            $table->unsignedBigInteger('objeto_id');
            $table->timestamps();

            $table->foreign('image_id')
                  ->references('id')
                  ->on('images')
                  ->onDelete('cascade');

            $table->foreign('objeto_id')
                  ->references('id')
                  ->on('objetos')
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
        Schema::dropIfExists('image_objetos');
    }
};
