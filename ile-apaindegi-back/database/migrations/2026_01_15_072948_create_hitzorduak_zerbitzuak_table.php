<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hitzorduak_zerbitzuak', function (Blueprint $table) {
            $table->id();
            $table->text('iruzkinak')->nullable();                       
            $table->foreignId('hitzordua_id')->constrained('hitzorduak')->onDelete('cascade'); 
            $table->foreignId('zerbitzua_id')->constrained('zerbitzuak')->onDelete('cascade'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hitzorduak_zerbitzuak');
    }
};
