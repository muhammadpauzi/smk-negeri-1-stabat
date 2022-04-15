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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->string('nisn', 10);
            $table->enum('gender', ['pria', 'wanita']);
            $table->string('place_of_birth', 256);
            $table->date('date_of_birth');
            $table->string('religion', 32);
            $table->string('address', 256);
            $table->string('rombongan_belajar', 32);
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
        Schema::dropIfExists('students');
    }
};
