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
            $table->string('front_default');
            $table->string('front_female');
            $table->string('shiny');
            $table->string('shiny_female');
            $table->string('black_default');
            $table->string('black_female');
            $table->string('black_shiny');
            $table->string('black_shiny_female');
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
