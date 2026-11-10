<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->unique();
            $table->string('judul');
            $table->string('penulis');
            $table->string('kategori')->nullable();
            // Nilai kriteria untuk metode SAW
            $table->unsignedInteger('jumlah_dipinjam')->default(0);   // C1 (benefit)
            $table->decimal('rating', 3, 2)->default(0);              // C2 (benefit) skala 0-5
            $table->unsignedSmallInteger('tahun_terbit');             // C3 (benefit)
            $table->unsignedInteger('stok')->default(0);              // C4 (benefit)
            $table->unsignedTinyInteger('kondisi_rusak')->default(1); // C5 (cost) skala 1-5
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};