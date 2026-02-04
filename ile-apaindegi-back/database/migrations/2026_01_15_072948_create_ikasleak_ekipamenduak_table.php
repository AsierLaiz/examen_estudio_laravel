<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ikasleak_ekipamenduak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ikaslea_id')->constrained('ikasleak')->onDelete('cascade');       
            $table->foreignId('ekipamendua_id')->constrained('ekipamenduak')->onDelete('cascade'); 
            $table->dateTime('hasiera_data'); 
            $table->dateTime('amaiera_data'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ikasleak_ekipamenduak');
    }
};
