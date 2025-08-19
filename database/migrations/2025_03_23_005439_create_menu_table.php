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
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id_menu');
            $table->string('nama_menu', 100)->nullable();
            $table->bigInteger('harga')->nullable();
            $table->bigInteger('promo')->nullable();
            $table->text('deskripsi_menu')->nullable();
            $table->string('foto_menu', 100)->nullable();
            $table->unsignedBigInteger('id_kategori');

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};