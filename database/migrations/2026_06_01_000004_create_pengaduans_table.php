<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nomor')->unique();
            $table->string('nama');
            $table->string('kontak');
            $table->text('isi');
            $table->string('lokasi');
            $table->string('foto')->nullable();
            $table->json('tags')->nullable();
            $table->string('status')->default('baru');
            $table->text('respon')->nullable();
            $table->string('foto_tindak_lanjut')->nullable();
            $table->timestamp('ditindaklanjuti_pada')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
