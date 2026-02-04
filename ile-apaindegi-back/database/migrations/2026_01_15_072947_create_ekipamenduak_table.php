<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ekipamenduak', function (Blueprint $table) {
            $table->id();
            $table->string('etiketa');                  
            $table->string('izena');                    
            $table->text('deskribapena')->nullable();  
            $table->string('marka');                    
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ekipamenduak');
    }
};
