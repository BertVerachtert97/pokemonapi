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
        Schema::create('sprites', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('front_default')->nullable();
            $table->string('front_female')->nullable();
            $table->string('front_shiny')->nullable();
            $table->string('front_shiny_female')->nullable();
            $table->string('back_default')->nullable();
            $table->string('back_female')->nullable();
            $table->string('back_shiny')->nullable();
            $table->string('back_shiny_female')->nullable();
            $table->bigInteger('pokemon_id')->unsigned();
            $table->foreign('pokemon_id')->references('id')->on('pokemon')
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
        Schema::dropIfExists('sprites');
    }
};
