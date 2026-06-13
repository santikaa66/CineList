<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('watchlists', function (Blueprint $table) {
            $table->id();
            
            // Menghubungkan film ke user yang sedang login
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('movie_id');
            $table->string('title');
            
            // Diubah menjadi poster_path agar match dengan variabel dari API TMDB
            $table->string('poster_path')->nullable(); 
            
            // Ditambahkan kolom rating agar angka ★ bintangnya tidak hilang
            $table->decimal('vote_average', 3, 1)->nullable(); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watchlists');
    }
};