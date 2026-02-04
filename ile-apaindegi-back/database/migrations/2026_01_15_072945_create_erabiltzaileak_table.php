<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('erabiltzaileak', function (Blueprint $table) {
            $table->id();
            $table->string('erabiltzaile_izena')->unique(); 
            $table->string('posta_elek')->unique();         
            $table->char('rola', 1);
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('erabiltzaileak');
    }
};
