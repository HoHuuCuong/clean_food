<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('yeu_thiches', function (Blueprint $table) {
            $table->id();
            $table->integer('id_san_pham');
            $table->integer('id_khach_hang');
            $table->integer('is_yeu_thich'); //
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('yeu_thiches');
    }
};
