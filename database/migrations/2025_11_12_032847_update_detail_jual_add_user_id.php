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
        Schema::table('detail_jual', function (Blueprint $table) {
            // Tambah kolom qty dan harga_sekarang jika belum ada
            if (!Schema::hasColumn('detail_jual', 'qty')) {
                $table->integer('qty')->after('barang_id');
            }
            if (!Schema::hasColumn('detail_jual', 'harga_sekarang')) {
                $table->integer('harga_sekarang')->after('qty');
            }
            
            $table->unsignedBigInteger('user_id')->default(1)->after('subtotal');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_jual', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
