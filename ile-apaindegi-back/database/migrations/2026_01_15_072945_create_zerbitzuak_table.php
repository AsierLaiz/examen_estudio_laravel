<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('zerbitzuak', function (Blueprint $table) {
            $table->id();
            $table->string('izena');                
            $table->decimal('prezioa', 10, 2);      
            $table->decimal('etxeko_prezioa', 10, 2); 
            $table->integer('iraunaldia');          
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('zerbitzuak');
    }
};
