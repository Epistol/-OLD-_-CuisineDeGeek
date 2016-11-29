<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recettes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            $table->tinyInteger('difficulty');
            $table->tinyInteger('type');
            $table->smallInteger('tps_prepa');
            $table->smallInteger('tps_cuisson');
            $table->smallInteger('tps_repos');
            $table->longText('commentary');
            $table->string('url_img');
            $table->tinyInteger('nb_convives');
            $table->mediumInteger('id_categ_universe');
            $table->mediumInteger('id_universe');
            $table->bigInteger('id_user');
            $table->bigInteger('nb_views');
            $table->tinyInteger('cost');
            $table->string('origin');
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
        Schema::dropIfExists('recettes');
    }
}
