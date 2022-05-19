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
        Schema::create('pokemon_moves', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('pokemon_id')->unsigned();
            $table->integer('move_id')->unsigned();
            $table->foreign('pokemon_id')->references('id')->on('pokemons')
                ->onDelete('cascade');
            $table->foreign('move_id')->references('id')->on('moves')
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
        Schema::dropIfExists('pokemon_moves');
    }
};
