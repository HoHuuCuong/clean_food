<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cau_hinhs', function (Blueprint $table) {
            $table->id();
            $table->string('list_image')->nullable();
            $table->string('list_title')->nullable();
            $table->string('list_des')->nullable();
            $table->string('list_link')->nullable();
            $table->string('list_bestsale')->nullable();
            $table->string('list_sale')->nullable();
            $table->string('image_slide_1')->nullable();
            $table->string('image_slide_2')->nullable();
            $table->string('title_slide_1')->nullable();
            $table->string('title_slide_2')->nullable();
            $table->string('des_slide_1')->nullable();
            $table->string('des_slide_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cau_hinhs');
    }
};
