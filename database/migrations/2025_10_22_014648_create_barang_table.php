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
        Schema::create('barang', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->integer('jenis_barang');
            $table->string('nama_barang', 100);
            $table->string('satuan', 75);
            $table->integer('harga_pokok');
            $table->integer('harga_jual');
            $table->integer('stok')->default(0);
            $table->timestamp('create_at')->nullable();
            $table->timestamp('update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
