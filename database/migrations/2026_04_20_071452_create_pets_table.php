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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            // Menghubungkan hewan ke pemiliknya (User)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            $table->string('name'); // Nama hewan
            $table->string('type'); // Jenis (misal: Feline, Canine, Avian)
            $table->string('breed')->nullable(); // Ras (misal: Perssia, Golden Retriever)
            $table->string('photo')->nullable(); // Tempat nyimpen path foto sepia
            $table->text('description')->nullable(); // Catatan observasi atau perilaku
            
            $table->timestamps(); // Created_at & Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};