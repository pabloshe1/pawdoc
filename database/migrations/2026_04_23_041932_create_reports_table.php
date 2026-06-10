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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users (siapa yang lapor)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Menghubungkan ke tabel pets (hewan mana yang sakit)
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            
            // Kolom inti laporan
            $table->text('symptoms'); // Gejala dari user
            $table->text('diagnosis')->nullable(); // Diagnosa dari admin (kosong dulu)
            $table->string('status')->default('PENDING'); // PENDING atau REVIEWED
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};