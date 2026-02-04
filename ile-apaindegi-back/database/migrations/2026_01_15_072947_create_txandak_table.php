<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('txandak', function (Blueprint $table) {
            $table->id();
            $table->char('mota', 1);                     
            $table->date('data');                        
            $table->foreignId('ikaslea_id')->constrained('ikasleak')->onDelete('cascade'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('txandak');
    }
};
