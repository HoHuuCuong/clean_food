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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();

            $table->string('ho_va_ten');
            $table->string('email');
            $table->string('phone');
            $table->string('dia_chi');
            $table->integer('id_khach_hang');
            $table->string('hash_don_hang')->nullable();
            $table->integer('phi_ship')->nullable();
            $table->integer('tien_hang')->nullable();
            $table->integer('tong_thanh_toan')->nullable();
            $table->integer('thanh_toan')->default(0);
            $table->integer('giao_hang')->default(0);
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
        Schema::dropIfExists('don_hangs');
    }
};
