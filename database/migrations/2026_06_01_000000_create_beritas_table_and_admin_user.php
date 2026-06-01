<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('judul');
            $table->date('tanggal_berita');
            $table->longText('isi');
            $table->string('gambar_headline')->nullable();
            $table->string('penerbit');
            $table->json('tags')->nullable();
            $table->timestamps();
        });

        DB::table('users')->updateOrInsert(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
        DB::table('users')->where('email', 'admin@admin.com')->delete();
    }
};
