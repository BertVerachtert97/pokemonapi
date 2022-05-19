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
        Schema::create('pokemon_teams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('pokemon_id')->unsigned();
            $table->integer('stat_id')->unsigned();
            $table->foreign('pokemon_id')->references('id')->on('pokemons')
                ->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')
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
        Schema::dropIfExists('pokemon_teams');
    }
};
