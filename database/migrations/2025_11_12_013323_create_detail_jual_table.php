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
        Schema::create('detail_jual', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jual_id');
            $table->bigInteger('barang_id');
            $table->integer('jumlah');
            $table->decimal('harga', 10, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
            
            $table->foreign('jual_id')->references('id')->on('jual')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_jual');
    }
};
