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
        Schema::create('users', function (Blueprint $table) {
            // User: id, role,username,email,password,is_active,email_verified_at, created_at,updated_at
            $table->id();
            $table->foreignId('manager_id')->nullable();
            $table->enum('role', ['Admin', 'Participant'])->default('Participant');
            $table->string('username')->unique();
            $table->string('university')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_confirm')->default(0);
            $table->tinyInteger('status')->nullable();
            // 0 -> new,
            // 1 -> waiting,
            // 2 -> valid,
            // 3 -> invalid
            $table->string('nationality')->nullable();
            $table->text('address')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('logo')->nullable();
            $table->string('mandate_letter')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
