<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ikasleak_kontsumigarriak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ikaslea_id')->constrained('ikasleak')->onDelete('cascade');       
            $table->foreignId('kontsumigarria_id')->constrained('kontsumigarriak')->onDelete('cascade');
            $table->integer('erabilitako_kopurua'); 
            $table->dateTime('erabiltzeko_data');   
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ikasleak_kontsumigarriak');
    }
};
