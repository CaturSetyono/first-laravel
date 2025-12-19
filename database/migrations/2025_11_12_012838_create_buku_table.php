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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 200);
            $table->unsignedBigInteger('pengarang_id');
            $table->string('isbn', 20)->unique();
            $table->year('tahun_terbit');
            $table->integer('jumlah_halaman');
            $table->string('penerbit', 100);
            $table->decimal('harga', 10, 2);
            $table->integer('stok')->default(0);
            $table->timestamps();
            
            $table->foreign('pengarang_id')->references('id')->on('pengarang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
