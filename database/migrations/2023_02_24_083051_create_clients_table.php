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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('ho_va_ten');
            $table->string('phone');
            $table->string('email');
            $table->integer('gioi_tinh')->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->string('password');
            $table->integer('is_active')->default(0);
            $table->integer('is_block')->default(0);
            $table->string('hash')->nullable();
            $table->string('hash_reset')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
