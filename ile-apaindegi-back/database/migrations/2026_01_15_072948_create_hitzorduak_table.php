<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hitzorduak', function (Blueprint $table) {
            $table->id();
            $table->text('iruzkina')->nullable();  
            $table->date('hitzordua_data');        
            $table->time('hasiera_ordua');
            $table->time('amaiera_ordua');
            $table->foreignId('bezeroa_id')->constrained('bezeroak')->onDelete('cascade'); 
            $table->foreignId('ikaslea_id')->nullable()->constrained('ikasleak')->onDelete('set null'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hitzorduak');
    }
};
