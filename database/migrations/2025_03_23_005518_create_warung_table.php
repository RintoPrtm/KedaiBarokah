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
        Schema::create('warung', function (Blueprint $table) {
            $table->bigIncrements('id_warung');
            $table->string('nama_warung', 100);
            $table->text('alamat_warung', 255);
            $table->string('foto_warung', 100);
            $table->string('flayer', 100);
            $table->text('deskripsi_warung', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warung');
    }
};