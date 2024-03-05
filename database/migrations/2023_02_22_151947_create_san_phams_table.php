<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();

            $table->string('ten_san_pham');
            $table->string('slug_san_pham');
            $table->integer('is_open');
            $table->double('gia_ban', 18, 0);
            $table->double('gia_khuyen_mai', 18, 0)->default(0);
            $table->integer('id_danh_muc');
            $table->string('hinh_anh');
            $table->longText('mo_ta');
            $table->longText('mo_ta_ngan');
            $table->integer('so_luong')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
