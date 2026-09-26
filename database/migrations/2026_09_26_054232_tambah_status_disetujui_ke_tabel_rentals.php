<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE rentals MODIFY COLUMN status ENUM('menunggu_konfirmasi', 'disetujui', 'ditolak', 'selesai', 'dibatalkan') DEFAULT 'menunggu_konfirmasi'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE rentals MODIFY COLUMN status ENUM('menunggu_konfirmasi', 'dipinjam', 'ditolak', 'selesai', 'dibatalkan') DEFAULT 'menunggu_konfirmasi'");
    }
};
