<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAyahEditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayah_edition', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('ayah_id')->unsigned();
            $table->foreign('ayah_id')->references('id')->on('ayahs')->onDelete('cascade');

            $table->integer('edition_id')->unsigned();
            $table->foreign('edition_id')->references('id')->on('editions')->onDelete('cascade');

            $table->text('data');
            $table->boolean('is_audio');
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
        Schema::dropIfExists('ayah_edition');
    }
}
