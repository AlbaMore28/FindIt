<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsObjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objetos', function (Blueprint $table) {
            $table->dropColumn('categoria');
            $table->dropColumn('color');

            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();

            $table->foreign('categoria_id')
                  ->references('id')
                  ->on('categorias')
                  ->onDelete('restrict');

            $table->foreign('color_id')
                  ->references('id')
                  ->on('colors')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objetos', function (Blueprint $table) {
            $table->dropIndex('objetos_categoria_id_index');
            $table->dropIndex('objetos_color_id_index');

            $table->dropColumn('categoria_id');
            $table->dropColumn('color_id');

            $table->enum('categoria', ['animal','cartera','ropa','llaves','telefono'])->default('cartera');
            $table->string('color')->default('#a25670');
        });
    }
}
