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
            $table->bigInteger('pokemon_id')->unsigned();
            $table->bigInteger('team_id')->unsigned();
            $table->foreign('pokemon_id')->references('id')->on('pokemon')
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
