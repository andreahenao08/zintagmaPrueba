<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfessionIdToCandidatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidatos', function (Blueprint $table) {
            $table->unsignedInteger('profession_id')->nullable();
            $table->foreign('profession_id')->references('id')->on('professions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidatos', function (Blueprint $table) {
            $table->dropForeign('profession_id');
            $table->dropColumn('profession_id');
        });
    }
}
