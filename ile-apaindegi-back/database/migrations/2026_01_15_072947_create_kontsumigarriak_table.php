<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kontsumigarriak', function (Blueprint $table) {
            $table->id();
            $table->string('izena');                   
            $table->text('deskribapena')->nullable(); 
            $table->string('batch');                  
            $table->string('marka');                  
            $table->integer('stock');                 
            $table->integer('min_stock');             
            $table->date('iraungitze_data');          
            $table->foreignId('kategoriak_id')->constrained('kategoriak')->onDelete('cascade'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontsumigarriak');
    }
};
