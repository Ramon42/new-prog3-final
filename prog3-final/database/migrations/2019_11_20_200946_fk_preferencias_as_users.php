<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FkPreferenciasAsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preferencias_as_users', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_pref')->references('id')->on('preferencias');
            $table->foreign('id_campus')->references('id')->on('campuses');
            $table->foreign('id_curso')->references('id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preferencias_as_users', function (Blueprint $table) {
            $table->dropColumn('id_user');
            $table->dropColumn('id_pref');
            $table->dropColumn('id_curso');
            $table->dropColumn('id_campus');
        });
    }
}
