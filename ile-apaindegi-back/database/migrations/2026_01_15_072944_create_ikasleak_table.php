<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ikasleak', function (Blueprint $table) {
            $table->id();
            $table->string('izena');           
            $table->string('abizenak');        
            $table->foreignId('taldea_id')->constrained('taldeak')->onDelete('cascade'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ikasleak');
    }
};
