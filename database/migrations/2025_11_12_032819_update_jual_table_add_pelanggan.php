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
        Schema::table('jual', function (Blueprint $table) {
            $table->unsignedBigInteger('pelanggan_id')->nullable()->after('id');
            $table->unsignedBigInteger('user_id')->nullable()->after('tanggal');
            $table->integer('jumlah_pembelian')->nullable()->after('user_id');
            
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jual', function (Blueprint $table) {
            $table->dropForeign(['pelanggan_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['pelanggan_id', 'user_id', 'jumlah_pembelian']);
        });
    }
};
