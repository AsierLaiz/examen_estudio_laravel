<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ordutegiak', function (Blueprint $table) {
            $table->id();
            $table->integer('eguna');            
            $table->date('hasiera_data');        
            $table->date('amaiera_data');        
            $table->time('hasiera_ordua');       
            $table->time('amaiera_ordua');       
            $table->foreignId('taldea_id')->constrained('taldeak')->onDelete('cascade'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordutegiak');
    }
};
