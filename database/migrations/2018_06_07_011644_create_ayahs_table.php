<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAyahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayahs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->text('text');
            $table->integer('number_in_surah');
            $table->integer('page');
            $table->integer('surah_id');
            $table->integer('hizb_id');
            $table->integer('juz_id');
            $table->boolean('sajda');
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
        Schema::dropIfExists('ayahs');
    }
}
