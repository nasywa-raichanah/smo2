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
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('athlete_name');
            $table->string('birth_place');
            $table->string('birth_date');
            $table->boolean('sex');
            $table->string('athlete_email');
            $table->string('athlete_whatsapp');
            $table->integer('weight')->nullable();
            $table->tinyInteger('status')->nullable();
            // 0 -> new,
            // 1 -> waiting,
            // 2 -> valid,
            // 3 -> invalid
            $table->string('photo')->nullable();
            $table->string('nic')->nullable();
            $table->string('campus_card')->nullable();
            $table->string('belt_certificate')->nullable();
            $table->string('college_payment')->nullable();
            // berkas
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
        Schema::dropIfExists('athletes');
        Schema::dropIfExists('athletes_classes');
    }
};
