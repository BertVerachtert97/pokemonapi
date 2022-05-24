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
        Schema::create('pokemon_stats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('pokemon_id')->unsigned();
            $table->bigInteger('stat_id')->unsigned();
            $table->integer('base_stat');
            $table->integer('effort');
            $table->foreign('pokemon_id')->references('id')->on('pokemon')
                ->onDelete('cascade');
            $table->foreign('stat_id')->references('id')->on('stats')
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
        Schema::dropIfExists('pokemon_stats');
    }
};
