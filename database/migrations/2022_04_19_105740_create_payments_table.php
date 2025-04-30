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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoices_id');
            $table->foreignId('user_id');
            $table->tinyInteger('item');
            //0 -> Biaya Registrasi
            // 0+1 -> Individual Kata -> Individual Male Kata, Individual Female Kata
            // 1+1 -> Team Kata -> Team Male Kata, Team Female Kata
            // 2+1 -> Individual Kumite -> Individual Male Kumite, Individual Female Kumite
            // 3+1 -> Team Kumite -> Team Male Kumite, Team Female Kumite
            $table->integer('qty');
            $table->bigInteger('cost');
            $table->bigInteger('total_cost');
            // $table->tinyInteger('status')->nullable();
            // 0 -> unpaid,
            // 1 -> waiting,
            // 2 -> paid,
            // 3 -> invalid
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
        Schema::dropIfExists('payments');
    }
};
