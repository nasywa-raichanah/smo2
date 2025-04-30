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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            // 0 -> Individual Kata -> Individual Male Kata, Individual Female Kata
            // 1 -> Team Kata -> Team Male Kata, Team Female Kata
            // 2 -> Individual Kumite -> Individual Male Kumite, Individual Female Kumite
            // 3 -> Team Kumite -> Team Male Kumite, Team Female Kumite
            $table->string('class_name');
            $table->boolean('sex');
            // 0 -> Male,
            // 1 -> Female
            $table->integer('min_weight'); //diisi bobot minimal, 0 jika tanpa syarat bobot
            $table->integer('max_weight'); //diisi bobot maksimal, 0 jika tanpa syarat bobot
            $table->integer('min_athlete'); //diisi 1 jika perorangan, 3 kata beregu, 5 kumite beregu 
            $table->integer('max_athlete'); //diisi 1 jika perorangan, 3 kata beregu, 7 kumite beregu
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
        Schema::dropIfExists('classes');
    }
};
