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
    Schema::create('loan_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('book_id')->constrained()->cascadeOnDelete();

        // Status:
        // pending = menunggu admin,
        // approved = disetujui (siap diambil),
        // rejected = ditolak admin,
        // completed = sudah diambil & masuk ke tabel loans
        $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');

        $table->text('note')->nullable(); // Catatan tambahan (misal: alasan penolakan)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_requests');
    }
};
