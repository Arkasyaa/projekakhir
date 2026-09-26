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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->unsigned();
            $table->string('booking_code')->unique();
            $table->date('tanggal_pengambilan');
            $table->integer('durasi_sewa');
            $table->date('tanggal_kembali')->nullable();
            $table->decimal('total_pembayaran', 10, 2);
            $table->enum('status', ['menunggu konfirmasi', 'Konfirmasi', 'dipinjam', 'ditolak', 'selesai'])->default('menunggu konfirmasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
