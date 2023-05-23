<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatitudAndLongitudToObjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objetos', function (Blueprint $table) {
            $table->decimal('latitud', 10, 8)->nullable(false);
            $table->decimal('longitud', 11, 8)->nullable(false);
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
            $table->dropColumn('latitud');
            $table->dropColumn('longitud');
        });
    }
}
