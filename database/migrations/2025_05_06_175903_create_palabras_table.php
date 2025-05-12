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
        Schema::create('palabras', function (Blueprint $table) {
            $table->id();
            $table->string('texto');
            $table->foreignId('categoria_id')->constrained('categorias'); // ¡Clave foránea explícita!
            $table->string('dificultad')->default('media');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('palabras');
    }
};
