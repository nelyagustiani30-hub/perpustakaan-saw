<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('criteria', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 5)->unique();      // C1..C5
            $table->string('nama');
            $table->string('field');                   // nama kolom di tabel books
            $table->enum('tipe', ['benefit', 'cost']);
            $table->decimal('bobot', 4, 3);            // total semua bobot = 1
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('criteria');
    }
};