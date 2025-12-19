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
        Schema::create('jual', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi', 20)->unique();
            $table->date('tanggal');
            $table->string('nama_pembeli', 100);
            $table->text('alamat')->nullable();
            $table->string('telepon', 15)->nullable();
            $table->decimal('total', 12, 2)->default(0);
            $table->enum('status', ['pending', 'proses', 'selesai', 'batal'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jual');
    }
};
