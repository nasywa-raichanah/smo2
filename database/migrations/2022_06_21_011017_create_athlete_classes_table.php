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
        Schema::create('athlete_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('classes_id');
            $table->integer('user_id');
            $table->integer('athletes_id');
            $table->integer('group'); //0 jika individu, 1++ jika beregu
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
        Schema::dropIfExists('athlete_classes');
    }
};
