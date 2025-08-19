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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->bigIncrements('id_pesanan');
            $table->unsignedBigInteger('id_users');
            $table->string('status', 10)->default('Diproses');
            $table->date('tanggal_pesanan');
            $table->time('jam_pesanan');

            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};